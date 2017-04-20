<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/modelo_pativel.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Modelo_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Modelo_Pativel $object_modelo_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_modelo_pativel (modelo_pativel_pec_id, modelo_pativel_mdl_id) 
                        VALUES (:pec_id, :mdl_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pec_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mdl_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
				
                if ($p_sql->execute()) {
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
            } catch (PDOException $e) {
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
            } catch (PDOException $e) {
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
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT modelo_pativel_pec_id, modelo_pativel_mdl_id, modelo_pativel_ano_de, modelo_pativel_ano_ate FROM tb_modelo_pativel WHERE modelo_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Modelo_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
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