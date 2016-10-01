<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

	class Dados_Usuario {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Dados_Usuario $object_dados_usuario) {
            try {
                $sql = "INSERT INTO tb_dados_usuario (dados_usuario_us_id, dados_usuario_su_id, dados_usuario_cpf_cnpj, dados_usuario_nome_fantasia,
                                                      dados_usuario_imagem, dados_usuario_site, dados_usuario_data_cadastro) VALUES (:us_id, :su_id, :cpf_cnpj, :nome, :imagem, :site, :data);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":su_id", $object_dados_usuario->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
                $p_sql->bindValue(":imagem", $object_dados_usuario->get_imagem(), PDO::PARAM_STR);
				$p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
                $p_sql->bindValue(":data", $object_dados_usuario->get_data(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Object_Dados_Usuario $object_dados_usuario) {
            try {
                $sql = "UPDATE tb_dados_usuario SET
                dados_usuario_cpf_cnpj = :cpf_cnpj,
                dados_usuario_nome_fantasia = :nome,
                dados_usuario_imagem = :imagem,
                dados_usuario_site = :site 
                WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
                $p_sql->bindValue(":imagem", $object_dados_usuario->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar_Dados(Object_Dados_Usuario $object_dados_usuario) {
            try {
                $sql = "UPDATE tb_dados_usuario SET
                dados_usuario_cpf_cnpj = :cpf_cnpj,
                dados_usuario_nome_fantasia = :nome,
                dados_usuario_site = :site 
                WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
				$p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar_Imagem($imagem, $usuario) {
            try {
                $sql = "UPDATE tb_dados_usuario SET dados_usuario_imagem = :imagem WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $usuario, PDO::PARAM_INT);
                $p_sql->bindValue(":imagem", $imagem, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Pegar_Status_Usuario($id) {
            try {
                $sql = "SELECT dados_usuario_su_id FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
                return $row['dados_usuario_su_id'];
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT dados_usuario_us_id, dados_usuario_su_id, dados_usuario_cpf_cnpj, dados_usuario_nome_fantasia, dados_usuario_imagem, dados_usuario_site, dados_usuario_data_cadastro 
                        FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaUsuario($row) {
            $object_dados_usuario = new Object_Dados_Usuario();
            
            $object_dados_usuario->set_usuario_id($row['dados_usuario_us_id']);
            $object_dados_usuario->set_status_id($row['dados_usuario_su_id']);
            $object_dados_usuario->set_cpf_cnpj($row['dados_usuario_cpf_cnpj']);
            $object_dados_usuario->set_nome_fantasia($row['dados_usuario_nome_fantasia']);
            $object_dados_usuario->set_imagem($row['dados_usuario_imagem']);
            $object_dados_usuario->set_site($row['dados_usuario_site']);
            $object_dados_usuario->set_data($row['dados_usuario_data_cadastro']);
            
            return $object_dados_usuario;
        }
	}
?>