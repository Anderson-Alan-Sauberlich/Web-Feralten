<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Acesso_Usuario as OBJ_Acesso_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Acesso_Usuario
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Acesso_Usuario $obj_acesso_usuario) : bool
        {
            try {
                $sql = "INSERT INTO tb_acesso_usuario (acesso_usuario_usr_id, acesso_usuario_ent_id, acesso_usuario_fnc, acesso_usuario_pms_id) 
                        VALUES (:usr_id, :ent_id, :fnc_id, :pms_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':usr_id', $obj_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_acesso_usuario->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fnc_id', $obj_acesso_usuario->get_funcionalidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pms_id', $obj_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Acesso_Usuario $obj_acesso_usuario) : bool
        {
            try {
                $sql = "UPDATE tb_acesso_usuario SET
                        acesso_usuario_usr_id = :usr_id,
                        acesso_usuario_ent_id = :ent_id,
                           acesso_usuario_fnc = :fnc_id,
                        acesso_usuario_pms_id = :pms_id 
                        WHERE acesso_usuario_usr_id = :usr_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':usr_id', $obj_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_acesso_usuario->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':fnc_id', $obj_acesso_usuario->get_funcionalidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pms_id', $obj_acesso_usuario->get_usuario_id(), PDO::PARAM_INT);

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
                $obj_acesso_usuario = new OBJ_Acesso_Usuario();
                
                if (isset($row['acesso_usuario_usr_id'])) {
                    $obj_acesso_usuario->set_usuario_id($row['acesso_usuario_usr_id']);
                }
                
                if (isset($row['acesso_usuario_ent_id'])) {
                    $obj_acesso_usuario->set_entidade_id($row['acesso_usuario_ent_id']);
                }
                
                if (isset($row['acesso_usuario_fnc'])) {
                    $obj_acesso_usuario->set_funcionalidade_id($row['acesso_usuario_fnc']);
                }
                
                if (isset($row['acesso_usuario_pms_id'])) {
                    $obj_acesso_usuario->set_permissao_id($row['acesso_usuario_pms_id']);
                }
                
                $acessos[] = $obj_acesso_usuario;
            }
            
            return $acessos;
        }
        
        public static function PopulaAcesso(array $row) : OBJ_Acesso_Usuario
        {
            $obj_acesso_usuario = new OBJ_Acesso_Usuario();
            
            if (isset($row['acesso_usuario_usr_id'])) {
                $obj_acesso_usuario->set_usuario_id($row['acesso_usuario_usr_id']);
            }
            
            if (isset($row['acesso_usuario_ent_id'])) {
                $obj_acesso_usuario->set_entidade_id($row['acesso_usuario_ent_id']);
            }
            
            if (isset($row['acesso_usuario_fnc'])) {
                $obj_acesso_usuario->set_funcionalidade_id($row['acesso_usuario_fnc']);
            }
            
            if (isset($row['acesso_usuario_pms_id'])) {
                $obj_acesso_usuario->set_permissao_id($row['acesso_usuario_pms_id']);
            }
            
            return $obj_acesso_usuario;
        }
    }
