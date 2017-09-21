<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Permissao as Object_Permissao;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Permissao {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Permissao $object_permissao) : bool {
            try {
                $sql = "INSERT INTO tb_permissao (permissao_id, permissao_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_permissao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_permissao->get_nome(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Permissao $permissao) : bool {
            try {
                $sql = "UPDATE tb_permissao SET
                permissao_id = :id,
                permissao_nome = :nome 
                WHERE permissao_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_permissao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_permissao->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_permissao WHERE permissao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }

        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT permissao_id, permissao_nome FROM tb_permissao WHERE permissao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPermissao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function PopulaPermissao(array $row) : Object_Permissao {
            $object_permissao = new Object_Permissao();
            
            if (isset($row['permissao_id'])) {
            	$object_permissao->set_id($row['permissao_id']);
            }
            
            if (isset($row['permissao_nome'])) {
            	$object_permissao->set_nome($row['permissao_nome']);
            }
            
            return $object_permissao;
        }                
    }
?>