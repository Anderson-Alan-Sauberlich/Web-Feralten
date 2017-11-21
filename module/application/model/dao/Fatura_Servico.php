<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Fatura_Servico as Object_Fatura_Servico;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Fatura_Servico {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Fatura_Servico $object_fatura_servico) : bool {
            try {
                $sql = "INSERT INTO tb_fatura_servico (fatura_servico_id, fatura_servico_ftr_id, fatura_servico_descricao, fatura_servico_valor) 
                        VALUES (:id, :ftr_id, :dsc, :vlr);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_fatura_servico->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $object_fatura_servico->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_fatura_servico->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $object_fatura_servico->get_valor(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Fatura_Servico $object_fatura_servico) : bool {
            try {
                $sql = "UPDATE tb_fatura_servico SET
                		fatura_servico_id = :id,
                		fatura_servico_ftr_id = :ftr_id,
               			fatura_servico_descricao = :dsc,
                		fatura_servico_valor = :vlr 
                		WHERE fatura_servico_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_fatura_servico->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $object_fatura_servico->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_fatura_servico->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $object_fatura_servico->get_valor(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_fatura_servico WHERE fatura_servico_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT fatura_servico_id, fatura_servico_ftr_id, fatura_servico_descricao, fatura_servico_valor FROM tb_fatura_servico WHERE fatura_servico_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayFaturasServicos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function PopulaArrayFaturasServicos(array $rows) : array {
        	$faturasServicos = array();
        	
        	foreach ($rows as $row) {
	        	$object_fatura_servico = new Object_Fatura_Servico();
	        	
	        	if (isset($row['fatura_servico_id'])) {
	        		$object_fatura_servico->set_id($row['fatura_servico_id']);
	        	}
	        	
	        	if (isset($row['fatura_servico_ftr_id'])) {
	        		$object_fatura_servico->set_fatura_id($row['fatura_servico_ftr_id']);
	        	}
	        	
	        	if (isset($row['fatura_servico_descricao'])) {
	        		$object_fatura_servico->set_descricao($row['fatura_servico_descricao']);
	        	}
	        	
	        	if (isset($row['fatura_servico_valor'])) {
	        	    $object_fatura_servico->set_valor($row['fatura_servico_valor']);
	        	}
	        	
	        	$faturasServicos[] = $object_fatura_servico;
        	}
        	
        	return $faturasServicos;
        }
        
        public static function PopulaFaturaServico(array $row) : Object_Fatura_Servico {
            $object_fatura_servico = new Object_Fatura_Servico();
            
            if (isset($row['fatura_servico_id'])) {
                $object_fatura_servico->set_id($row['fatura_servico_id']);
            }
            
            if (isset($row['fatura_servico_ftr_id'])) {
                $object_fatura_servico->set_fatura_id($row['fatura_servico_ftr_id']);
            }
            
            if (isset($row['fatura_servico_descricao'])) {
                $object_fatura_servico->set_descricao($row['fatura_servico_descricao']);
            }
            
            if (isset($row['fatura_servico_valor'])) {
                $object_fatura_servico->set_valor($row['fatura_servico_valor']);
            }
            
            return $object_fatura_servico;
        }
    }
?>