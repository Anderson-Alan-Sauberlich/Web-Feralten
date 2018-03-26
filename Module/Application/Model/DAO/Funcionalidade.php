<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Funcionalidade as OBJ_Funcionalidade;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Funcionalidade
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Funcionalidade $obj_funcionalidade) : bool
        {
            try {
                $sql = "INSERT INTO tb_funcionalidade (funcionalidade_id, funcionalidade_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_funcionalidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_funcionalidade->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Funcionalidade $funcionalidade) : bool
        {
            try {
                $sql = "UPDATE tb_funcionalidade SET
                funcionalidade_id = :id,
                funcionalidade_nome = :nome 
                WHERE funcionalidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_funcionalidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_funcionalidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_funcionalidade WHERE funcionalidade_id = :id';
                
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
                $sql = 'SELECT funcionalidade_id, funcionalidade_nome FROM tb_funcionalidade WHERE funcionalidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFuncionalidade($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaFuncionalidade(array $row) : OBJ_Funcionalidade
        {
            $obj_funcionalidade = new OBJ_Funcionalidade();
            
            if (isset($row['funcionalidade_id'])) {
                $obj_funcionalidade->set_id($row['funcionalidade_id']);
            }
            
            if (isset($row['funcionalidade_nome'])) {
                $obj_funcionalidade->set_nome($row['funcionalidade_nome']);
            }
            
            return $obj_funcionalidade;
        }                
    }
