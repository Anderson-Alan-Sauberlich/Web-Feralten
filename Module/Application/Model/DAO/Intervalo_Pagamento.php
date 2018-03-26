<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Intervalo_Pagamento as OBJ_Intervalo_Pagamento;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Intervalo_Pagamento
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Intervalo_Pagamento $obj_intervalo_pagamento) : bool
        {
            try {
                $sql = "INSERT INTO tb_intervalo_pagamento (intervalo_pagamento_id, intervalo_pagamento_descricao) 
                        VALUES (:id, :dsc);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_intervalo_pagamento->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_intervalo_pagamento->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Intervalo_Pagamento $obj_intervalo_pagamento) : bool
        {
            try {
                $sql = "UPDATE tb_intervalo_pagamento SET
                        intervalo_pagamento_id = :id,
                        intervalo_pagamento_descricao = :dsc 
                        WHERE intervalo_pagamento_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_intervalo_pagamento->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_intervalo_pagamento->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
         public static function Deletar(int $id) : bool
         {
            try {
                $sql = 'DELETE FROM tb_intervalo_pagamento WHERE intervalo_pagamento_id = :id';
                
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
                $sql = 'SELECT intervalo_pagamento_id, intervalo_pagamento_descricao FROM tb_intervalo_pagamento WHERE intervalo_pagamento_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayIntervalosPagamentos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayIntervalosPagamentos(array $rows) : array
        {
            $intervalos_pagamentos = array();
            
            foreach ($rows as $row) {
                $obj_intervalo_pagamento = new OBJ_Intervalo_Pagamento();
                
                if (isset($row['intervalo_pagamento_id'])) {
                    $obj_intervalo_pagamento->set_id($row['intervalo_pagamento_id']);
                }
                
                if (isset($row['intervalo_pagamento_descricao'])) {
                    $obj_intervalo_pagamento->set_descricao($row['intervalo_pagamento_descricao']);
                }
                
                $intervalos_pagamentos[] = $obj_intervalo_pagamento;
            }
            
            return $intervalos_pagamentos;
        }
        
        public static function PopulaIntervaloPagamento(array $row) : OBJ_Intervalo_Pagamento
        {
            $obj_intervalo_pagamento = new OBJ_Intervalo_Pagamento();
            
            if (isset($row['intervalo_pagamento_id'])) {
                $obj_intervalo_pagamento->set_id($row['intervalo_pagamento_id']);
            }
            
            if (isset($row['intervalo_pagamento_descricao'])) {
                $obj_intervalo_pagamento->set_descricao($row['intervalo_pagamento_descricao']);
            }
            
            return $obj_intervalo_pagamento;
        }
    }
