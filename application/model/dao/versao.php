<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/versao.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Versao as Object_Versao;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Versao {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Versao $object_versao) {
            try {
                $sql = "INSERT INTO tb_versao (versao_id, versao_mo_id, versao_nome) 
                        VALUES (:id, :mo_id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_versao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":mo_id", $object_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_versao->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Versao $object_versao) {
            try {
                $sql = "UPDATE tb_versao SET
                versao_id = :id,
                versao_mo_id = :mo_id,
                versao_nome = :nome 
                WHERE versao_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_versao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":mo_id", $object_versao->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_versao->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT versao_id, versao_mo_id, versao_nome FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Modelo_Id($id) {
            try {
                $sql = "SELECT versao_mo_id FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['versao_mo_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Modelo($id) {
            try {
                $sql = "SELECT versao_id, versao_mo_id, versao_nome FROM tb_versao WHERE versao_mo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersoes($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Modelo($id) {
        	try {
        		$sql = "SELECT versao_id FROM tb_versao WHERE versao_mo_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
        		$id_versao = array();
        		
        		foreach ($rows as $row) {
        			$id_versao[] = $row['versao_id'];
        		}
        		
        		return $id_versao;
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        private static function PopulaVersao($row) {
            $object_versao = new Object_Versao();
            
            if (isset($row['versao_id'])) {
            	$object_versao->set_id($row['versao_id']);
            }
            
            if (isset($row['versao_mo_id'])) {
            	$object_versao->set_modelo_id($row['versao_mo_id']);
            }
            
            if (isset($row['versao_nome'])) {
            	$object_versao->set_nome($row['versao_nome']);
            }
            
            return $object_versao;
        }
        
        private static function PopulaVersoes($rows) {
            $versoes = array();
            
            foreach ($rows as $row) {
                $object_versao = new Object_Versao();
                
                if (isset($row['versao_id'])) {
                	$object_versao->set_id($row['versao_id']);
                }
                
                if (isset($row['versao_mo_id'])) {
                	$object_versao->set_modelo_id($row['versao_mo_id']);
                }
                
                if (isset($row['versao_nome'])) {
                	$object_versao->set_nome($row['versao_nome']);
                }
                
                $versoes[] = $object_versao;
            }
			
            return $versoes;
        }
    }
?>