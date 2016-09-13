<?php
namespace application\model\dao;

	require_once(RAIZ.'/application/model/object/categoria_compativel.php');
	require_once(RAIZ.'/application/model/util/conexao.php');
	
	use application\model\object\Categoria_Compativel as Object_Categoria_Compativel;
	use application\model\util\Conexao;
	use \PDO;
	use \PDOException;
	
	class Categoria_Compativel {
	
		function __construct() {
	
		}
	
		public static function Inserir(Object_Categoria_Compativel $object_categoria_compativel) {
			try {
				$sql = "INSERT INTO tb_categoria_compativel (categoria_compativel_da_id_ca, categoria_compativel_com_id_ca)
	                    VALUES (:da_id, :com_id);";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $object_categoria_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_categoria_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
	
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Atualizar(Object_Categoria_Compativel $object_categoria_compativel) {
			try {
				$sql = "UPDATE tb_categoria_compativel SET categoria_compativel_da_id_ca = :da_id, categoria_compativel_com_id_ca = :com_id WHERE categoria_compativel_da_id_ca = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $object_categoria_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $object_categoria_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Deletar($id) {
			try {
				$sql = "DELETE FROM tb_categoria_compativel WHERE categoria_compativel_da_id_ca = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarTodos() {
			try {
				$sql = "SELECT categoria_compativel_da_id_ca, categoria_compativel_com_id_ca FROM tb_categoria_compativel";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->execute();
	
				return self::PopulaCategoriasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarPorCOD($id) {
			try {
				$sql = "SELECT categoria_compativel_com_id_ca FROM tb_categoria_compativel WHERE categoria_compativel_da_id_ca = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
				$p_sql->execute();
	
				return self::PopulaCategoriasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		private function PopulaCategoriaCompativel($row) {
			$object_categoria_compativel = new Object_Categoria_Compativel();
	
			$object_categoria_compativel->set_da_id($row['categoria_compativel_da_id_ca']);
			$object_categoria_compativel->set_com_id($row['categoria_compativel_com_id_ca']);
	
			return $object_categoria_compativel;
		}
	
		private function PopulaCategoriasCompativeis($rows) {
			$categorias_compativeis = array();
	
			foreach ($rows as $row) {
				$categorias_compativeis[] = $row['categoria_compativel_com_id_ca'];
			}
	
			return $categorias_compativeis;
		}
	}
?>