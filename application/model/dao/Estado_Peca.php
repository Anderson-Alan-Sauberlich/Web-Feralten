<?php
namespace application\model\dao;
	
    use application\model\object\Estado_Peca as Object_Estado_Peca;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Estado_Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Estado_Peca $object_estado_peca) : bool {
            try {
                $sql = "INSERT INTO tb_estado_peca (estado_peca_id, estado_peca_nome, estado_peca_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_estado_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_estado_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_estado_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Estado_Peca $object_estado_peca) : bool {
            try {
                $sql = "UPDATE tb_estado_peca SET estado_peca_id = :id, estado_peca_nome = :nome, estado_peca_url = :url WHERE estado_peca_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_estado_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_estado_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_estado_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 		
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_estado_peca WHERE estado_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
		
        public static function Buscar_Id_Por_Url(string $url) {
        	try {
        		$sql = 'SELECT estado_peca_id FROM tb_estado_peca WHERE estado_peca_url = :url';
        		
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
                $sql = 'SELECT estado_peca_id, estado_peca_nome, estado_peca_url FROM tb_estado_peca WHERE estado_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Estado_Peca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = 'SELECT estado_peca_id, estado_peca_nome, estado_peca_url FROM tb_estado_peca';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Estado_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Lista_Todos() {
        	try {
        		$sql = 'SELECT estado_peca_id, estado_peca_nome, estado_peca_url FROM tb_estado_peca';
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->execute();
        		
        		return self::Popular_Lista_Estado_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Popular_Estado_Peca(array $row) : Object_Estado_Peca {
            $object_estado_peca = new Object_Estado_Peca();
            
            if (isset($row['estado_peca_id'])) {
            	$object_estado_peca->set_id($row['estado_peca_id']);
            }
            
            if (isset($row['estado_peca_nome'])) {
            	$object_estado_peca->set_nome($row['estado_peca_nome']);
            }
            
            if (isset($row['estado_peca_url'])) {
            	$object_estado_peca->set_url($row['estado_peca_url']);
            }
            
            return $object_estado_peca;
        }
		
        public static function Popular_Estado_Pecas(array $rows) : array {
			$estado_pecas = array();
			
			foreach ($rows as $row) {
	            $object_estado_peca = new Object_Estado_Peca();
	            
	            if (isset($row['estado_peca_id'])) {
	            	$object_estado_peca->set_id($row['estado_peca_id']);
	            }
	            
	            if (isset($row['estado_peca_nome'])) {
	            	$object_estado_peca->set_nome($row['estado_peca_nome']);
	            }
	            
	            if (isset($row['estado_peca_url'])) {
	            	$object_estado_peca->set_url($row['estado_peca_url']);
	            }
	            
	            $estado_pecas[] = $object_estado_peca;
			}
			
			return $estado_pecas;
		}
		
		public static function Popular_Lista_Estado_Pecas(array $rows) : array {
			$estado_pecas = array();
			
			foreach ($rows as $row) {
				if (isset($row['estado_peca_id']) AND isset($row['estado_peca_nome'])) {
					$estado_pecas[$row['estado_peca_id']] = $row['estado_peca_nome'];
				}
			}
			
			return $estado_pecas;
		}
    }
?>