<?php
namespace application\model\dao;
	
    require_once RAIZ.'/application/model/object/status_entidade.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
	
    use application\model\object\Status_Entidade as Object_Status_Entidade;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Status_Entidade {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Status_Entidade $object_status_entidade) : bool {
            try {
                $sql = "INSERT INTO tb_status_entidade (status_entidade_id, status_entidade_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_status_entidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_status_entidade->get_nome(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Status_Entidade $status) : bool {
            try {
                $sql = "UPDATE tb_status_entidade SET
                status_entidade_id = :id,
                status_entidade_nome = :nome 
                WHERE status_entidade_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_status_entidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_status_entidade->get_nome(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
 		
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_status_entidade WHERE status_entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
		
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT status_entidade_id, status_entidade_nome FROM tb_status_entidade WHERE status_entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaStatus($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function PopulaStatus(array $row) : Object_Status_Entidade {
            $object_status_entidade = new Object_Status_Entidade();
            
            if (isset($row['status_entidade_id'])) {
            	$object_status_entidade->set_id($row['status_entidade_id']);
            }
            
            if (isset($row['status_entidade_nome'])) {
            	$object_status_entidade->set_nome($row['status_entidade_nome']);
            }
            
            return $object_status_entidade;
        }                
    }
?>