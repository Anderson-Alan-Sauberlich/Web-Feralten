<?php
namespace application\model\dao;

	require_once(RAIZ.'/application/model/object/marca_compativel.php');
	require_once(RAIZ.'/application/model/util/conexao.php');
	
	use application\model\object\Marca_Compativel as Object_Marca_Compativel;
	use application\model\util\Conexao;
	use \PDO;
	use \PDOException;
	
	class Marca_Compativel {
	
		function __construct() {
	
		}
	
		public static function Inserir(Object_Marca_Compativel $object_marca_compativel) {
			try {
				$sql = "INSERT INTO tb_marca_compativel (marca_compativel_da_id_ma, marca_compativel_com_id_ma)
	                    VALUES (:da_id, :com_id);";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $object_marca_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_marca_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
	
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Atualizar(Object_Marca_Compativel $object_marca_compativel) {
			try {
				$sql = "UPDATE tb_marca_compativel SET marca_compativel_da_id_ma = :da_id, marca_compativel_com_id_ma = :com_id WHERE marca_compativel_da_id_ma = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $object_marca_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_marca_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Deletar($id) {
			try {
				$sql = "DELETE FROM tb_marca_compativel WHERE marca_compativel_da_id_ma = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarTodos() {
			try {
				$sql = "SELECT marca_compativel_da_id_ma, marca_compativel_com_id_ma FROM tb_marca_compativel";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->execute();
	
				return self::PopulaMarcasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarPorCOD($id) {
			try {
				$sql = "SELECT marca_compativel_com_id_ma FROM tb_marca_compativel WHERE marca_compativel_da_id_ma = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
				$p_sql->execute();
	
				return self::PopulaMarcasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		private function PopulaMarcaCompativel($row) {
			$object_marca_compativel = new Object_Marca_Compativel();
	
			$object_marca_compativel->set_da_id($row['marca_compativel_da_id_ma']);
			$object_marca_compativel->set_com_id($row['marca_compativel_com_id_ma']);
	
			return $object_marca_compativel;
		}
	
		private function PopulaMarcasCompativeis($rows) {
			$marcas_compativeis = array();
	
			foreach ($rows as $row) {
				$marcas_compativeis[] = $row['marca_compativel_com_id_ma'];
			}
	
			return $marcas_compativeis;
		}
	}
?>