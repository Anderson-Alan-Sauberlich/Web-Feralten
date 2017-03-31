<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/permissao_usuario.php';
    require_once RAIZ.'/application/model/util/conexao.php';
	
    use application\model\object\Permissao_Usuario as Object_Permissao_Usuario;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Permissao_Usuario {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Permissao_Usuario $object_permissao_usuario) : bool {
            try {
                $sql = "INSERT INTO tb_permissao_usuario (permissao_usuario_id, permissao_usuario_funcionalidade) 
                        VALUES (:id, :funcionalidade);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_permissao_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":funcionalidade", $object_permissao_usuario->get_funcionalidade(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Permissao_Usuario $permissao) : bool {
            try {
                $sql = "UPDATE tb_permissao_usuario SET
                permissao_usuario_id = :id,
                permissao_usuario_funcionalidade = :funcionalidade 
                WHERE permissao_usuario_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_permissao_usuario->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":funcionalidade", $object_permissao_usuario->get_funcionalidade(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
 
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_permissao_usuario WHERE permissao_usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }

        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT permissao_usuario_id, permissao_usuario_funcionalidade FROM tb_permissao_usuario WHERE permissao_usuario_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPermissao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function PopulaPermissao(array $row) : Object_Permissao_Usuario {
            $object_permissao_usuario = new Object_Permissao_Usuario();
            
            if (isset($row['permissao_usuario_id'])) {
            	$object_permissao_usuario->set_id($row['permissao_usuario_id']);
            }
            
            if (isset($row['permissao_usuario_funcionalidade'])) {
            	$object_permissao_usuario->set_funcionalidade($row['permissao_usuario_funcionalidade']);
            }
            
            return $object_permissao_usuario;
        }                
    }
?>