<?php
namespace application\model\dao;
	
	require_once RAIZ.'/application/model/object/modelo_compativel.php';
	require_once RAIZ.'/application/model/util/conexao.php';
	
	use application\model\object\Modelo_Compativel as Object_Modelo_Compativel;
	use application\model\util\Conexao;
	use \PDO;
	use \PDOException;
	
	class Modelo_Compativel {
	
		function __construct() {
	
		}
	
		public static function Inserir(Object_Modelo_Compativel $object_modelo_compativel) : bool {
			try {
				$sql = "INSERT INTO tb_modelo_compativel (modelo_compativel_id, modelo_compativel_da_id_mo, modelo_compativel_com_id_mo)
	                    VALUES (:id, :da_id, :com_id);";
				
				$p_sql = Conexao::Conectar()->prepare($sql);
				
				$p_sql->bindValue(":id", $object_modelo_compativel->get_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":da_id", $object_modelo_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_modelo_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
	
			} catch (PDOException $e) {
				return false;
			}
		}
	
		public static function Atualizar(Object_Modelo_Compativel $object_modelo_compativel) : bool {
			try {
				$sql = "UPDATE tb_modelo_compativel SET modelo_compativel_id = :id, modelo_compativel_da_id_mo = :da_id, modelo_compativel_com_id_mo = :com_id WHERE modelo_compativel_da_id_mo = :da_id";
				
				$p_sql = Conexao::Conectar()->prepare($sql);
				
				$p_sql->bindValue(":id", $object_modelo_compativel->get_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":da_id", $object_modelo_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_modelo_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (PDOException $e) {
				return false;
			}
		}
	
		public static function Deletar(int $id) : bool {
			try {
				$sql = "DELETE FROM tb_modelo_compativel WHERE modelo_compativel_id = :id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (PDOException $e) {
				return false;
			}
		}
	
		public static function BuscarTodos() {
			try {
				$sql = "SELECT modelo_compativel_da_id_mo, modelo_compativel_com_id_mo FROM tb_modelo_compativel";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->execute();
	
				return self::PopulaModelosCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (PDOException $e) {
				return false;
			}
		}
	
		public static function BuscarPorCOD(int $id) {
			try {
				$sql = "SELECT modelo_compativel_com_id_mo FROM tb_modelo_compativel WHERE modelo_compativel_da_id_mo = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
				$p_sql->execute();
	
				return self::PopulaModelosCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (PDOException $e) {
				return false;
			}
		}
	
		public static function PopulaModeloCompativel(array $row) : Object_Modelo_Compativel {
			$object_modelo_compativel = new Object_Modelo_Compativel();
			
			if (isset($row['modelo_compativel_id'])) {
				$object_modelo_compativel->set_id($row['modelo_compativel_id']);
			}
			
			if (isset($row['modelo_compativel_da_id_mo'])) {
				$object_modelo_compativel->set_da_id($row['modelo_compativel_da_id_mo']);
			}
			
			if (isset($row['modelo_compativel_com_id_mo'])) {
				$object_modelo_compativel->set_com_id($row['modelo_compativel_com_id_mo']);
			}
			
			return $object_modelo_compativel;
		}
	
		public static function PopulaModelosCompativeis(array $rows) : array {
			$modelos_compativeis = array();
	
			foreach ($rows as $row) {
				if (isset($row['modelo_compativel_com_id_mo'])) {
					$modelos_compativeis[] = $row['modelo_compativel_com_id_mo'];
				}
			}
	
			return $modelos_compativeis;
		}
	}
?>