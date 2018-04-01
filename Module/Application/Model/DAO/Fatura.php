<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Fatura as OBJ_Fatura;
    use Module\Application\Model\DAO\Status_Fatura as DAO_Status_Fatura;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Fatura
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Fatura $obj_fatura) : bool
        {
            try {
                $sql = "INSERT INTO tb_fatura (fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento) 
                        VALUES (:id, :ent_id, :vlr_ttl, :sts_ftr_id, :data_ems, :data_vcm, :data_fch);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_fatura->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_fatura->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vlr_ttl', $obj_fatura->get_valor_total(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts_ftr_id', $obj_fatura->get_obj_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_ems', $obj_fatura->get_data_emissao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_vcm', $obj_fatura->get_data_vencimento(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_fch', $obj_fatura->get_data_fechamento(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Fatura $obj_fatura) : bool
        {
            try {
                $sql = "UPDATE tb_fatura SET
                        fatura_id = :id,
                        fatura_ent_id = :ent_id,
                        fatura_valor_total = :vlr_ttl,
                        fatura_sts_ftr_id = :sts_ftr_id,
                        fatura_data_emissao = :data_ems,
                        fatura_data_vencimento = :data_vcm,
                        fatura_data_fechamento = :data_fch 
                        WHERE fatura_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_fatura->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_fatura->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vlr_ttl', $obj_fatura->get_valor_total(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts_ftr_id', $obj_fatura->get_obj_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_ems', $obj_fatura->get_data_emissao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_vcm', $obj_fatura->get_data_vencimento(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_fch', $obj_fatura->get_data_fechamento(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Status(int $fatura_id, int $status_id) : bool
        {
            try {
                $sql = "UPDATE tb_fatura SET
                        fatura_id = :id,
                        fatura_sts_ftr_id = :sts_ftr_id 
                        WHERE fatura_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $fatura_id, PDO::PARAM_INT);
                $p_sql->bindValue(':sts_ftr_id', $status_id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Valor_Total(int $fatura_id, float $valor_total) : bool
        {
            try {
                $sql = "UPDATE tb_fatura SET
                        fatura_id = :id,
                        fatura_valor_total = :vlr_ttl
                        WHERE fatura_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $fatura_id, PDO::PARAM_INT);
                $p_sql->bindValue(':vlr_ttl', $valor_total, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_fatura WHERE fatura_id = :id';
                
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
                $sql = 'SELECT fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento FROM tb_fatura WHERE fatura_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFatura($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCodStatus(int $entidade_id, int ...$status_id)
        {
            $query = '';
            
            foreach ($status_id as $id) {
                if (!empty($query)) {
                    $query .= " OR ";
                }
                
                $query .= "fatura_sts_ftr_id = :sts_id_$id";
            }
            
            try {
                $sql = "SELECT fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento FROM tb_fatura WHERE ($query) AND fatura_ent_id = :ent_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ent_id', $entidade_id, PDO::PARAM_INT);
                
                foreach ($status_id as $id) {
                    $p_sql->bindValue(":sts_id_$id", $id, PDO::PARAM_INT);
                }
                
                $p_sql->execute();
                
                return self::PopulaArrayFaturas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorStatusDataFechamento(int $status_id, string $data_fechamento)
        {
            try {
                $sql = 'SELECT fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento FROM tb_fatura WHERE fatura_sts_ftr_id = :sts_id AND fatura_data_fechamento <= :data_fch';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':sts_id', $status_id, PDO::PARAM_INT);
                $p_sql->bindValue(':data_fch', $data_fechamento, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaArrayFaturas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorStatusDataVencimento(int $status_id, string $data_vencimento)
        {
            try {
                $sql = 'SELECT fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento FROM tb_fatura WHERE fatura_sts_ftr_id = :sts_id AND fatura_data_vencimento <= :data_vcm';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':sts_id', $status_id, PDO::PARAM_INT);
                $p_sql->bindValue(':data_vcm', $data_vencimento, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaArrayFaturas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCODEntidade(int $entidade_id)
        {
            try {
                $sql = 'SELECT fatura_id, fatura_ent_id, fatura_valor_total, fatura_sts_ftr_id, fatura_data_emissao, fatura_data_vencimento, fatura_data_fechamento FROM tb_fatura WHERE fatura_ent_id = :ent_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ent_id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayFaturas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayFaturas(array $rows) : array
        {
            $faturas = array();
            
            foreach ($rows as $row) {
                $obj_fatura = new OBJ_Fatura();
                
                if (isset($row['fatura_id'])) {
                    $obj_fatura->set_id($row['fatura_id']);
                }
                
                if (isset($row['fatura_ent_id'])) {
                    $obj_fatura->set_entidade_id($row['fatura_ent_id']);
                }
                
                if (isset($row['fatura_valor_total'])) {
                    $obj_fatura->set_valor_total($row['fatura_valor_total']);
                }
                
                if (isset($row['fatura_sts_ftr_id'])) {
                    $obj_fatura->set_obj_status(DAO_Status_Fatura::BuscarPorCOD($row['fatura_sts_ftr_id']));
                }
                
                if (isset($row['fatura_data_emissao'])) {
                    $obj_fatura->set_data_emissao($row['fatura_data_emissao']);
                }
                
                if (isset($row['fatura_data_vencimento'])) {
                    $obj_fatura->set_data_vencimento($row['fatura_data_vencimento']);
                }
                
                if (isset($row['fatura_data_fechamento'])) {
                    $obj_fatura->set_data_fechamento($row['fatura_data_fechamento']);
                }
                
                $faturas[] = $obj_fatura;
            }
            
            return $faturas;
        }
        
        public static function PopulaFatura(array $row) : OBJ_Fatura
        {
            $obj_fatura = new OBJ_Fatura();
            
            if (isset($row['fatura_id'])) {
                $obj_fatura->set_id($row['fatura_id']);
            }
            
            if (isset($row['fatura_ent_id'])) {
                $obj_fatura->set_entidade_id($row['fatura_ent_id']);
            }
            
            if (isset($row['fatura_valor_total'])) {
                $obj_fatura->set_valor_total($row['fatura_valor_total']);
            }
            
            if (isset($row['fatura_sts_ftr_id'])) {
                $obj_fatura->set_obj_status(DAO_Status_Fatura::BuscarPorCOD($row['fatura_sts_ftr_id']));
            }
            
            if (isset($row['fatura_data_emissao'])) {
                $obj_fatura->set_data_emissao($row['fatura_data_emissao']);
            }
            
            if (isset($row['fatura_data_vencimento'])) {
                $obj_fatura->set_data_vencimento($row['fatura_data_vencimento']);
            }
            
            if (isset($row['fatura_data_fechamento'])) {
                $obj_fatura->set_data_fechamento($row['fatura_data_fechamento']);
            }
            
            return $obj_fatura;
        }
    }
