<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/marca.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Marca as Object_Marca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Marca {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Marca $object_marca) : bool {
            try {
                $sql = "INSERT INTO tb_marca (marca_id, marca_ctg_id, marca_nome, marca_url) 
                        VALUES (fc_achar_id_livre_marca(:ca_id), :ca_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":ca_id", $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_marca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_marca->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Marca $object_marca) : bool {
            try {
                $sql = "UPDATE tb_marca SET marca_ctg_id = :ca_id, marca_nome = :nome, marca_url = :url WHERE marca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_marca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ca_id", $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_marca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(":url", $object_marca->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT marca_id, marca_ctg_id, marca_nome, marca_url FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id) {
        	try {
        		$sql = "SELECT marca_nome, marca_url FROM tb_marca WHERE marca_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        
        		return self::PopulaMarca($p_sql->fetch(PDO::FETCH_ASSOC));
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Categoria_Id(int $id) {
            try {
                $sql = "SELECT marca_ctg_id FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['marca_ctg_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Categorai(int $id) {
            try {
                $sql = "SELECT marca_id, marca_ctg_id, marca_nome, marca_url FROM tb_marca WHERE marca_ctg_id = :id ORDER BY marca_nome";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarcas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Categorai(int $id) {
        	try {
        		$sql = "SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
        		$id_marcas = array();
        		
        		foreach ($rows as $row) {
        			$id_marcas[] = $row['marca_id'];
        		}
        		
        		return $id_marcas;
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_ID_Por_URL(int $categoria_id, string $url) {
        	try {
        		$sql = "SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :ca_id AND marca_url = :url";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":ca_id", $categoria_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":url", $url, PDO::PARAM_STR);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        		return $row['marca_id'];
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Verificar_Marca_Repetida(Object_Marca $object_marca) : bool {
        	try {
        		$sql = "SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :ca_id AND (marca_nome = :nome OR marca_url = :url)";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":ca_id", $object_marca->get_categoria_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":nome", $object_marca->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(":url", $object_marca->get_url(), PDO::PARAM_STR);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        		if (!empty($row['marca_id']) AND $row['marca_id'] != $object_marca->get_id()) {
        			return false;
        		} else {
        			return true;
        		}
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function PopulaMarca(array $row) : Object_Marca {
            $object_marca = new Object_Marca();
            
            if (isset($row['marca_id'])) {
            	$object_marca->set_id($row['marca_id']);
            }
            
            if (isset($row['marca_ctg_id'])) {
            	$object_marca->set_categoria_id($row['marca_ctg_id']);
            }
            
            if (isset($row['marca_nome'])) {
            	$object_marca->set_nome($row['marca_nome']);
            }
            
            if (isset($row['marca_url'])) {
            	$object_marca->set_url($row['marca_url']);
            }
            
            return $object_marca;
        }
        
        public static function PopulaMarcas(array $rows) : array {
            $marcas = array();
            
            foreach ($rows as $row) {
                $object_marca = new Object_Marca();
                
                if (isset($row['marca_id'])) {
                	$object_marca->set_id($row['marca_id']);
                }
                
                if (isset($row['marca_ctg_id'])) {
                	$object_marca->set_categoria_id($row['marca_ctg_id']);
                }
                
                if (isset($row['marca_nome'])) {
                	$object_marca->set_nome($row['marca_nome']);
                }
                
                if (isset($row['marca_url'])) {
                	$object_marca->set_url($row['marca_url']);
                }
                
                $marcas[] = $object_marca;
            }

            return $marcas;
        }
    }
?>