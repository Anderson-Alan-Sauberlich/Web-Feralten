<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Plano as Object_Plano;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Plano {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Plano $object_plano) : bool {
            try {
                $sql = "INSERT INTO tb_plano (plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao) 
                        VALUES (:id, :vlr_msl, :vlr_anl, :lmt_pcs, :dsc);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_plano->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_msl', $object_plano->get_valor_mensal(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_anl', $object_plano->get_valor_anual(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_lmt_pcs', $object_plano->get_limite_pecas(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_plano->get_descricao(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Plano $object_plano) : bool {
            try {
                $sql = "UPDATE tb_plano SET
                		plano_id = :id,
                		plano_valor_mensal = :vrl_msl,
               			plano_valor_anual = :vrl_anl,
                		plano_limite_pecas = :lmt_pcs,
                        plano_descricao = :dsc 
                		WHERE plano_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_plano->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_msl', $object_plano->get_valor_mensal(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_anl', $object_plano->get_valor_anual(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_lmt_pcs', $object_plano->get_limite_pecas(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_plano->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 
         public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = 'SELECT plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao FROM tb_plano';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaArrayPlanos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPlano($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Limite_Por_Id(int $id) {
            try {
                $sql = 'SELECT plano_limite_pecas FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayPlanos(array $rows) : array {
        	$planos = array();
        	
        	foreach ($rows as $row) {
	        	$object_plano = new Object_Plano();
	        	$bool = true;
	        	
	        	if (isset($row['plano_id'])) {
	        		$object_plano->set_id($row['plano_id']);
	        	} else {
	        	    $bool = false;
	        	}
	        	
	        	if (isset($row['plano_valor_mensal'])) {
	        		$object_plano->set_valor_mensal($row['plano_valor_mensal']);
	        	} else {
	        	    $bool = false;
	        	}
	        	
	        	if (isset($row['plano_valor_anual'])) {
	        		$object_plano->set_valor_anual($row['plano_valor_anual']);
	        	} else {
	        	    $bool = false;
	        	}
	        	
	        	if (isset($row['plano_limite_pecas'])) {
	        		$object_plano->set_limite_pecas($row['plano_limite_pecas']);
	        	} else {
	        	    $bool = false;
	        	}
	        	
	        	if (isset($row['plano_descricao'])) {
	        	    $object_plano->set_descricao($row['plano_descricao']);
	        	} else {
	        	    $bool = false;
	        	}
	        	
	        	if ($bool) {
	        	    $planos[$row['plano_id']] = $object_plano;
                }
        	}
        	
        	return $planos;
        }
        
        public static function PopulaPlano(array $row) : Object_Plano {
            $object_plano = new Object_Plano();
            
            if (isset($row['plano_id'])) {
                $object_plano->set_id($row['plano_id']);
            }
            
            if (isset($row['plano_valor_mensal'])) {
                $object_plano->set_valor_mensal($row['plano_valor_mensal']);
            }
            
            if (isset($row['plano_valor_anual'])) {
                $object_plano->set_valor_anual($row['plano_valor_anual']);
            }
            
            if (isset($row['plano_limite_pecas'])) {
                $object_plano->set_limite_pecas($row['plano_limite_pecas']);
            }
            
            if (isset($row['plano_descricao'])) {
                $object_plano->set_descricao($row['plano_descricao']);
            }
            
            return $object_plano;
        }
    }
?>