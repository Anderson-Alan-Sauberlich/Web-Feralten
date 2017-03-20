<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/peca.php';
    require_once RAIZ.'/application/model/dao/foto_peca.php';
    require_once RAIZ.'/application/model/dao/status_peca.php';
    require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/dao/dados_usuario.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Peca as Object_Peca;
    use application\model\dao\Foto_Peca as DAO_Foto_Peca;
    use application\model\dao\Status_Peca as DAO_Status_Peca;
    use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Dados_Usuario as DAO_Dados_Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Peca $object_peca) {
            try {
                $sql = "INSERT INTO tb_peca (peca_id, peca_du_us_id, peca_en_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade) 
                        VALUES (:id, :du_us_id, :en_id, :st_id, :nome, :fabricante, :preco, :descricao, :data, :serie, :prioridade);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $object_peca->get_dados_usuario()->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $object_peca->get_endereco()->get_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $object_peca->get_status()->get_id(), PDO::PARAM_INT);
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
        
        public static function Atualizar(Object_Peca $object_peca) : bool {
            try {
                $sql = "UPDATE tb_peca SET peca_id = :id, peca_du_us_id = :du_us_id, peca_en_id = :en_id, peca_sp_id = :st_id, 
                peca_nome = :nome, peca_fabricante = :fabricante, peca_preco = :preco, peca_descricao = :descricao, 
                peca_data_anuncio = :data, peca_numero_serie = :serie, peca_prioridade = :prioridade WHERE peca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $object_peca->get_dados_usuario()->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $object_peca->get_endereco()->get_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $object_peca->get_status()->get_id(), PDO::PARAM_INT);
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
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT peca_id, peca_du_us_id, peca_en_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(Object_Peca $object_peca) {
        	$pesquisa = "";
        	 
        	if (!empty($object_peca->get_dados_usuario()->get_usuario_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_du_us_id = :du_id";
        	}
        	if (!empty($object_peca->get_status())) {
        	
        	}
        	if (!empty($object_peca->get_nome())) {
        	
        	}
        	if (!empty($object_peca->get_fabricante())) {
        	
        	}
        	if (!empty($object_peca->get_preco())) {
        	
        	}
        	if (!empty($object_peca->get_descricao())) {
        	
        	}
        	if (!empty($object_peca->get_data_anuncio())) {
        	
        	}
        	if (!empty($object_peca->get_serie())) {
        	
        	}
        	if (!empty($object_peca->get_prioridade())) {
        	
        	}
        	
        	try {
        		$sql = "SELECT peca_id FROM tb_peca WHERE $pesquisa";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":du_id", $object_peca->get_dados_usuario()->get_usuario_id(), PDO::PARAM_INT);
        		/*$p_sql->bindValue(":sp_id", $object_peca->get_status(), PDO::PARAM_INT);
        		$p_sql->bindValue(":nome", $object_peca->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(":fabricante", $object_peca->get_fabricante(), PDO::PARAM_STR);
        		$p_sql->bindValue(":preco", $object_peca->get_preco(), PDO::PARAM_INT);
        		$p_sql->bindValue(":descricao", $object_peca->get_descricao(), PDO::PARAM_STR);
        		$p_sql->bindValue(":data", $object_peca->get_data_anuncio(), PDO::PARAM_STR);
        		$p_sql->bindValue(":serie", $object_peca->get_serie(), PDO::PARAM_STR);
        		$p_sql->bindValue(":prioridade", $object_peca->get_prioridade(), PDO::PARAM_BOOL);*/
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		
        		return ceil($cont / 9);
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Pecas(Object_Peca $object_peca, int $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	$pesquisa = "";
        	
        	if (!empty($object_peca->get_dados_usuario()->get_usuario_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_du_us_id = :du_id";
        	}
        	if (!empty($object_peca->get_status())) {
        		
        	}
        	if (!empty($object_peca->get_nome())) {
        		
        	}
        	if (!empty($object_peca->get_fabricante())) {
        		
        	}
        	if (!empty($object_peca->get_preco())) {
        		
        	}
        	if (!empty($object_peca->get_descricao())) {
        		
        	}
        	if (!empty($object_peca->get_data_anuncio())) {
        		
        	}
        	if (!empty($object_peca->get_serie())) {
        		
        	}
        	if (!empty($object_peca->get_prioridade())) {
        		
        	}
        	
        	try {
        		$sql = "SELECT peca_id, peca_du_us_id, peca_en_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade
        		FROM tb_peca WHERE $pesquisa LIMIT :inicio, :limite";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":du_id", $object_peca->get_dados_usuario()->get_usuario_id(), PDO::PARAM_INT);
        		/*$p_sql->bindValue(":sp_id", $object_peca->get_status(), PDO::PARAM_INT);
        		$p_sql->bindValue(":nome", $object_peca->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(":fabricante", $object_peca->get_fabricante(), PDO::PARAM_STR);
        		$p_sql->bindValue(":preco", $object_peca->get_preco(), PDO::PARAM_INT);
        		$p_sql->bindValue(":descricao", $object_peca->get_descricao(), PDO::PARAM_STR);
        		$p_sql->bindValue(":data", $object_peca->get_data_anuncio(), PDO::PARAM_STR);
        		$p_sql->bindValue(":serie", $object_peca->get_serie(), PDO::PARAM_STR);
        		$p_sql->bindValue(":prioridade", $object_peca->get_prioridade(), PDO::PARAM_BOOL);*/
        		$p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        		$p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function PopulaPeca(array $row) : Object_Peca {
            $object_peca = new Object_Peca();
            
            if (isset($row['peca_id'])) {
            	$object_peca->set_id($row['peca_id']);
            	$object_peca->set_fotos(DAO_Foto_Peca::Buscar_Fotos($row['peca_id']));
            }
            
            if (isset($row['peca_du_us_id'])) {
            	$object_peca->set_dados_usuario(DAO_Dados_Usuario::BuscarPorCOD($row['peca_du_us_id']));
            }
            
            if (isset($row['peca_en_id'])) {
            	$object_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Usuario($row['peca_en_id']));
            }
            
            if (isset($row['peca_sp_id'])) {
            	$object_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sp_id']));
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
        
        public static function PopulaPecas(array $rows) : array {
        	$object_pecas = array();
        	
        	foreach ($rows as $row) {
	        	$object_peca = new Object_Peca();
	        	
	        	if (isset($row['peca_id'])) {
	        		$object_peca->set_id($row['peca_id']);
	        		
	        		$fotos = DAO_Foto_Peca::Buscar_Fotos($row['peca_id']);
	        		
	        		if (!empty($fotos) AND $fotos !== false) {
	        			$object_peca->set_fotos($fotos);
	        		}
	        	}
	        	
	        	if (isset($row['peca_du_us_id'])) {
	        		$object_peca->set_dados_usuario(DAO_Dados_Usuario::BuscarPorCOD($row['peca_du_us_id']));
	        	}
	        	
	        	if (isset($row['peca_en_id'])) {
	        		$object_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Usuario($row['peca_en_id']));
	        	}
	        	
	        	if (isset($row['peca_sp_id'])) {
	        		$object_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sp_id']));
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