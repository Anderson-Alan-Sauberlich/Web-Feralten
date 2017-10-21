<?php
namespace module\application\model\dao;
	
	use module\application\model\object\Marca_Compativel as Object_Marca_Compativel;
	use module\application\model\common\util\Conexao;
	use \PDO;
	use \PDOException;
	use \Exception;
	
	class Marca_Compativel {
	
		function __construct() {
	
		}
	
		public static function Inserir(Object_Marca_Compativel $object_marca_compativel) : bool {
			try {
				$sql = "INSERT INTO tb_marca_compativel (marca_compativel_da_id_mrc, marca_compativel_com_id_mrc)
	                    VALUES (:da_id, :com_id);";
				
				$p_sql = Conexao::Conectar()->prepare($sql);
				
				$p_sql->bindValue(':da_id', $object_marca_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(':com_id', $object_marca_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (PDOException | Exception $e) {
				return false;
			}
		}
	
		public static function Atualizar(Object_Marca_Compativel $object_marca_compativel) : bool {
			try {
				$sql = "UPDATE tb_marca_compativel SET marca_compativel_da_id_mrc = :da_id, marca_compativel_com_id_mrc = :com_id WHERE marca_compativel_da_id_mrc = :da_id";
				
				$p_sql = Conexao::Conectar()->prepare($sql);
				
				$p_sql->bindValue(':da_id', $object_marca_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(':com_id', $object_marca_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (PDOException | Exception $e) {
				return false;
			}
		}
	
		public static function Deletar(int $id) : bool {
			try {
				$sql = 'DELETE FROM tb_marca_compativel WHERE marca_compativel_da_id_mrc = :id';
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(':id', $id, PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (PDOException | Exception $e) {
				return false;
			}
		}
	
		public static function BuscarTodos() {
			try {
				$sql = 'SELECT marca_compativel_da_id_mrc, marca_compativel_com_id_mrc FROM tb_marca_compativel';
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->execute();
	
				return self::PopulaMarcasCompativeisObject($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (PDOException | Exception $e) {
				return false;
			}
		}
	
		public static function BuscarPorCOD(int $id) {
			try {
				$sql = 'SELECT marca_compativel_com_id_mrc FROM tb_marca_compativel WHERE marca_compativel_da_id_mrc = :da_id';
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(':da_id', $id, PDO::PARAM_INT);
				$p_sql->execute();
	
				return self::PopulaMarcasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (PDOException | Exception $e) {
				return false;
			}
		}
	
		public static function PopulaMarcaCompativel(array $row) : Object_Marca_Compativel {
			$object_marca_compativel = new Object_Marca_Compativel();
			
			if (isset($row['marca_compativel_da_id_mrc'])) {
				$object_marca_compativel->set_da_id($row['marca_compativel_da_id_mrc']);
			}
			
			if (isset($row['marca_compativel_com_id_mrc'])) {
				$object_marca_compativel->set_com_id($row['marca_compativel_com_id_mrc']);
			}
			
			return $object_marca_compativel;
		}
		
		public static function PopulaMarcasCompativeisObject(array $rows) : array {
		    $marcas_compativeis = array();
		    
		    foreach ($rows as $row) {
    		    $object_marca_compativel = new Object_Marca_Compativel();
    		    
    		    if (isset($row['marca_compativel_da_id_mrc'])) {
    		        $object_marca_compativel->set_da_id($row['marca_compativel_da_id_mrc']);
    		    }
    		    
    		    if (isset($row['marca_compativel_com_id_mrc'])) {
    		        $object_marca_compativel->set_com_id($row['marca_compativel_com_id_mrc']);
    		    }
    		    
    		    $marcas_compativeis[] = $object_marca_compativel;
		    }
		    
		    return $marcas_compativeis;
		}
	
		public static function PopulaMarcasCompativeis(array $rows) : array {
			$marcas_compativeis = array();
	
			foreach ($rows as $row) {
				if (isset($row['marca_compativel_com_id_mrc'])) {
					$marcas_compativeis[] = $row['marca_compativel_com_id_mrc'];
				}
			}
	
			return $marcas_compativeis;
		}
	}
?>