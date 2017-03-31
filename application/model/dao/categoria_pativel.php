<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/categoria_pativel.php';
    require_once RAIZ.'/application/model/object/peca.php';
    require_once RAIZ.'/application/model/dao/peca.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
    use application\model\object\Peca as Object_Peca;
    use application\model\dao\Peca as DAO_Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Categoria_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_categoria_pativel (categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_de, categoria_pativel_ano_ate) 
                        VALUES (:pc_id, :ca_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
                $sql = "UPDATE tb_categoria_pativel SET
                categoria_pativel_pec_id = :pc_id,
                categoria_pativel_ctg_id = :ca_id,
                categoria_pativel_ano_de = :ano_de,
                categoria_pativel_ano_ate = :ano_ate 
                WHERE categoria_pativel_pec_id = :pc_id AND categoria_pativel_ctg_id = :ca_id";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_de, categoria_pativel_ano_ate FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Categoria_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(Object_Categoria_Pativel $object_categoria_pativel, Object_Peca $object_peca) {
        	try {
        		$sql = "SELECT peca_id FROM vw_categoria_peca WHERE categoria_pativel_pec_id = :pc_id OR categoria_pativel_ctg_id = :ca_id OR categoria_pativel_ano_de = :ano_de OR categoria_pativel_ano_ate = :ano_ate";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
        		$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		
        		return ceil($cont / 9);
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Pecas(Object_Categoria_Pativel $object_categoria_pativel, Object_Peca $object_peca, int $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	$pesquisa = "";
        	
        	if (!empty($object_categoria_pativel->get_peca_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_pec_id = :pc_id";
        	}
        	if (!empty($object_categoria_pativel->get_categoria_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_ctg_id = :ca_id";
        	}
        	if (!empty($object_categoria_pativel->get_ano_de())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_ano_de = :ano_de";
        	}
        	if (!empty($object_categoria_pativel->get_ano_ate())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_ano_ate = :ano_ate";
        	}
        	if (!empty($object_peca->get_dados_usuario()->get_usuario_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_entidade_id = :ent_id";
        	}
        	if (!empty($object_peca->get_status())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_sts_pec_id = :sp_id";
        	}
        	if (!empty($object_peca->get_nome())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_nome = :nome";
        	}
        	if (!empty($object_peca->get_fabricante())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_fabricante = :fabricante";
        	}
        	if (!empty($object_peca->get_preco())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_preco = :preco";
        	}
        	if (!empty($object_peca->get_descricao())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_descricao = :descricao";
        	}
        	if (!empty($object_peca->get_data_anuncio())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_data_anuncio = :data";
        	}
        	if (!empty($object_peca->get_serie())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_numero_serie = :serie";
        	}
        	if (!empty($object_peca->get_prioridade())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "peca_prioridade = :prioridade";
        	}
        	
        	try {
        		$sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade
        				FROM vw_categoria_peca WHERE $pesquisa LIMIT :inicio, :limite";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		//$p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
        		//$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
        		//$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);
        		$p_sql->bindValue(":ent_id", $object_peca->get_entidade()->get_usuario_id(), PDO::PARAM_INT);
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
        		
        		return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Popula_Categoria_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_categoria_pativel = new Object_Categoria_Pativel();
	            
	            if (isset($row['categoria_pativel_pec_id'])) {
	            	$object_categoria_pativel->set_peca_id($row['categoria_pativel_pec_id']);
	            }
	            
	            if (isset($row['categoria_pativel_ctg_id'])) {
	            	$object_categoria_pativel->set_categoria_id($row['categoria_pativel_ctg_id']);
	            }
	            
	            if (isset($row['categoria_pativel_ano_de'])) {
	            	$object_categoria_pativel->set_ano_de($row['categoria_pativel_ano_de']);
	            }
	            
	            if (isset($row['categoria_pativel_ano_ate'])) {
	            	$object_categoria_pativel->set_ano_ate($row['categoria_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_categoria_pativel;
			}
            
            return $pativeis;
        }
    }
?>