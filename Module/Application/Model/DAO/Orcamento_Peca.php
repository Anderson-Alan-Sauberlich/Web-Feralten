<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Orcamento_Peca as Object_Orcamento_Peca;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Orcamento_Peca
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Orcamento_Peca $object_orcamento_peca) : bool
        {
            try {
                $sql = "INSERT INTO tb_orcamento_peca (orcamento_peca_orc_id, orcamento_peca_pec_id) 
                        VALUES (:orc_id, :pec_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':orc_id', $object_orcamento_peca->get_orcamento_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $object_orcamento_peca->get_peca_id(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Orcamento_Peca $object_orcamento_peca) : bool
        {
            try {
                $sql = "UPDATE tb_orcamento_peca SET
                orcamento_peca_orc_id = :orc_id,
                orcamento_peca_pec_id = :pec_id 
                WHERE orcamento_peca_orc_id = :orc_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':orc_id', $object_orcamento_peca->get_orcamento_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $object_orcamento_peca->get_peca_id(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_orcamento_peca WHERE orcamento_peca_orc_id = :id';
                
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
                $sql = 'SELECT orcamento_peca_orc_id, orcamento_peca_pec_id FROM tb_orcamento_peca WHERE orcamento_peca_orc_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaOrcamentosPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPecasPorCOD(int $id)
        {
            try {
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado FROM vw_orcamento_peca WHERE orcamento_peca_orc_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaOrcamentosPecas(array $rows) : array
        {
            $orcamento_pecas = array();
            
            foreach ($rows as $row) {
                $object_orcamento_peca = new Object_Orcamento_Peca();
                
                if (isset($row['orcamento_peca_orc_id'])) {
                    $object_orcamento_peca->set_orcamento_id($row['orcamento_peca_orc_id']);
                }
                
                if (isset($row['orcamento_peca_pec_id'])) {
                    $object_orcamento_peca->set_peca_id($row['orcamento_peca_pec_id']);
                }
                
                $orcamento_pecas[] = $object_orcamento_peca;
            }

            return $orcamento_pecas;
        }
        
        public static function PopulaOrcamentoPeca(array $row) : Object_Orcamento_Peca
        {
            $object_orcamento_peca = new Object_Orcamento_Peca();
            
            if (isset($row['orcamento_peca_orc_id'])) {
                $object_orcamento_peca->set_orcamento_id($row['orcamento_peca_orc_id']);
            }
            
            if (isset($row['orcamento_peca_pec_id'])) {
                $object_orcamento_peca->set_peca_id($row['orcamento_peca_pec_id']);
            }
            
            return $object_orcamento_peca;
        }
    }
