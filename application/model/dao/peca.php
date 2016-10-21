<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/peca.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Peca as Object_Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Peca $object_peca) {
            try {
                $sql = "INSERT INTO tb_peca (peca_id, peca_du_us_id, peca_en_id, peca_co_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade) 
                        VALUES (:id, :du_us_id, :en_id, :co_id, :st_id, :nome, :fabricante, :preco, :descricao, :data, :serie, :prioridade);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $object_peca->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $object_peca->get_endereco_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":co_id", $object_peca->get_contato_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $object_peca->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_peca->get_nome(), PDO::PARAM_STR);
				$p_sql->bindValue(":fabricante", $object_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(":preco", $object_peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(":descricao", $object_peca->get_descricao(), PDO::PARAM_STR);
				$p_sql->bindValue(":data", $object_peca->get_data_anuncio(), PDO::PARAM_STR);
				$p_sql->bindValue(":serie", $object_peca->get_serie(), PDO::PARAM_STR);
				$p_sql->bindValue(":prioridade", $object_peca->get_prioridade(), PDO::PARAM_BOOL);
				
                $p_sql->execute();
				
				return Conexao::Conectar()->lastInsertId();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Peca $object_peca) {
            try {
                $sql = "UPDATE tb_peca SET peca_id = :id, peca_du_us_id = :du_us_id, peca_en_id = :en_id, peca_co_id = :co_id, 
                peca_sp_id = :st_id, peca_nome = :nome, peca_fabricante = :fabricante, peca_preco = :preco, peca_descricao = :descricao, 
                peca_data_anuncio = :data, peca_numero_serie = :serie, peca_prioridade = :prioridade WHERE peca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $object_peca->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $object_peca->get_endereco_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":co_id", $object_peca->get_contato_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $object_peca->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_peca->get_nome(), PDO::PARAM_STR);
				$p_sql->bindValue(":fabricante", $object_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(":preco", $object_peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(":descricao", $object_peca->get_descricao(), PDO::PARAM_STR);
				$p_sql->bindValue(":data", $object_peca->get_data_anuncio(), PDO::PARAM_STR);
				$p_sql->bindValue(":serie", $object_peca->get_serie(), PDO::PARAM_STR);
				$p_sql->bindValue(":prioridade", $object_peca->get_prioridade(), PDO::PARAM_BOOL);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT peca_id, peca_du_us_id, peca_en_id, peca_co_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Usuario($id, $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	
        	try {
        		$sql = "SELECT peca_id, peca_du_us_id, peca_en_id, peca_co_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade 
        				FROM tb_peca WHERE peca_du_us_id = :id LIMIT :inicio, :limite";
        	
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        		$p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
        		$p_sql->execute();
        	
        		return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Numero_Paginas_Por_Id_Usuario($id) {
        	try {
        		$sql = "SELECT peca_id FROM tb_peca WHERE peca_du_us_id = :id";
        		 
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		 
        		return  ceil($cont / 9);
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        private static function PopulaPeca($row) {
            $object_peca = new Object_Peca();
            
            if (isset($row['peca_id'])) {
            	$object_peca->set_id($row['peca_id']);
            }
            
            if (isset($row['peca_du_us_id'])) {
            	$object_peca->set_usuario_id($row['peca_du_us_id']);
            }
            
            if (isset($row['peca_en_id'])) {
            	$object_peca->set_endereco_id($row['peca_en_id']);
            }
            
            if (isset($row['peca_co_id'])) {
            	$object_peca->set_contato_id($row['peca_co_id']);
            }
            
            if (isset($row['peca_sp_id'])) {
            	$object_peca->set_status_id($row['peca_sp_id']);
            }
            
            if (isset($row['peca_nome'])) {
            	$object_peca->set_nome($row['peca_nome']);
            }
            
            if (isset($row['peca_fabricante'])) {
            	$object_peca->set_fabricante($row['peca_fabricante']);
            }
            
            if (isset($row['peca_preco'])) {
            	$object_peca->set_preco($row['peca_preco']);
            }
            
            if (isset($row['peca_descricao'])) {
            	$object_peca->set_descricao($row['peca_descricao']);
            }
            
            if (isset($row['peca_data_anuncio'])) {
            	$object_peca->set_data_anuncio($row['peca_data_anuncio']);
            }
            
            if (isset($row['peca_numero_serie'])) {
            	$object_peca->set_serie($row['peca_numero_serie']);
            }
            
            if (isset($row['peca_prioridade'])) {
            	$object_peca->set_prioridade($row['peca_prioridade']);
            }
            
            return $object_peca;
        }
        
        private static function PopulaPecas($rows) {
        	$object_pecas = array();
        	
        	foreach ($rows as $row) {
	        	$object_peca = new Object_Peca();
	        	
	        	if (isset($row['peca_id'])) {
	        		$object_peca->set_id($row['peca_id']);
	        	}
	        	
	        	if (isset($row['peca_du_us_id'])) {
	        		$object_peca->set_usuario_id($row['peca_du_us_id']);
	        	}
	        	
	        	if (isset($row['peca_en_id'])) {
	        		$object_peca->set_endereco_id($row['peca_en_id']);
	        	}
	        	
	        	if (isset($row['peca_co_id'])) {
	        		$object_peca->set_contato_id($row['peca_co_id']);
	        	}
	        	
	        	if (isset($row['peca_sp_id'])) {
	        		$object_peca->set_status_id($row['peca_sp_id']);
	        	}
	        	
	        	if (isset($row['peca_nome'])) {
	        		$object_peca->set_nome($row['peca_nome']);
	        	}
	        	
	        	if (isset($row['peca_fabricante'])) {
	        		$object_peca->set_fabricante($row['peca_fabricante']);
	        	}
	        	
	        	if (isset($row['peca_preco'])) {
	        		$object_peca->set_preco($row['peca_preco']);
	        	}
	        	
	        	if (isset($row['peca_descricao'])) {
	        		$object_peca->set_descricao($row['peca_descricao']);
	        	}
	        	
	        	if (isset($row['peca_data_anuncio'])) {
	        		$object_peca->set_data_anuncio($row['peca_data_anuncio']);
	        	}
	        	
	        	if (isset($row['peca_numero_serie'])) {
	        		$object_peca->set_serie($row['peca_numero_serie']);
	        	}
	        	
	        	if (isset($row['peca_prioridade'])) {
	        		$object_peca->set_prioridade($row['peca_prioridade']);
	        	}
	        
	        	$object_pecas[] = $object_peca;
        	}
        	
        	return $object_pecas;
        }
    }
?>