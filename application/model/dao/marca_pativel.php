<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/marca_pativel.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
    
    use application\model\object\Marca_Pativel as Object_Marca_Pativel;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Marca_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Marca_Pativel $object_marca_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_marca_pativel (marca_pativel_pec_id, marca_pativel_mrc_id) 
                        VALUES (:pec_id, :mrc_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
				
                if ($p_sql->execute()) {
                	$anos = $object_marca_pativel->get_anos();
                	
                	if (!empty($anos)) {
	                	foreach ($anos as $ano) {
	                		$sql = "INSERT INTO tb_marca_pativel_ano (marca_pativel_ano_pec_id, marca_pativel_ano_mrc_id, marca_pativel_ano_ano)
		                        	VALUES (:pec_id, :mrc_id, :ano);";
	                		
	                		$p_sql = Conexao::Conectar()->prepare($sql);
	                		
	                		$p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
	                		$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
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
        
        public static function Atualizar_Anos(Object_Marca_Pativel $object_marca_pativel) : bool {
            try {
                if (self::Deletar_Anos($object_marca_pativel->get_peca_id(), $object_marca_pativel->get_marca_id())) {
                	$anos = $object_marca_pativel->get_anos();
                	
                	if (!empty($anos)) {
                		foreach ($anos as $ano) {
                			$sql = "INSERT INTO tb_marca_pativel_ano (marca_pativel_ano_pec_id, marca_pativel_ano_mrc_id, marca_pativel_ano_ano)
		                        	VALUES (:pec_id, :mrc_id, :ano);";
                			
                			$p_sql = Conexao::Conectar()->prepare($sql);
                			
                			$p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
                			$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
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
        
        public static function Deletar(int $peca_id, int $marca_id) : bool {
        	try {
        		self::Deletar_Anos($peca_id, $marca_id);
        		
        		$sql = "DELETE FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id AND marca_pativel_mrc_id = :mrc_id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":mrc_id", $marca_id, PDO::PARAM_INT);
        		
        		return $p_sql->execute();
        	} catch (Exception $e) {
        		return false;
        	}
        }
        
        public static function Deletar_Anos(int $peca_id, int $marca_id) : bool {
            try {
                $sql = "DELETE FROM tb_marca_pativel_ano WHERE marca_pativel_ano_pec_id = :pec_id AND marca_pativel_ano_mrc_id = :mrc_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(":mrc_id", $marca_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT marca_pativel_pec_id, marca_pativel_mrc_id, marca_pativel_ano_de, marca_pativel_ano_ate FROM tb_marca_pativel WHERE marca_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Marca_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Popula_Marca_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_marca_pativel = new Object_Marca_Pativel();
				
	            if (isset($row['marca_pativel_pec_id'])) {
	            	$object_marca_pativel->set_peca_id($row['marca_pativel_pec_id']);
	            }
	            
	            if (isset($row['marca_pativel_mrc_id'])) {
	            	$object_marca_pativel->set_marca_id($row['marca_pativel_mrc_id']);
	            }
	            
	            if (isset($row['marca_pativel_ano_de'])) {
	            	$object_marca_pativel->set_ano_de($row['marca_pativel_ano_de']);
	            }
	            
	            if (isset($row['marca_pativel_ano_ate'])) {
	            	$object_marca_pativel->set_ano_ate($row['marca_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_marca_pativel;
			}
            
            return $pativeis;
        }
    }
?>