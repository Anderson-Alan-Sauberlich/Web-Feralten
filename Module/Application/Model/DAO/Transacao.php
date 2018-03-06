<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Transacao as Object_Transacao;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Transacao
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Transacao $object_transacao) : bool
        {
            try {
                $sql = "INSERT INTO tb_transacao (transacao_id, transacao_ftr_id, transacao_datahora, transacao_valor, transacao_status, transacao_forma_pagamento) 
                        VALUES (:id, :ftr_id, :datahora, :vlr, :sts, :frm_pag);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_transacao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $object_transacao->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_transacao->get_datahora(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $object_transacao->get_valor(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts', $object_transacao->get_status(), PDO::PARAM_STR);
                $p_sql->bindValue(':frm_pag', $object_transacao->get_forma_pagamento(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Transacao $object_transacao) : bool
        {
            try {
                $sql = "UPDATE tb_transacao SET
                        transacao_id = :id,
                        transacao_ftr_id = :ftr_id,
                           transacao_datahora = :datahora,
                        transacao_valor = :vlr,
                        transacao_status = :sts,
                        transacao_forma_pagamento = :frm_pag 
                        WHERE transacao_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_transacao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $object_transacao->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_transacao->get_datahora(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $object_transacao->get_valor(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts', $object_transacao->get_status(), PDO::PARAM_STR);
                $p_sql->bindValue(':frm_pag', $object_transacao->get_forma_pagamento(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_transacao WHERE transacao_id = :id';
                
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
                $sql = 'SELECT transacao_id, transacao_ftr_id, transacao_datahora, transacao_valor, transacao_status, transacao_forma_pagamento FROM tb_transacao WHERE transacao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayTransacaos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayTransacaos(array $rows) : array
        {
            $transacoes = array();
            
            foreach ($rows as $row) {
                $object_transacao = new Object_Transacao();
                
                if (isset($row['transacao_id'])) {
                    $object_transacao->set_id($row['transacao_id']);
                }
                
                if (isset($row['transacao_ftr_id'])) {
                    $object_transacao->set_fatura_id($row['transacao_ftr_id']);
                }
                
                if (isset($row['transacao_datahora'])) {
                    $object_transacao->set_datahora($row['transacao_datahora']);
                }
                
                if (isset($row['transacao_valor'])) {
                    $object_transacao->set_valor($row['transacao_valor']);
                }
                
                if (isset($row['transacao_status'])) {
                    $object_transacao->set_status($row['transacao_status']);
                }
                
                if (isset($row['transacao_forma_pagamento'])) {
                    $object_transacao->set_forma_pagamento($row['transacao_forma_pagamento']);
                }
                
                $transacoes[] = $object_transacao;
            }
            
            return $transacoes;
        }
        
        public static function PopulaTransacao(array $row) : Object_Transacao
        {
            $object_transacao = new Object_Transacao();
            
            if (isset($row['transacao_id'])) {
                $object_transacao->set_id($row['transacao_id']);
            }
            
            if (isset($row['transacao_ftr_id'])) {
                $object_transacao->set_fatura_id($row['transacao_ftr_id']);
            }
            
            if (isset($row['transacao_datahora'])) {
                $object_transacao->set_datahora($row['transacao_datahora']);
            }
            
            if (isset($row['transacao_valor'])) {
                $object_transacao->set_valor($row['transacao_valor']);
            }
            
            if (isset($row['transacao_status'])) {
                $object_transacao->set_status($row['transacao_status']);
            }
            
            if (isset($row['transacao_forma_pagamento'])) {
                $object_transacao->set_forma_pagamento($row['transacao_forma_pagamento']);
            }
            
            return $object_transacao;
        }
    }
