<?php
namespace application\model\dao;
	
	require_once(RAIZ.'/application/model/object/class_versao_compativel.php');
	require_once(RAIZ.'/application/model/util/conexao.php');
	
	use application\model\object\Versao_Compativel;
	use application\model\util\Conexao;
	use \PDO;
	use \PDOException;
	
	class DAO_Versao_Compativel {
	
		function __construct() {
	
		}
	
		public static function Inserir(Versao_Compativel $versao_compativel) {
			try {
				$sql = "INSERT INTO tb_versao_compativel (versao_compativel_da_id_vs, versao_compativel_com_id_vs)
	                    VALUES (:da_id, :com_id);";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $versao_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $versao_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
	
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Atualizar(Versao_Compativel $versao_compativel) {
			try {
				$sql = "UPDATE tb_versao_compativel SET versao_compativel_da_id_vs = :da_id, versao_compativel_com_id_vs = :com_id WHERE versao_compativel_da_id_vs = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
	
				$p_sql->bindValue(":da_id", $versao_compativel->get_da_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":com_id", $versao_compativel->get_com_id(), PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function Deletar($id) {
			try {
				$sql = "DELETE FROM tb_versao_compativel WHERE versao_compativel_da_id_vs = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
	
				return $p_sql->execute();
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarTodos() {
			try {
				$sql = "SELECT versao_compativel_da_id_vs, versao_compativel_com_id_vs FROM tb_versao_compativel";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->execute();
	
				return self::PopulaVersoesCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		public static function BuscarPorCOD($id) {
			try {
				$sql = "SELECT versao_compativel_com_id_vs FROM tb_versao_compativel WHERE versao_compativel_da_id_vs = :da_id";
	
				$p_sql = Conexao::Conectar()->prepare($sql);
				$p_sql->bindValue(":da_id", $id, PDO::PARAM_INT);
				$p_sql->execute();
	
				return self::PopulaVersoesCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			}
		}
	
		private function PopulaVersaoCompativel($row) {
			$versao_compativel = new Versao_Compativel();
	
			$versao_compativel->set_da_id($row['versao_compativel_da_id_vs']);
			$versao_compativel->set_com_id($row['versao_compativel_com_id_vs']);
	
			return $versao_compativel;
		}
	
		private function PopulaVersoesCompativeis($rows) {
			$versoes_compativeis = array();
	
			foreach ($rows as $row) {
				$versoes_compativeis[] = $row['versao_compativel_com_id_vs'];
			}
	
			return $versoes_compativeis;
		}
	}
?>