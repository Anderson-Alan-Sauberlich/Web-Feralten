<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Status_Fatura as Object_Status_Fatura;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Status_Fatura
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Status_Fatura $object_status_fatura) : bool
        {
            try {
                $sql = "INSERT INTO tb_status_fatura (status_fatura_id, status_fatura_descricao) 
                        VALUES (:id, :dsc);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_status_fatura->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_status_fatura->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Status_Fatura $object_status_fatura) : bool
        {
            try {
                $sql = "UPDATE tb_status_fatura SET
                		status_fatura_id = :id,
                		status_fatura_descricao = :dsc 
                		WHERE status_fatura_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_status_fatura->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $object_status_fatura->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 
         public static function Deletar(int $id) : bool
         {
            try {
                $sql = 'DELETE FROM tb_status_fatura WHERE status_fatura_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }

        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT status_fatura_id, status_fatura_descricao FROM tb_status_fatura WHERE status_fatura_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayStatusFaturas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function PopulaArrayStatusFaturas(array $rows) : array
        {
            $intervalos_pagamentos = array();
        	
        	foreach ($rows as $row) {
	        	$object_status_fatura = new Object_Status_Fatura();
	        	
	        	if (isset($row['status_fatura_id'])) {
	        		$object_status_fatura->set_id($row['status_fatura_id']);
	        	}
	        	
	        	if (isset($row['status_fatura_descricao'])) {
	        		$object_status_fatura->set_descricao($row['status_fatura_descricao']);
	        	}
	        	
	        	$intervalos_pagamentos[] = $object_status_fatura;
        	}
        	
        	return $intervalos_pagamentos;
        }
        
        public static function PopulaStatusFatura(array $row) : Object_Status_Fatura
        {
            $object_status_fatura = new Object_Status_Fatura();
            
            if (isset($row['status_fatura_id'])) {
            	$object_status_fatura->set_id($row['status_fatura_id']);
            }
            
            if (isset($row['status_fatura_descricao'])) {
            	$object_status_fatura->set_descricao($row['status_fatura_descricao']);
            }
            
            return $object_status_fatura;
        }
    }
