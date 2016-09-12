<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_status_usuario.php');
    require_once(RAIZ.'/application/model/util/conexao.php');

    use application\model\object\Status_Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Status_Usuario {
        
        function __construct() {
            
        }
        
        public static function Inserir(Status_Usuario $status) {
            try {
                                 
                $sql = "INSERT INTO tb_status_usuario (status_usuario_id, status_usuario_nome, status_usuario_descricao) 
                        VALUES (:id, :nome, :descricao);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $status->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $status->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":descricao", $status->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Editar(Status_Usuario $status) {
            try {
                $sql = "UPDATE tb_status_usuario SET
                status_usuario_id = :id,
                status_usuario_nome = :nome,
                status_usuario_descricao = :email,
                WHERE status_usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $status->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $status->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":descricao", $status->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
 
         public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_status_usuario WHERE status_usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }

        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT * FROM tb_status_usuario WHERE status_usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaStatus($row) {
            $status = new Status_Usuario();
            $status->set_id($row['status_usuario_id']);
            $status->set_nome($row['status_usuario_nome']);
            $status->set_descricao($row['status_usuario_descricao']);
            return $status;
        }                
    }
?>