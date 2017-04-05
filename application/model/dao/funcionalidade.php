<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/funcionalidade.php';
    require_once RAIZ.'/application/model/util/conexao.php';
	
    use application\model\object\Funcionalidade as Object_Funcionalidade;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Funcionalidade {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Funcionalidade $object_funcionalidade) : bool {
            try {
                $sql = "INSERT INTO tb_funcionalidade (funcionalidade_id, funcionalidade_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_funcionalidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_funcionalidade->get_nome(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Funcionalidade $funcionalidade) : bool {
            try {
                $sql = "UPDATE tb_funcionalidade SET
                funcionalidade_id = :id,
                funcionalidade_nome = :nome 
                WHERE funcionalidade_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_funcionalidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_funcionalidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
 
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_funcionalidade WHERE funcionalidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }

        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT funcionalidade_id, funcionalidade_nome FROM tb_funcionalidade WHERE funcionalidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFuncionalidade($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function PopulaFuncionalidade(array $row) : Object_Funcionalidade {
            $object_funcionalidade = new Object_Funcionalidade();
            
            if (isset($row['funcionalidade_id'])) {
            	$object_funcionalidade->set_id($row['funcionalidade_id']);
            }
            
            if (isset($row['funcionalidade_nome'])) {
            	$object_funcionalidade->set_nome($row['funcionalidade_nome']);
            }
            
            return $object_funcionalidade;
        }                
    }
?>