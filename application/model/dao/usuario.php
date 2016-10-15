<?php
namespace application\model\dao;
    
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Usuario as Object_Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Usuario {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Usuario $object_usuario) {
            try {
                $sql = "INSERT INTO tb_usuario (usuario_id, usuario_email, usuario_nome, usuario_senha, usuario_ultimo_login) 
                        VALUES (:id, :email, :nome, :senha, :login);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":email", $object_usuario->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":senha", $object_usuario->get_senha(), PDO::PARAM_STR);
				$p_sql->bindValue(":login", $object_usuario->get_ultimo_login(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Usuario $object_usuario) {
            try {
                $sql = "UPDATE tb_usuario SET
                usuario_nome = :nome,
                usuario_email = :email 
                WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $object_usuario->get_email(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar_Senha($senha, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_senha = :ps WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":ps", $senha, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
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
            } catch (PDOException $e) {
				return false;
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
				return false;
            }
        }

        public static function Atualizar_Ultimo_Login($login, $id) {
            try {
                $sql = "UPDATE tb_usuario SET usuario_ultimo_login = :ul WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->bindValue(":ul", $login, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_usuario WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
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
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Usuario($id) {
            try {
                $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_senha, usuario_ultimo_login, usuario_token_login FROM tb_usuario WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
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
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Autenticar($email) {
            try {
                $sql = "SELECT usuario_id, usuario_nome, usuario_email, usuario_senha, usuario_ultimo_login FROM tb_usuario WHERE usuario_email = :email";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":email", $email, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        private function PopulaUsuario($row) {
            $object_usuario = new Object_Usuario();
			
            $object_usuario->set_id($row['usuario_id']);
            $object_usuario->set_nome($row['usuario_nome']);
            $object_usuario->set_email($row['usuario_email']);
            $object_usuario->set_senha($row['usuario_senha']);
			$object_usuario->set_ultimo_login($row['usuario_ultimo_login']);
			$object_usuario->set_token($row['usuario_token_login']);
			
            return $object_usuario;
        }
    }
?>