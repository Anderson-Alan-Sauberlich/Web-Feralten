<?php
namespace application\model\dao;
    
    require_once(RAIZ.'/application/model/object/class_usuario.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
	@session_start();
    
    class DAO_Usuario {

        function __construct() {
            
        }
        
        public static function Inserir(Usuario $usuario) {
            try {
                $sql = "INSERT INTO tb_usuario (usuario_id, usuario_email, usuario_nome, usuario_senha, usuario_ultimo_login) 
                        VALUES (:id, :email, :nome, :senha, :login);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":email", $usuario->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":senha", $usuario->get_senha(), PDO::PARAM_STR);
				$p_sql->bindValue(":login", $usuario->get_ultimo_login(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                $_SESSION['erros_cadastrar'][] = "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Usuario $usuario) {
            try {
                $sql = "UPDATE tb_usuario SET
                usuario_nome = :nome,
                usuario_email = :email 
                WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $usuario->get_email(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar_Senha($senha, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_senha = :ps WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":ps", $senha, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
		
        public static function Atualizar_Token_Ultimo_Login($token, $login, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_token_login = :tk, usuario_ultimo_login = :ul WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":tk", $token, PDO::PARAM_STR);
				$p_sql->bindValue(":ul", $login, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar_Token($token, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_token_login = :tk WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":tk", $token, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }

        public static function Atualizar_Ultimo_Login($login, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_ultimo_login = :ul WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":ul", $login, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_usuario WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Verificar_Email($email) {
            try {
                $sql = "SELECT usuario_id FROM tb_usuario WHERE usuario_email = :email";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":email", $email, PDO::PARAM_STR);
                $p_sql->execute();
                $select = $p_sql->fetchAll();
                
                return count($select);
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Usuario($id) {
            try {
                $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_senha, usuario_ultimo_login, usuario_token_login FROM tb_usuario WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
		
        public static function Buscar_Senha_Usuario($id) {
            try {
                $sql = "SELECT usuario_senha FROM tb_usuario WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
				
				$row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                return $row['usuario_senha'];
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Autenticar($email) {
            try {
                $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_senha, usuario_ultimo_login FROM tb_usuario WHERE usuario_email = :email";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":email", $email, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaUsuario($row) {
            $usuario = new Usuario();
			
            $usuario->set_id($row['usuario_id']);
            $usuario->set_nome($row['usuario_nome']);
            $usuario->set_email($row['usuario_email']);
            $usuario->set_senha($row['usuario_senha']);
			$usuario->set_ultimo_login($row['usuario_ultimo_login']);
			$usuario->set_token($row['usuario_token_login']);
			
            return $usuario;
        }
    }
?>