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
        
        public static function Inserir(Object_Marca $object_marca) {
            try {
                $sql = "INSERT INTO tb_marca (marca_id, marca_ca_id, marca_nome) 
                        VALUES (:id, :ca_id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_marca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ca_id", $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_marca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Marca $object_marca) {
            try {
                $sql = "UPDATE tb_marca SET
                marca_id = :id,
                marca_ca_id = :ca_id,
                marca_nome = :nome 
                WHERE marca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_marca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ca_id", $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_marca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT marca_id, marca_ca_id, marca_nome FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Categoria_Id($id) {
            try {
                $sql = "SELECT marca_ca_id FROM tb_marca WHERE marca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['marca_ca_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Categorai($id) {
            try {
                $sql = "SELECT marca_id, marca_ca_id, marca_nome FROM tb_marca WHERE marca_ca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarcas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Categorai($id) {
        	try {
        		$sql = "SELECT marca_id FROM tb_marca WHERE marca_ca_id = :id";
        
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
        
        private function PopulaMarca($row) {
            $object_marca = new Object_Marca();
            
            $object_marca->set_id($row['marca_id']);
            $object_marca->set_categoria_id($row['marca_ca_id']);
            $object_marca->set_nome($row['marca_nome']);

            return $object_marca;
        }
        
        private function PopulaMarcas($rows) {
            $marcas = array();
            
            foreach ($rows as $row) {
                $object_marca = new Object_Marca();
                
                $object_marca->set_id($row['marca_id']);
                $object_marca->set_categoria_id($row['marca_ca_id']);
                $object_marca->set_nome($row['marca_nome']);
                
                $marcas[] = $object_marca;
            }

            return $marcas;
        }
    }
?>