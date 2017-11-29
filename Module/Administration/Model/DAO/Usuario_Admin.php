<?php
namespace Module\Administration\Model\DAO;
    
    use Module\Administration\Model\Object\Usuario_Admin as Object_Usuario_Admin;
    use Module\Administration\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Usuario_Admin
    {

        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Usuario_Admin $object_usuario_admin) : bool
        {
            try {
                $sql = "INSERT INTO tb_usuario_admin (usuario_admin_id, usuario_admin_usuario, usuario_admin_senha, usuario_admin_nome) 
                        VALUES (:id, :usuario, :senha, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_usuario_admin->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usuario', $object_usuario_admin->get_usuario(), PDO::PARAM_STR);
                $p_sql->bindValue(':senha', $object_usuario_admin->get_senha(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $object_usuario_admin->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Usuario_Admin $object_usuario_admin) : bool
        {
            try {
                $sql = "UPDATE tb_usuario_admin SET usuario_admin_nome = :nome, usuario_admin_usuario = :usuario WHERE usuario_admin_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_usuario_admin->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usuario', $object_usuario_admin->get_usuario(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $object_usuario_admin->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar_Senha(string $senha, int $id) : bool
        {
            try {
                $sql = "UPDATE tb_usuario_admin SET usuario_admin_senha = :ps WHERE usuario_admin_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->bindValue(':ps', $senha, PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_usuario_admin WHERE usuario_admin_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Verificar_Usuario(string $usuario)
        {
            try {
                $sql = 'SELECT usuario_admin_id FROM tb_usuario_admin WHERE usuario_admin_usuario = :usuario';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                $p_sql->execute();
                
                $usuario_admin_id = $p_sql->fetch(PDO::FETCH_COLUMN);
                
                $select = 0;
                
                if (!empty($usuario_admin_id)) {
                    $select = $usuario_admin_id;
                }
                
                return $select;
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Usuario(int $id)
        {
            try {
                $sql = 'SELECT usuario_admin_id, usuario_admin_usuario, usuario_admin_senha, usuario_admin_nome FROM tb_usuario_admin WHERE usuario_admin_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
		
        public static function Buscar_Senha_Usuario(int $id)
        {
            try {
                $sql = 'SELECT usuario_admin_senha FROM tb_usuario_admin WHERE usuario_admin_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
				
				$row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                return $row['usuario_admin_senha'];
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Autenticar(string $usuario)
        {
            try {
                $sql = 'SELECT usuario_admin_id, usuario_admin_usuario, usuario_admin_senha, usuario_admin_nome FROM tb_usuario_admin WHERE usuario_admin_usuario = :usuario';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                $p_sql->execute();
                
                $usuario = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($usuario) AND $usuario !== false) {
                	return self::PopulaUsuario($usuario);
                } else {
                	return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function PopulaUsuario(array $row) : Object_Usuario_Admin
        {
            $object_usuario_admin = new Object_Usuario_Admin();
			
            if (isset($row['usuario_admin_id'])) {
            	$object_usuario_admin->set_id($row['usuario_admin_id']);
            }
            
            if (isset($row['usuario_admin_usuario'])) {
            	$object_usuario_admin->set_usuario($row['usuario_admin_usuario']);
            }
            
            if (isset($row['usuario_admin_senha'])) {
            	$object_usuario_admin->set_senha($row['usuario_admin_senha']);
            }
            
            if (isset($row['usuario_admin_nome'])) {
            	$object_usuario_admin->set_nome($row['usuario_admin_nome']);
            }
            
            return $object_usuario_admin;
        }
    }
