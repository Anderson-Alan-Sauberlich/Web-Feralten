<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Status_Entidade as OBJ_Status_Entidade;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Status_Entidade
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Status_Entidade $obj_status_entidade) : bool
        {
            try {
                $sql = "INSERT INTO tb_status_entidade (status_entidade_id, status_entidade_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_status_entidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_status_entidade->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Status_Entidade $status) : bool
        {
            try {
                $sql = "UPDATE tb_status_entidade SET
                status_entidade_id = :id,
                status_entidade_nome = :nome 
                WHERE status_entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_status_entidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_status_entidade->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
         
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_status_entidade WHERE status_entidade_id = :id';
                
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
                $sql = 'SELECT status_entidade_id, status_entidade_nome FROM tb_status_entidade WHERE status_entidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaStatus(array $row) : OBJ_Status_Entidade
        {
            $obj_status_entidade = new OBJ_Status_Entidade();
            
            if (isset($row['status_entidade_id'])) {
                $obj_status_entidade->set_id($row['status_entidade_id']);
            }
            
            if (isset($row['status_entidade_nome'])) {
                $obj_status_entidade->set_nome($row['status_entidade_nome']);
            }
            
            return $obj_status_entidade;
        }                
    }
