<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Acesso_Usuario as Object_Acesso_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Acesso_Usuario
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Acesso_Usuario $object_acesso_usuario) : bool
        {
            try {
                $sql = "INSERT INTO tb_acesso_usuario (acesso_usuario_usr_id, acesso_usuario_ent_id, acesso_usuario_fnc, acesso_usuario_pms_id) 
                        VALUES (:usr_id, :ent_id, :fnc_id, :pms_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':usr_id', $object_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_acesso_usuario->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fnc_id', $object_acesso_usuario->get_funcionalidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pms_id', $object_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Acesso_Usuario $object_acesso_usuario) : bool
        {
            try {
                $sql = "UPDATE tb_acesso_usuario SET
                        acesso_usuario_usr_id = :usr_id,
                        acesso_usuario_ent_id = :ent_id,
                           acesso_usuario_fnc = :fnc_id,
                        acesso_usuario_pms_id = :pms_id 
                        WHERE acesso_usuario_usr_id = :usr_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':usr_id', $object_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_acesso_usuario->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fnc_id', $object_acesso_usuario->get_funcionalidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pms_id', $object_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
         public static function Deletar(int $id) : bool
         {
            try {
                $sql = 'DELETE FROM tb_acesso_usuario WHERE acesso_usuario_usr_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }

        public static function BuscarPorCOD(int $usuario_id, int $entidade_id)
        {
            try {
                $sql = 'SELECT acesso_usuario_fnc, acesso_usuario_pms_id FROM tb_acesso_usuario WHERE acesso_usuario_usr_id = :usr_id AND acesso_usuario_ent_id = :ent_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':usr_id', $usuario_id, PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaArrayAcessos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayAcessos(array $rows) : array
        {
            $acessos = array();
            
            foreach ($rows as $row) {
                $object_acesso_usuario = new Object_Acesso_Usuario();
                
                if (isset($row['acesso_usuario_usr_id'])) {
                    $object_acesso_usuario->set_usuario_id($row['acesso_usuario_usr_id']);
                }
                
                if (isset($row['acesso_usuario_ent_id'])) {
                    $object_acesso_usuario->set_entidade_id($row['acesso_usuario_ent_id']);
                }
                
                if (isset($row['acesso_usuario_fnc'])) {
                    $object_acesso_usuario->set_funcionalidade_id($row['acesso_usuario_fnc']);
                }
                
                if (isset($row['acesso_usuario_pms_id'])) {
                    $object_acesso_usuario->set_permissao_id($row['acesso_usuario_pms_id']);
                }
                
                $acessos[] = $object_acesso_usuario;
            }
            
            return $acessos;
        }
        
        public static function PopulaAcesso(array $row) : Object_Acesso_Usuario
        {
            $object_acesso_usuario = new Object_Acesso_Usuario();
            
            if (isset($row['acesso_usuario_usr_id'])) {
                $object_acesso_usuario->set_usuario_id($row['acesso_usuario_usr_id']);
            }
            
            if (isset($row['acesso_usuario_ent_id'])) {
                $object_acesso_usuario->set_entidade_id($row['acesso_usuario_ent_id']);
            }
            
            if (isset($row['acesso_usuario_fnc'])) {
                $object_acesso_usuario->set_funcionalidade_id($row['acesso_usuario_fnc']);
            }
            
            if (isset($row['acesso_usuario_pms_id'])) {
                $object_acesso_usuario->set_permissao_id($row['acesso_usuario_pms_id']);
            }
            
            return $object_acesso_usuario;
        }
    }
