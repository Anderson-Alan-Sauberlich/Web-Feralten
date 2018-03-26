<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Usuario
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Usuario $obj_usuario) : bool
        {
            try {
                $sql = "INSERT INTO tb_usuario (usuario_id, usuario_email, usuario_nome, usuario_sobrenome, usuario_senha, usuario_ultimo_login, usuario_sts_usr_id, usuario_fone, usuario_fone_alternativo, usuario_email_alternativo) 
                        VALUES (:id, :email, :nome, :sobrenome, :senha, :login, :sts_id, :fone, :fone_alt, :email_alt);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':email', $obj_usuario->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $obj_usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':sobrenome', $obj_usuario->get_sobrenome(), PDO::PARAM_STR);
                $p_sql->bindValue(':senha', $obj_usuario->get_senha(), PDO::PARAM_STR);
                $p_sql->bindValue(':login', $obj_usuario->get_ultimo_login(), PDO::PARAM_STR);
                $p_sql->bindValue(':sts_id', $obj_usuario->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fone', $obj_usuario->get_fone(), PDO::PARAM_STR);
                $p_sql->bindValue(':fone_alt', $obj_usuario->get_fone_alternativo(), PDO::PARAM_STR);
                $p_sql->bindValue(':email_alt', $obj_usuario->get_email_alternativo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Usuario $obj_usuario) : bool
        {
            try {
                $sql = "UPDATE tb_usuario SET
                usuario_nome = :nome,
                usuario_sobrenome = :sobrenome,
                usuario_email = :email,
                usuario_fone = :fone, 
                usuario_fone_alternativo = :fone_alt, 
                usuario_email_alternativo = :email_alt 
                WHERE usuario_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_usuario->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':sobrenome', $obj_usuario->get_sobrenome(), PDO::PARAM_STR);
                $p_sql->bindValue(':email', $obj_usuario->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(':fone', $obj_usuario->get_fone(), PDO::PARAM_STR);
                $p_sql->bindValue(':fone_alt', $obj_usuario->get_fone_alternativo(), PDO::PARAM_STR);
                $p_sql->bindValue(':email_alt', $obj_usuario->get_email_alternativo(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Contato(OBJ_Usuario $obj_usuario) : bool
        {
            try {
                $sql = "UPDATE tb_usuario SET
                usuario_fone = :fone,
                usuario_fone_alternativo = :fone_alt,
                usuario_email_alternativo = :email_alt
                WHERE usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fone', $obj_usuario->get_fone(), PDO::PARAM_STR);
                $p_sql->bindValue(':fone_alt', $obj_usuario->get_fone_alternativo(), PDO::PARAM_STR);
                $p_sql->bindValue(':email_alt', $obj_usuario->get_email_alternativo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Status(int $status, int $id) : bool
        {
            try {
                $sql = 'UPDATE tb_usuario SET usuario_sts_usr = :sts WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->bindValue(':sts', $senha, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Senha(string $senha, int $id) : bool
        {
            try {
                $sql = 'UPDATE tb_usuario SET usuario_senha = :ps WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->bindValue(':ps', $senha, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Token_Ultimo_Login(OBJ_Usuario $obj_usuario) : bool
        {
            try {
                $sql = 'UPDATE tb_usuario SET usuario_token_login = :tk, usuario_ultimo_login = :ul WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':tk', $obj_usuario->get_token(), PDO::PARAM_STR);
                $p_sql->bindValue(':ul', $obj_usuario->get_ultimo_login(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Token(string $token = null, int $id) : bool
        {
            try {
                $sql = 'UPDATE tb_usuario SET usuario_token_login = :tk WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->bindValue(':tk', $token, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                return false;
            }
        }

        public static function Atualizar_Ultimo_Login(string $login, int $id) : bool
        {
            try {
                $sql = 'UPDATE tb_usuario SET usuario_ultimo_login = :ul WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->bindValue(':ul', $login, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_usuario WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Verificar_Email(string $email)
        {
            try {
                $sql = 'SELECT usuario_id FROM tb_usuario WHERE usuario_email = :email';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':email', $email, PDO::PARAM_STR);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                $select = 0;
                
                if (isset($row['usuario_id'])) {
                    $select = $row['usuario_id'];
                }
                
                return $select;
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Usuario(int $usuario_id)
        {
            try {
                $sql = 'SELECT usuario_id, usuario_nome, usuario_sobrenome, usuario_email, usuario_senha, usuario_ultimo_login, usuario_token_login, usuario_sts_usr_id, usuario_fone, usuario_fone_alternativo, usuario_email_alternativo FROM tb_usuario WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $usuario_id, PDO::PARAM_INT);
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
        
        public static function Buscar_Senha_Usuario(int $id)
        {
            try {
                $sql = 'SELECT usuario_senha FROM tb_usuario WHERE usuario_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);;
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Autenticar(string $email)
        {
            try {
                $sql = 'SELECT usuario_id, usuario_nome, usuario_sobrenome, usuario_email, usuario_senha, usuario_ultimo_login, usuario_sts_usr_id, usuario_fone, usuario_fone_alternativo, usuario_email_alternativo FROM tb_usuario WHERE usuario_email = :email';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':email', $email, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaUsuario(array $row) : OBJ_Usuario
        {
            $obj_usuario = new OBJ_Usuario();
            
            if (isset($row['usuario_id'])) {
                $obj_usuario->set_id($row['usuario_id']);
            }
            
            if (isset($row['usuario_nome'])) {
                $obj_usuario->set_nome($row['usuario_nome']);
            }
            
            if (isset($row['usuario_sobrenome'])) {
                $obj_usuario->set_sobrenome($row['usuario_sobrenome']);
            }
            
            if (isset($row['usuario_email'])) {
                $obj_usuario->set_email($row['usuario_email']);
            }
            
            if (isset($row['usuario_senha'])) {
                $obj_usuario->set_senha($row['usuario_senha']);
            }
            
            if (isset($row['usuario_ultimo_login'])) {
                $obj_usuario->set_ultimo_login($row['usuario_ultimo_login']);
            }
            
            if (isset($row['usuario_token_login'])) {
                $obj_usuario->set_token($row['usuario_token_login']);
            }
            
            if (isset($row['usuario_sts_usr_id'])) {
                $obj_usuario->set_status_id($row['usuario_sts_usr_id']);
            }
            
            if (isset($row['usuario_fone'])) {
                $obj_usuario->set_fone($row['usuario_fone']);
            }
            
            if (isset($row['usuario_fone_alternativo'])) {
                $obj_usuario->set_fone_alternativo($row['usuario_fone_alternativo']);
            }
            
            if (isset($row['usuario_email_alternativo'])) {
                $obj_usuario->set_email_alternativo($row['usuario_email_alternativo']);
            }
            
            return $obj_usuario;
        }
    }
