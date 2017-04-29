<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/versao.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
    
    use application\model\object\Versao as Object_Versao;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Versao {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Versao $object_versao) : bool {
            try {
                $sql = "INSERT INTO tb_versao (versao_id, versao_mdl_id, versao_nome, versao_url) 
                        VALUES (fc_achar_id_livre_versao(:mo_id), :mo_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":mo_id", $object_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_versao->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_versao->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Versao $object_versao) : bool {
            try {
                $sql = "UPDATE tb_versao SET versao_mdl_id = :mo_id, versao_nome = :nome, versao_url = :url WHERE versao_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_versao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":mo_id", $object_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_versao->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_versao->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT versao_id, versao_mdl_id, versao_nome, versao_url FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id) {
        	try {
        		$sql = "SELECT versao_nome, versao_url FROM tb_versao WHERE versao_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        
        		return self::PopulaVersao($p_sql->fetch(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Modelo_Id(int $id) {
            try {
                $sql = "SELECT versao_mdl_id FROM tb_versao WHERE versao_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['versao_mdl_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Modelo(int $id) {
            try {
                $sql = "SELECT versao_id, versao_mdl_id, versao_nome, versao_url FROM tb_versao WHERE versao_mdl_id = :id ORDER BY versao_nome";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersoes($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Modelo(int $id) {
        	try {
        		$sql = "SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :id";
        
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
        
        public static function Buscar_ID_Por_URL(int $modelo_id, string $url) {
        	try {
        		$sql = "SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :mo_id AND versao_url = :url";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":mo_id", $marca_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":url", $url, PDO::PARAM_STR);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        		return $row['versao_id'];
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Verificar_Versao_Repetida(Object_Versao $object_versao) : bool {
        	try {
        		$sql = "SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :mo_id AND (versao_nome = :nome OR versao_url = :url)";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":mo_id", $object_versao->get_modelo_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":nome", $object_versao->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(":url", $object_versao->get_url(), PDO::PARAM_STR);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        		
        		if (!empty($row['versao_id']) AND $row['versao_id'] != $object_versao->get_id()) {
        			return false;
        		} else {
        			return true;
        		}
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function PopulaVersao(array $row) : Object_Versao {
            $object_versao = new Object_Versao();
            
            if (isset($row['versao_id'])) {
            	$object_versao->set_id($row['versao_id']);
            }
            
            if (isset($row['versao_mdl_id'])) {
            	$object_versao->set_modelo_id($row['versao_mdl_id']);
            }
            
            if (isset($row['versao_nome'])) {
            	$object_versao->set_nome($row['versao_nome']);
            }
            
            if (isset($row['versao_url'])) {
            	$object_versao->set_url($row['versao_url']);
            }
            
            return $object_versao;
        }
        
        public static function PopulaVersoes(array $rows) : array {
            $versoes = array();
            
            foreach ($rows as $row) {
                $object_versao = new Object_Versao();
                
                if (isset($row['versao_id'])) {
                	$object_versao->set_id($row['versao_id']);
                }
                
                if (isset($row['versao_mdl_id'])) {
                	$object_versao->set_modelo_id($row['versao_mdl_id']);
                }
                
                if (isset($row['versao_nome'])) {
                	$object_versao->set_nome($row['versao_nome']);
                }
                
                if (isset($row['versao_url'])) {
                	$object_versao->set_url($row['versao_url']);
                }
                
                $versoes[] = $object_versao;
            }
			
            return $versoes;
        }
    }
?>