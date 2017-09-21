<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Estado_Uso_Peca as Object_Estado_Uso_Peca;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Estado_Uso_Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Estado_Uso_Peca $object_estado_uso_peca) : bool {
            try {
                $sql = "INSERT INTO tb_estado_uso_peca (estado_uso_peca_id, estado_uso_peca_nome, estado_uso_peca_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_estado_uso_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_estado_uso_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_estado_uso_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Estado_Uso_Peca $object_estado_uso_peca) : bool {
            try {
                $sql = "UPDATE tb_estado_uso_peca SET estado_uso_peca_id = :id, estado_uso_peca_nome = :nome, estado_uso_peca_url = :url WHERE estado_uso_peca_id = :id";
				
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_estado_uso_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_estado_uso_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_estado_uso_peca->get_url(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
 		
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_estado_uso_peca WHERE estado_uso_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
		
        public static function Buscar_Id_Por_Url(string $url) {
        	try {
        		$sql = 'SELECT estado_uso_peca_id FROM tb_estado_uso_peca WHERE estado_uso_peca_url = :url';
        		
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
                $sql = 'SELECT estado_uso_peca_id, estado_uso_peca_nome, estado_uso_peca_url FROM tb_estado_uso_peca WHERE estado_uso_peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Estado_Uso_Peca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = 'SELECT estado_uso_peca_id, estado_uso_peca_nome, estado_uso_peca_url FROM tb_estado_uso_peca';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Estado_Uso_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Lista_Todos() {
        	try {
        		$sql = 'SELECT estado_uso_peca_id, estado_uso_peca_nome, estado_uso_peca_url FROM tb_estado_uso_peca';
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->execute();
        		
        		return self::Popular_Lista_Estado_Uso_Pecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Popular_Estado_Uso_Peca(array $row) : Object_Estado_Uso_Peca {
            $object_estado_uso_peca = new Object_Estado_Uso_Peca();
            
            if (isset($row['estado_uso_peca_id'])) {
            	$object_estado_uso_peca->set_id($row['estado_uso_peca_id']);
            }
            
            if (isset($row['estado_uso_peca_nome'])) {
            	$object_estado_uso_peca->set_nome($row['estado_uso_peca_nome']);
            }
            
            if (isset($row['estado_uso_peca_url'])) {
            	$object_estado_uso_peca->set_url($row['estado_uso_peca_url']);
            }
            
            return $object_estado_uso_peca;
        }
		
        public static function Popular_Estado_Uso_Pecas(array $rows) : array {
			$estado_uso_pecas = array();
			
			foreach ($rows as $row) {
	            $object_estado_uso_peca = new Object_Estado_Uso_Peca();
	            
	            if (isset($row['estado_uso_peca_id'])) {
	            	$object_estado_uso_peca->set_id($row['estado_uso_peca_id']);
	            }
	            
	            if (isset($row['estado_uso_peca_nome'])) {
	            	$object_estado_uso_peca->set_nome($row['estado_uso_peca_nome']);
	            }
	            
	            if (isset($row['estado_uso_peca_url'])) {
	            	$object_estado_uso_peca->set_url($row['estado_uso_peca_url']);
	            }
	            
	            $estado_uso_pecas[] = $object_estado_uso_peca;
			}
			
			return $estado_uso_pecas;
		}
		
		public static function Popular_Lista_Estado_Uso_Pecas(array $rows) : array {
			$estado_uso_pecas = array();
			
			foreach ($rows as $row) {
				if (isset($row['estado_uso_peca_id']) AND isset($row['estado_uso_peca_nome'])) {
					$estado_uso_pecas[$row['estado_uso_peca_id']] = $row['estado_uso_peca_nome'];
				}
			}
			
			return $estado_uso_pecas;
		}
    }
?>