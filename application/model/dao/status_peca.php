<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/status_peca.php');
    require_once(RAIZ.'/application/model/util/conexao.php');

    use application\model\object\Status_Peca as Object_Status_Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class Status_Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Status_Peca $object_status_peca) {
            try {
                                 
                $sql = "INSERT INTO tb_status_peca (status_peca_id, status_peca_nome, status_peca_descricao) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_status_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_status_peca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Editar(Object_Status_Peca $object_status_peca) {
            try {
                $sql = "UPDATE tb_status_peca SET status_peca_id = :id, status_peca_nome = :nome WHERE status_peca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_status_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_status_peca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
 
         public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_status_peca WHERE status_peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }

        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT status_peca_id, status_peca_nome FROM tb_status_peca WHERE status_peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Status_Peca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = "SELECT status_peca_id, status_peca_nome FROM tb_status_peca";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Status_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function Popular_Status_Peca($row) {
            $object_status_peca = new Object_Status_Peca();
            
            $object_status_peca->set_id($row['status_peca_id']);
            $object_status_peca->set_nome($row['status_peca_nome']);
            
            return $object_status_peca;
        }
		
		private function Popular_Status_Pecas($rows) {
			$status_pecas = array();
			
			foreach ($rows as $row) {
	            $object_status_peca = new Object_Status_Peca();
	            
	            $object_status_peca->set_id($row['status_peca_id']);
	            $object_status_peca->set_nome($row['status_peca_nome']);
	            
	            $status_pecas[] = $object_status_peca;
			}
			
			return $status_pecas;
		}
    }
?>