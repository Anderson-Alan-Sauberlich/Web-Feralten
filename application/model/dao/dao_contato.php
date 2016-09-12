<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_contato.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Contato;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Contato {

        function __construct() {
            
        }
        
        public static function Inserir(Contato $contato) {
            try {
                
                $sql = "INSERT INTO tb_contato (contato_id, contato_du_us_id, contato_telefone1, contato_telefone2, contato_email) 
                        VALUES (:id, :du_ud_id, :fone1, :fone2, :email);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":id", $contato->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_ud_id", $contato->get_dados_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":fone1", $contato->get_telefone1(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone2", $contato->get_telefone2(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $contato->get_email(), PDO::PARAM_STR);
                
                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Contato $contato) {
            try {
                $sql = "UPDATE tb_contato SET
                contato_telefone1 = :fone1, 
                contato_telefone2 = :fone2, 
                contato_email = :email 
                WHERE contato_du_us_id = :du_ud_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":du_ud_id", $contato->get_dados_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":fone1", $contato->get_telefone1(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone2", $contato->get_telefone2(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $contato->get_email(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_contato WHERE contato_du_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Por_Id_Usuario($id) {
            try {
                $sql = "SELECT contato_id, contato_du_us_id, contato_telefone1, contato_telefone2, contato_email FROM tb_contato WHERE contato_du_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCategoria($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaCategoria($row) {
            $contato = new Contato();
            
            $contato->set_id($row['contato_id']);
            $contato->set_dados_usuario_id($row['contato_du_us_id']);
            $contato->set_telefone1($row['contato_telefone1']);
            $contato->set_telefone2($row['contato_telefone2']);
            $contato->set_email($row['contato_email']);
            
            return $contato;
        }
    }
?>