<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Categoria as Object_Categoria;
    use module\application\model\object\Categoria_Compativel as Object_Categoria_Compativel;
    use module\application\model\dao\Categoria_Compativel as DAO_Categoria_Compativel;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Categoria {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Categoria $object_categoria) : bool {
            try {
                if (empty($object_categoria->get_id())) {
                    $object_categoria->set_id(self::Achar_ID_Livre());
                }
                
                $sql = "INSERT INTO tb_categoria (categoria_id, categoria_nome, categoria_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_categoria->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_categoria->get_url(), PDO::PARAM_STR);

                if ($p_sql->execute()) {
                    $object_categoria_compativel = new Object_Categoria_Compativel();
                    
                    $object_categoria_compativel->set_com_id($object_categoria->get_id());
                    $object_categoria_compativel->set_da_id($object_categoria->get_id());
                    
                    return DAO_Categoria_Compativel::Inserir($object_categoria_compativel);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Categoria $object_categoria) : bool {
            try {
                $sql = "UPDATE tb_categoria SET categoria_id = :id, categoria_nome = :nome, categoria_url = :url 
                		WHERE categoria_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_categoria->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_categoria->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                DAO_Categoria_Compativel::Deletar($id);
                
                $sql = 'DELETE FROM tb_categoria WHERE categoria_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Achar_ID_Livre() : ?int {
            try {
                $sql = 'SELECT fc_achar_id_livre_categoria()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = 'SELECT categoria_id, categoria_nome, categoria_url FROM tb_categoria';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaCategorias($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT categoria_id, categoria_nome, categoria_url FROM tb_categoria WHERE categoria_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCategoria($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id) {
        	try {
        		$sql = 'SELECT categoria_nome, categoria_url FROM tb_categoria WHERE categoria_id = :id';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':id', $id, PDO::PARAM_INT);
        		$p_sql->execute();
        
        		return self::PopulaCategoria($p_sql->fetch(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_ID_Por_URL(string $url) {
        	try {
        		$sql = 'SELECT categoria_id FROM tb_categoria WHERE categoria_url = :url';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':url', $url, PDO::PARAM_STR);
        		$p_sql->execute();
        
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Verificar_Categoria_Repetida(Object_Categoria $object_categoria) : bool {
        	try {
        		$sql = 'SELECT categoria_id FROM tb_categoria WHERE categoria_nome = :nome OR categoria_url = :url';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':nome', $object_categoria->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(':url', $object_categoria->get_url(), PDO::PARAM_STR);
        		$p_sql->execute();
        		
        		$categoria_id = $p_sql->fetch(PDO::FETCH_COLUMN);
        
        		if (!empty($categoria_id) AND $categoria_id != $object_categoria->get_id()) {
        			return false;
        		} else {
        			return true;
        		}
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function PopulaCategoria(array $row) : Object_Categoria {
            $object_categoria = new Object_Categoria();
            
            if (isset($row['categoria_id'])) {
            	$object_categoria->set_id($row['categoria_id']);
            }
            
            if (isset($row['categoria_nome'])) {
            	$object_categoria->set_nome($row['categoria_nome']);
            }
            
            if (isset($row['categoria_url'])) {
            	$object_categoria->set_url($row['categoria_url']);
            }
            
            return $object_categoria;
        }
        
        public static function PopulaCategorias(array $rows) : array {
            $categorias = array();
            
            foreach ($rows as $row) {
                $object_categoria = new Object_Categoria();
                
                if (isset($row['categoria_id'])) {
                	$object_categoria->set_id($row['categoria_id']);
                }
                
                if (isset($row['categoria_nome'])) {
                	$object_categoria->set_nome($row['categoria_nome']);
                }
                
                if (isset($row['categoria_url'])) {
                	$object_categoria->set_url($row['categoria_url']);
                }
                
                $categorias[] = $object_categoria;
            }
            
            return $categorias;
        }
    }
?>