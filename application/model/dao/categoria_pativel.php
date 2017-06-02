<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/categoria_pativel.php';
    require_once RAIZ.'/application/model/object/peca.php';
    require_once RAIZ.'/application/model/dao/peca.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
    
    use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
    use application\model\object\Peca as Object_Peca;
    use application\model\dao\Peca as DAO_Peca;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
	
    class Categoria_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_categoria_pativel (categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_id) 
                        VALUES (:pec_id, :ctg_id, :ano_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pec_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ctg_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
				
				$proximo_id_ano = null;
				
				if (empty($object_categoria_pativel->get_anos())) {
					$p_sql->bindValue(":ano_id", null, PDO::PARAM_INT);
				} else {
					$proximo_id_ano = self::Pegar_Proximo_Id_Ano();
					
					$p_sql->bindValue(":ano_id", $proximo_id_ano, PDO::PARAM_INT);
				}
				
                if ($p_sql->execute()) {
                	$anos = $object_categoria_pativel->get_anos();
                	
                	if (!empty($anos) AND !empty($proximo_id_ano)) {
                		foreach ($anos as $ano) {
		                	$sql = "INSERT INTO tb_categoria_pativel_ano (categoria_pativel_ano_id, categoria_pativel_ano_ano)
		                        	VALUES (:ano_id, :ano);";
		                	
		                	$p_sql = Conexao::Conectar()->prepare($sql);
		                	
		                	$p_sql->bindValue(":ano_id", $proximo_id_ano, PDO::PARAM_INT);
		                	$p_sql->bindValue(":ano", $ano, PDO::PARAM_INT);
		                	
		                	$p_sql->execute();
                		}
                		
                		return true;
                	} else {
                		return true;
                	}
                } else {
                	return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar_Anos(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
            	if (self::Deletar_Anos($object_categoria_pativel->get_peca_id(), $object_categoria_pativel->get_categoria_id())) {
	            	$anos = $object_categoria_pativel->get_anos();
	            	
	            	if (!empty($anos)) {
	            		foreach ($anos as $ano) {
	            			$sql = "INSERT INTO tb_categoria_pativel_ano (categoria_pativel_ano_pec_id, categoria_pativel_ano_ctg_id, categoria_pativel_ano_ano)
			                        	VALUES (:pec_id, :ctg_id, :ano);";
	            			
	            			$p_sql = Conexao::Conectar()->prepare($sql);
	            			
	            			$p_sql->bindValue(":pec_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
	            			$p_sql->bindValue(":ctg_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
	            			$p_sql->bindValue(":ano", $ano, PDO::PARAM_INT);
	            			
	            			$p_sql->execute();
	            		}
	            		
	            		return true;
	            	} else {
	            		return true;
	            	}
            	} else {
            		return false;
            	}
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $peca_id, int $categoria_id) : bool {
        	try {
        		self::Deletar_Anos($peca_id, $categoria_id);
        		
        		$sql = "DELETE FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :pec_id AND categoria_pativel_ctg_id = :ctg_id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":ctg_id", $categoria_id, PDO::PARAM_INT);
        		
        		return $p_sql->execute();
        	} catch (Exception $e) {
        		return false;
        	}
        }
        
        public static function Deletar_Anos(int $peca_id, int $categoria_id) : bool {
            try {
                $sql = "DELETE FROM tb_categoria_pativel_ano WHERE categoria_pativel_ano_pec_id = :pec_id AND categoria_pativel_ano_ctg_id = :ctg_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(":ctg_id", $categoria_id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        private static function Pegar_Proximo_Id_Ano() : ?int {
        	try {
        		$sql = "SELECT fc_achar_id_livre_ano_categoria()";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return null;
        	}
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_ano FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Categoria_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(Object_Categoria_Pativel $object_categoria_pativel, Object_Peca $object_peca) {
        	try {
        		$pesquisa = "";
        		
        		$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca);
        		
        		$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_categoria_pativel);
        		
        		$sql = "SELECT peca_id FROM vw_categoria_peca WHERE $pesquisa";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_categoria_pativel);
        		
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		
        		return ceil($cont / 9);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Pecas(Object_Categoria_Pativel $object_categoria_pativel, Object_Peca $object_peca, int $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	$pesquisa = "";
        	
        	$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca);
        	
        	$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_categoria_pativel);
        	
        	try {
        		$sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade
        				FROM vw_categoria_peca WHERE $pesquisa LIMIT :inicio, :limite";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_categoria_pativel);
        		
        		$p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        		$p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, Object_Categoria_Pativel $object_categoria_pativel) : string {
        	if (!empty($object_categoria_pativel->get_peca_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_pec_id = :pec_id";
        	}
        	
        	if (!empty($object_categoria_pativel->get_categoria_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "categoria_pativel_ctg_id = :ctg_id";
        	}
        	
        	if (!empty($object_categoria_pativel->get_ano_de()) OR !empty($object_categoria_pativel->get_ano_ate())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND (";
        		}
        		
        		$pesquisa_ano = "";
        		
	        	if (!empty($object_categoria_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "categoria_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_categoria_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "categoria_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "categoria_pativel_ano_id IN (SELECT categoria_pativel_ano_id FROM tb_categoria_pativel_ano WHERE $pesquisa_ano)";
	        	
	        	if (!empty($pesquisa)) {
	        		$pesquisa .= " OR ";
	        	}
	        	
	        	$pesquisa_ano = "";
	        	
	        	if (!empty($object_categoria_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "marca_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_categoria_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "marca_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "marca_pativel_ano_id IN (SELECT marca_pativel_ano_id FROM tb_marca_pativel_ano WHERE $pesquisa_ano)";
	        	
	        	if (!empty($pesquisa)) {
	        		$pesquisa .= " OR ";
	        	}
	        	
	        	$pesquisa_ano = "";
	        	
	        	if (!empty($object_categoria_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "modelo_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_categoria_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "modelo_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "modelo_pativel_ano_id IN (SELECT modelo_pativel_ano_id FROM tb_modelo_pativel_ano WHERE $pesquisa_ano)";
	        	
	        	if (!empty($pesquisa)) {
	        		$pesquisa .= " OR ";
	        	}
	        	
	        	$pesquisa_ano = "";
	        	
	        	if (!empty($object_categoria_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_categoria_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "versao_pativel_ano_id IN (SELECT versao_pativel_ano_id FROM tb_versao_pativel_ano WHERE $pesquisa_ano))";
        	}
        	
        	return $pesquisa;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, Object_Categoria_Pativel $object_categoria_pativel) : PDOStatement {
        	if (!empty($object_categoria_pativel->get_peca_id())) {
        		$p_sql->bindValue(":pec_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_categoria_pativel->get_categoria_id())) {
        		$p_sql->bindValue(":ctg_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_categoria_pativel->get_ano_de())) {
        		$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_categoria_pativel->get_ano_ate())) {
        		$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);
        	}
        	
        	return $p_sql;
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