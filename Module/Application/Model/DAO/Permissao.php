<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Permissao as OBJ_Permissao;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Permissao
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Permissao $obj_permissao) : bool
        {
            try {
                $sql = "INSERT INTO tb_permissao (permissao_id, permissao_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_permissao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_permissao->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Permissao $permissao) : bool
        {
            try {
                $sql = "UPDATE tb_permissao SET
                permissao_id = :id,
                permissao_nome = :nome 
                WHERE permissao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_permissao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_permissao->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_permissao WHERE permissao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }

        public static function BuscarPorCOD(int $id)
        {
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
        
        public static function PopulaPermissao(array $row) : OBJ_Permissao
        {
            $obj_permissao = new OBJ_Permissao();
            
            if (isset($row['permissao_id'])) {
                $obj_permissao->set_id($row['permissao_id']);
            }
            
            if (isset($row['permissao_nome'])) {
                $obj_permissao->set_nome($row['permissao_nome']);
            }
            
            return $obj_permissao;
        }                
    }
