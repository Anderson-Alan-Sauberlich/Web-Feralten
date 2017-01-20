<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/modelo.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Modelo as Object_Modelo;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Modelo {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Modelo $object_modelo) : bool {
            try {
                $sql = "INSERT INTO tb_modelo (modelo_id, modelo_ma_id, modelo_nome, modelo_url) 
                        VALUES (fc_achar_id_livre_modelo(:ma_id), :ma_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":ma_id", $object_modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_modelo->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_modelo->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Modelo $object_modelo) : bool {
            try {
                $sql = "UPDATE tb_modelo SET modelo_id = :id, modelo_ma_id = :ma_id, modelo_nome = :nome, modelo_url = :url 
                		WHERE modelo_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_modelo->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ma_id", $object_modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_modelo->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_modelo->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT modelo_id, modelo_ma_id, modelo_nome, modelo_url FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelo($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id) {
        	try {
        		$sql = "SELECT modelo_nome, modelo_url FROM tb_modelo WHERE modelo_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        
        		return self::PopulaModelo($p_sql->fetch(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Marca_Id(int $id) {
            try {
                $sql = "SELECT modelo_ma_id FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['modelo_ma_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Marca(int $id) {
            try {
                $sql = "SELECT modelo_id, modelo_ma_id, modelo_nome, modelo_url FROM tb_modelo WHERE modelo_ma_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Marca(int $id) {
        	try {
        		$sql = "SELECT modelo_id FROM tb_modelo WHERE modelo_ma_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
        		$id_modelos = array();
        		
        		foreach ($rows as $row) {
        			$id_modelos[] = $row['modelo_id'];
        		}
        		
        		return $id_modelos;
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Verificar_Modelo_Repetido(Object_Modelo $object_modelo) : bool {
        	try {
        		$sql = "SELECT modelo_id FROM tb_modelo WHERE modelo_ma_id = :ma_id AND modelo_nome = :nome OR modelo_url = :url";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":ma_id", $object_modelo->get_marca_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":nome", $object_modelo->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(":url", $object_modelo->get_url(), PDO::PARAM_STR);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        		if (!empty($row['modelo_id'])) {
        			return false;
        		} else {
        			return true;
        		}
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        private static function PopulaModelo(array $row) : Object_Modelo {
            $object_modelo = new Object_Modelo();
            
            if (isset($row['modelo_id'])) {
            	$object_modelo->set_id($row['modelo_id']);
            }
            
            if (isset($row['modelo_ma_id'])) {
            	$object_modelo->set_marca_id($row['modelo_ma_id']);
            }
            
            if (isset($row['modelo_nome'])) {
            	$object_modelo->set_nome($row['modelo_nome']);
            }
            
            if (isset($row['modelo_url'])) {
            	$object_modelo->set_url($row['modelo_url']);
            }
            
            return $object_modelo;
        }
        
        private function PopulaModelos(array $rows) : array {
            $modelos = array();
            
            foreach ($rows as $row) {
                $object_modelo = new Object_Modelo();
                
                if (isset($row['modelo_id'])) {
                	$object_modelo->set_id($row['modelo_id']);
                }
                
                if (isset($row['modelo_ma_id'])) {
                	$object_modelo->set_marca_id($row['modelo_ma_id']);
                }
                
                if (isset($row['modelo_nome'])) {
                	$object_modelo->set_nome($row['modelo_nome']);
                }
                
                if (isset($row['modelo_url'])) {
                	$object_modelo->set_url($row['modelo_url']);
                }
                
                $modelos[] = $object_modelo;
            }
            
            return $modelos;
        }
    }
?>