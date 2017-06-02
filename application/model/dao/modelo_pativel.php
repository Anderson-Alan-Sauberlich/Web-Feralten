<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/modelo_pativel.php';
    require_once RAIZ.'/application/model/object/peca.php';
    require_once RAIZ.'/application/model/dao/peca.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
    
    use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
    use application\model\object\Peca as Object_Peca;
    use application\model\dao\Peca as DAO_Peca;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
	
    class Modelo_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Modelo_Pativel $object_modelo_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_modelo_pativel (modelo_pativel_pec_id, modelo_pativel_mdl_id, modelo_pativel_ano_id) 
                        VALUES (:pec_id, :mdl_id, :ano_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pec_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mdl_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
				
				$proximo_id_ano = null;
				
				if (empty($object_modelo_pativel->get_anos())) {
					$p_sql->bindValue(":ano_id", null, PDO::PARAM_INT);
				} else {
					$proximo_id_ano = self::Pegar_Proximo_Id_Ano();
					
					$p_sql->bindValue(":ano_id", $proximo_id_ano, PDO::PARAM_INT);
				}
				
                if ($p_sql->execute()) {
                	$anos = $object_modelo_pativel->get_anos();
                	
                	if (!empty($anos) AND !empty($proximo_id_ano)) {
	                	foreach ($anos as $ano) {
	                		$sql = "INSERT INTO tb_modelo_pativel_ano (modelo_pativel_ano_id, modelo_pativel_ano_ano)
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
        
        public static function Atualizar_Anos(Object_Modelo_Pativel $object_modelo_pativel) : bool {
            try {
                if (self::Deletar_Anos($object_modelo_pativel->get_peca_id(), $object_modelo_pativel->get_modelo_id())) {
                	$anos = $object_modelo_pativel->get_anos();
                	
                	if (!empty($anos)) {
                		foreach ($anos as $ano) {
                			$sql = "INSERT INTO tb_modelo_pativel_ano (modelo_pativel_ano_pec_id, modelo_pativel_ano_mdl_id, modelo_pativel_ano_ano)
		                        	VALUES (:pec_id, :mdl_id, :ano);";
                			
                			$p_sql = Conexao::Conectar()->prepare($sql);
                			
                			$p_sql->bindValue(":pec_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
                			$p_sql->bindValue(":mdl_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
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
        
        public static function Deletar(int $peca_id, int $modelo_id) : bool {
        	try {
        		self::Deletar_Anos($peca_id, $modelo_id);
        		
        		$sql = "DELETE FROM tb_modelo_pativel WHERE modelo_pativel_pec_id = :pec_id AND modelo_pativel_mdl_id = :mdl_id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":mdl_id", $modelo_id, PDO::PARAM_INT);
        		
        		return $p_sql->execute();
        	} catch (Exception $e) {
        		return false;
        	}
        }
        
        public static function Deletar_Anos(int $peca_id, int $modelo_id) : bool {
            try {
                $sql = "DELETE FROM tb_modelo_pativel_ano WHERE modelo_pativel_ano_pec_id = :pec_id AND modelo_pativel_ano_mdl_id = :mdl_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(":mdl_id", $modelo_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        private static function Pegar_Proximo_Id_Ano() : ?int {
        	try {
        		$sql = "SELECT fc_achar_id_livre_ano_modelo()";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return null;
        	}
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT modelo_pativel_pec_id, modelo_pativel_mdl_id, modelo_pativel_ano_de, modelo_pativel_ano_ate FROM tb_modelo_pativel WHERE modelo_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Modelo_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(Object_Modelo_Pativel $object_modelo_pativel, Object_Peca $object_peca) {
        	try {
        		$pesquisa = "";
        		
        		$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca);
        		
        		$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_modelo_pativel);
        		
        		$sql = "SELECT peca_id FROM vw_modelo_peca WHERE $pesquisa";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_modelo_pativel);
        		
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		
        		return ceil($cont / 9);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Pecas(Object_Modelo_Pativel $object_modelo_pativel, Object_Peca $object_peca, int $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	$pesquisa = "";
        	
        	$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca);
        	
        	$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_modelo_pativel);
        	
        	try {
        		$sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade
        		FROM vw_modelo_peca WHERE $pesquisa LIMIT :inicio, :limite";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_modelo_pativel);
        		
        		$p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        		$p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, Object_Modelo_Pativel $object_modelo_pativel) : string {
        	if (!empty($object_modelo_pativel->get_peca_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "modelo_pativel_pec_id = :pec_id";
        	}
        	
        	if (!empty($object_modelo_pativel->get_modelo_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "modelo_pativel_mdl_id = :mdl_id";
        	}
        	
        	if (!empty($object_modelo_pativel->get_ano_de()) OR !empty($object_modelo_pativel->get_ano_ate())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND (";
        		}
        		
        		$pesquisa_ano = "";
        		
	        	if (!empty($object_modelo_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "modelo_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_modelo_pativel->get_ano_ate())) {
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
	        	
	        	if (!empty($object_modelo_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_modelo_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "versao_pativel_ano_id IN (SELECT versao_pativel_ano_id FROM tb_versao_pativel_ano WHERE $pesquisa_ano))";
        	}
        	
        	return $pesquisa;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, Object_Modelo_Pativel $object_modelo_pativel) : PDOStatement {
        	if (!empty($object_modelo_pativel->get_peca_id())) {
        		$p_sql->bindValue(":pec_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_modelo_pativel->get_modelo_id())) {
        		$p_sql->bindValue(":mdl_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_modelo_pativel->get_ano_de())) {
        		$p_sql->bindValue(":ano_de", $object_modelo_pativel->get_ano_de(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_modelo_pativel->get_ano_ate())) {
        		$p_sql->bindValue(":ano_ate", $object_modelo_pativel->get_ano_ate(), PDO::PARAM_INT);
        	}
        	
        	return $p_sql;
        }
        
        public static function Popula_Modelo_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_modelo_pativel = new Object_Modelo_Pativel();
	            
	            if (isset($row['modelo_pativel_pec_id'])) {
	            	$object_modelo_pativel->set_peca_id($row['modelo_pativel_pec_id']);
	            }
	            
	            if (isset($row['modelo_pativel_mdl_id'])) {
	            	$object_modelo_pativel->set_modelo_id($row['modelo_pativel_mdl_id']);
	            }
	            
	            if (isset($row['modelo_pativel_ano_de'])) {
	            	$object_modelo_pativel->set_ano_de($row['modelo_pativel_ano_de']);
	            }
	            
	            if (isset($row['modelo_pativel_ano_ate'])) {
	            	$object_modelo_pativel->set_ano_ate($row['modelo_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_modelo_pativel;
			}
            
            return $pativeis;
        }
    }
?>