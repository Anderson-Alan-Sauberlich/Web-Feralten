<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Fatura_Servico as OBJ_Fatura_Servico;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Fatura_Servico
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Fatura_Servico $obj_fatura_servico) : bool
        {
            try {
                if (empty($obj_fatura_servico->get_id()) AND !empty($obj_fatura_servico->get_fatura_id())) {
                    $id_fatura_servico = self::Pegar_Id_Livre($obj_fatura_servico->get_fatura_id());
                    
                    if (empty($id_fatura_servico)) {
                        $obj_fatura_servico->set_id(0);
                    } else {
                        $obj_fatura_servico->set_id($id_fatura_servico);
                    }
                }
                
                $sql = "INSERT INTO tb_fatura_servico (fatura_servico_id, fatura_servico_ftr_id, fatura_servico_descricao, fatura_servico_valor) 
                        VALUES (:id, :ftr_id, :dsc, :vlr);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_fatura_servico->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $obj_fatura_servico->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_fatura_servico->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $obj_fatura_servico->get_valor(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Fatura_Servico $obj_fatura_servico) : bool
        {
            try {
                $sql = "UPDATE tb_fatura_servico SET
                        fatura_servico_id = :id,
                        fatura_servico_ftr_id = :ftr_id,
                           fatura_servico_descricao = :dsc,
                        fatura_servico_valor = :vlr 
                        WHERE fatura_servico_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_fatura_servico->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ftr_id', $obj_fatura_servico->get_fatura_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_fatura_servico->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':vlr', $obj_fatura_servico->get_valor(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_fatura_servico WHERE fatura_servico_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        private static function Pegar_Id_Livre(int $fatura_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_fatura_servico(:ftr_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ftr_id', $fatura_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $fatura_id)
        {
            try {
                $sql = 'SELECT fatura_servico_id, fatura_servico_ftr_id, fatura_servico_descricao, fatura_servico_valor FROM tb_fatura_servico WHERE fatura_servico_ftr_id = :ftr_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ftr_id', $fatura_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayFaturasServicos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayFaturasServicos(array $rows) : array
        {
            $faturasServicos = array();
            
            foreach ($rows as $row) {
                $obj_fatura_servico = new OBJ_Fatura_Servico();
                
                if (isset($row['fatura_servico_id'])) {
                    $obj_fatura_servico->set_id($row['fatura_servico_id']);
                }
                
                if (isset($row['fatura_servico_ftr_id'])) {
                    $obj_fatura_servico->set_fatura_id($row['fatura_servico_ftr_id']);
                }
                
                if (isset($row['fatura_servico_descricao'])) {
                    $obj_fatura_servico->set_descricao($row['fatura_servico_descricao']);
                }
                
                if (isset($row['fatura_servico_valor'])) {
                    $obj_fatura_servico->set_valor($row['fatura_servico_valor']);
                }
                
                $faturasServicos[] = $obj_fatura_servico;
            }
            
            return $faturasServicos;
        }
        
        public static function PopulaFaturaServico(array $row) : OBJ_Fatura_Servico
        {
            $obj_fatura_servico = new OBJ_Fatura_Servico();
            
            if (isset($row['fatura_servico_id'])) {
                $obj_fatura_servico->set_id($row['fatura_servico_id']);
            }
            
            if (isset($row['fatura_servico_ftr_id'])) {
                $obj_fatura_servico->set_fatura_id($row['fatura_servico_ftr_id']);
            }
            
            if (isset($row['fatura_servico_descricao'])) {
                $obj_fatura_servico->set_descricao($row['fatura_servico_descricao']);
            }
            
            if (isset($row['fatura_servico_valor'])) {
                $obj_fatura_servico->set_valor($row['fatura_servico_valor']);
            }
            
            return $obj_fatura_servico;
        }
    }
