<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Recuperar_Senha as Object_Recuperar_Senha;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Recuperar_Senha
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Recuperar_Senha $object_recuperar_senha) : bool
        {
            try {
                self::Deletar($object_recuperar_senha->get_object_usuario()->get_id());
                
                $sql = "INSERT INTO tb_recuperar_senha (recuperar_senha_usr_id, recuperar_senha_data_hora, recuperar_senha_codigo) 
                        VALUES (:usr_id, :data_hora, :codigo);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':usr_id', $object_recuperar_senha->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_hora', $object_recuperar_senha->get_data_hora(), PDO::PARAM_STR);
                $p_sql->bindValue(':codigo', $object_recuperar_senha->get_codigo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Recuperar_Senha $object_recuperar_senha) : bool
        {
            try {
                $sql = "UPDATE tb_recuperar_senha SET recuperar_senha_usuario_id = :usr_id, recuperar_senha_data_hora = :data_hora, recuperar_senha_codigo = :codigo WHERE recuperar_senha_usr_id = :usr_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':usr_id', $object_recuperar_senha->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_hora', $object_recuperar_senha->get_data_hora(), PDO::PARAM_STR);
                $p_sql->bindValue(':codigo', $object_recuperar_senha->get_codigo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
         
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_recuperar_senha WHERE recuperar_senha_usr_id = :usr_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':usr_id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCodigo(string $codigo)
        {
            try {
                $sql = 'SELECT recuperar_senha_usr_id, recuperar_senha_data_hora, recuperar_senha_codigo FROM tb_recuperar_senha WHERE recuperar_senha_codigo = :codigo';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':codigo', $codigo, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::Popular_Recuperar_Senha($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorId(int $id)
        {
            try {
                $sql = 'SELECT recuperar_senha_usr_id, recuperar_senha_data_hora, recuperar_senha_codigo FROM tb_recuperar_senha WHERE recuperar_senha_usr_id = :usr_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':usr_id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Recuperar_Senha($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT recuperar_senha_usr_id, recuperar_senha_data_hora, recuperar_senha_codigo FROM tb_recuperar_senha';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Recuperar_Senhas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popular_Recuperar_Senha(array $row) : Object_Recuperar_Senha
        {
            $object_recuperar_senha = new Object_Recuperar_Senha();
            
            if (isset($row['recuperar_senha_usr_id'])) {
                $object_recuperar_senha->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['recuperar_senha_usr_id']));
            }
            
            if (isset($row['recuperar_senha_data_hora'])) {
                $object_recuperar_senha->set_data_hora($row['recuperar_senha_data_hora']);
            }
            
            if (isset($row['recuperar_senha_codigo'])) {
                $object_recuperar_senha->set_codigo($row['recuperar_senha_codigo']);
            }
            
            return $object_recuperar_senha;
        }
        
        public static function Popular_Recuperar_Senhas(array $rows) : array
        {
            $recuperar_senhas = array();
            
            foreach ($rows as $row) {
                $object_recuperar_senha = new Object_Recuperar_Senha();
                
                if (isset($row['recuperar_senha_usr_id'])) {
                    $object_recuperar_senha->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['recuperar_senha_usr_id']));
                }
                
                if (isset($row['recuperar_senha_data_hora'])) {
                    $object_recuperar_senha->set_data_hora($row['recuperar_senha_data_hora']);
                }
                
                if (isset($row['recuperar_senha_codigo'])) {
                    $object_recuperar_senha->set_codigo($row['recuperar_senha_codigo']);
                }
                
                $recuperar_senhas[] = $object_recuperar_senha;
            }
            
            return $recuperar_senhas;
        }
    }
