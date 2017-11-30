<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Status_Usuario as Object_Status_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Status_Usuario
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Status_Usuario $object_status_usuario) : bool
        {
            try {
                $sql = "INSERT INTO tb_status_usuario (status_usuario_id, status_usuario_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_status_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_status_usuario->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Status_Usuario $status) : bool
        {
            try {
                $sql = "UPDATE tb_status_usuario SET
                status_usuario_id = :id,
                status_usuario_nome = :nome 
                WHERE status_usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_status_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_status_usuario->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
         
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_status_usuario WHERE status_usuario_id = :id';
                
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
                $sql = 'SELECT status_usuario_id, status_usuario_nome FROM tb_status_usuario WHERE status_usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaStatus(array $row) : Object_Status_Usuario
        {
            $object_status_usuario = new Object_Status_Usuario();
            
            if (isset($row['status_usuario_id'])) {
                $object_status_usuario->set_id($row['status_usuario_id']);
            }
            
            if (isset($row['status_usuario_nome'])) {
                $object_status_usuario->set_nome($row['status_usuario_nome']);
            }
            
            return $object_status_usuario;
        }                
    }
