<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Transacao as OBJ_Transacao;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Transacao
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Transacao $obj_transacao) : bool
        {
            try {
                $sql = "INSERT INTO tb_transacao (transacao_id, transacao_ftr_id, transacao_datahora, transacao_valor, transacao_status, transacao_forma_pagamento, transacao_pags_codigo) 
                        VALUES (:id, :ftr_id, :datahora, :vlr, :sts, :frm_pag, :pags_codigo);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_transacao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $obj_transacao->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_transacao->get_datahora(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $obj_transacao->get_valor(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts', $obj_transacao->get_status(), PDO::PARAM_STR);
                $p_sql->bindValue(':frm_pag', $obj_transacao->get_forma_pagamento(), PDO::PARAM_STR);
                $p_sql->bindValue(':pags_codigo', $obj_transacao->get_pags_codigo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Transacao $obj_transacao) : bool
        {
            try {
                $sql = "UPDATE tb_transacao SET
                        transacao_id = :id,
                        transacao_ftr_id = :ftr_id,
                        transacao_datahora = :datahora,
                        transacao_valor = :vlr,
                        transacao_status = :sts,
                        transacao_forma_pagamento = :frm_pag,
                        transacao_pags_codigo = :pags_codigo 
                        WHERE transacao_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_transacao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $obj_transacao->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_transacao->get_datahora(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $obj_transacao->get_valor(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts', $obj_transacao->get_status(), PDO::PARAM_STR);
                $p_sql->bindValue(':frm_pag', $obj_transacao->get_forma_pagamento(), PDO::PARAM_STR);
                $p_sql->bindValue(':pags_codigo', $obj_transacao->get_pags_codigo(), PDO::PARAM_STR);

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
                $sql = 'SELECT transacao_id, transacao_ftr_id, transacao_datahora, transacao_valor, transacao_status, transacao_forma_pagamento, transacao_pags_codigo FROM tb_transacao WHERE transacao_id = :id';
                
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
                $obj_transacao = new OBJ_Transacao();
                
                if (isset($row['transacao_id'])) {
                    $obj_transacao->set_id($row['transacao_id']);
                }
                
                if (isset($row['transacao_ftr_id'])) {
                    $obj_transacao->set_fatura_id($row['transacao_ftr_id']);
                }
                
                if (isset($row['transacao_datahora'])) {
                    $obj_transacao->set_datahora($row['transacao_datahora']);
                }
                
                if (isset($row['transacao_valor'])) {
                    $obj_transacao->set_valor($row['transacao_valor']);
                }
                
                if (isset($row['transacao_status'])) {
                    $obj_transacao->set_status($row['transacao_status']);
                }
                
                if (isset($row['transacao_forma_pagamento'])) {
                    $obj_transacao->set_forma_pagamento($row['transacao_forma_pagamento']);
                }
                
                if (isset($row['transacao_pags_codigo'])) {
                    $obj_transacao->set_pags_codigo($row['transacao_pags_codigo']);
                }
                
                $transacoes[] = $obj_transacao;
            }
            
            return $transacoes;
        }
        
        public static function PopulaTransacao(array $row) : OBJ_Transacao
        {
            $obj_transacao = new OBJ_Transacao();
            
            if (isset($row['transacao_id'])) {
                $obj_transacao->set_id($row['transacao_id']);
            }
            
            if (isset($row['transacao_ftr_id'])) {
                $obj_transacao->set_fatura_id($row['transacao_ftr_id']);
            }
            
            if (isset($row['transacao_datahora'])) {
                $obj_transacao->set_datahora($row['transacao_datahora']);
            }
            
            if (isset($row['transacao_valor'])) {
                $obj_transacao->set_valor($row['transacao_valor']);
            }
            
            if (isset($row['transacao_status'])) {
                $obj_transacao->set_status($row['transacao_status']);
            }
            
            if (isset($row['transacao_forma_pagamento'])) {
                $obj_transacao->set_forma_pagamento($row['transacao_forma_pagamento']);
            }
            
            if (isset($row['transacao_pags_codigo'])) {
                $obj_transacao->set_pags_codigo($row['transacao_pags_codigo']);
            }
            
            return $obj_transacao;
        }
    }
