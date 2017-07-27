<?php
namespace application\model\dao;
	
    use application\model\object\Status_Peca as Object_Status_Peca;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Status_Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Status_Peca $object_status_peca) : bool {
            try {
                $sql = "INSERT INTO tb_status_peca (status_peca_id, status_peca_nome, status_peca_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_status_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_status_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_status_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Status_Peca $object_status_peca) : bool {
            try {
                $sql = "UPDATE tb_status_peca SET status_peca_id = :id, status_peca_nome = :nome, status_peca_url = :url WHERE status_peca_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_status_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_status_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_status_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 		
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_status_peca WHERE status_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
		
        public static function Buscar_Id_Por_Url(string $url) {
        	try {
        		$sql = 'SELECT status_peca_id FROM tb_status_peca WHERE status_peca_url = :url';
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':url', $url, PDO::PARAM_STR);
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT status_peca_id, status_peca_nome, status_peca_url FROM tb_status_peca WHERE status_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Status_Peca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Todos() {
            try {
                $sql = 'SELECT status_peca_id, status_peca_nome, status_peca_url FROM tb_status_peca';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Status_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Lista_Todos() {
        	try {
        		$sql = 'SELECT status_peca_id, status_peca_nome, status_peca_url FROM tb_status_peca';
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->execute();
        		
        		return self::Popular_Lista_Status_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Popular_Status_Peca(array $row) : Object_Status_Peca {
            $object_status_peca = new Object_Status_Peca();
            
            if (isset($row['status_peca_id'])) {
            	$object_status_peca->set_id($row['status_peca_id']);
            }
            
            if (isset($row['status_peca_nome'])) {
            	$object_status_peca->set_nome($row['status_peca_nome']);
            }
            
            if (isset($row['status_peca_url'])) {
            	$object_status_peca->set_url($row['status_peca_url']);
            }
            
            return $object_status_peca;
        }
		
        public static function Popular_Status_Pecas(array $rows) : array {
			$status_pecas = array();
			
			foreach ($rows as $row) {
	            $object_status_peca = new Object_Status_Peca();
	            
	            if (isset($row['status_peca_id'])) {
	            	$object_status_peca->set_id($row['status_peca_id']);
	            }
	            
	            if (isset($row['status_peca_nome'])) {
	            	$object_status_peca->set_nome($row['status_peca_nome']);
	            }
	            
	            if (isset($row['status_peca_url'])) {
	            	$object_status_peca->set_url($row['status_peca_url']);
	            }
	            
	            $status_pecas[] = $object_status_peca;
			}
			
			return $status_pecas;
		}
		
		public static function Popular_Lista_Status_Pecas(array $rows) : array {
			$status_pecas = array();
			
			foreach ($rows as $row) {
				if (isset($row['status_peca_id']) AND isset($row['status_peca_nome'])) {
					$status_pecas[$row['status_peca_id']] = $row['status_peca_nome'];
				}
			}
			
			return $status_pecas;
		}
    }
?>