<?php
namespace Module\Application\Model\DAO;
	
    use Module\Application\Model\Object\Marca as Object_Marca;
    use Module\Application\Model\Object\Marca_Compativel as Object_Marca_Compativel;
    use Module\Application\Model\DAO\Marca_Compativel as DAO_Marca_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Marca
    {

        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Marca $object_marca) : bool
        {
            try {
                if (empty($object_marca->get_id())) {
                    $object_marca->set_id(self::Achar_ID_Livre($object_marca->get_categoria_id()));
                }
                
                $sql = "INSERT INTO tb_marca (marca_id, marca_ctg_id, marca_nome, marca_url) 
                        VALUES (:id, :ca_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_marca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ca_id', $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_marca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_marca->get_url(), PDO::PARAM_STR);

                if ($p_sql->execute()) {
                    $object_marca_compativel = new Object_Marca_Compativel();
                    
                    $object_marca_compativel->set_com_id($object_marca->get_id());
                    $object_marca_compativel->set_da_id($object_marca->get_id());
                    
                    return DAO_Marca_Compativel::Inserir($object_marca_compativel);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Marca $object_marca) : bool
        {
            try {
                $sql = "UPDATE tb_marca SET marca_ctg_id = :ca_id, marca_nome = :nome, marca_url = :url WHERE marca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_marca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ca_id', $object_marca->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_marca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_marca->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                DAO_Marca_Compativel::Deletar($id);
                
                $sql = 'DELETE FROM tb_marca WHERE marca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Achar_ID_Livre(int $categoria_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_marca(:ca_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ca_id', $categoria_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT marca_id, marca_ctg_id, marca_nome, marca_url FROM tb_marca';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaMarcas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT marca_id, marca_ctg_id, marca_nome, marca_url FROM tb_marca WHERE marca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id)
        {
        	try {
        		$sql = 'SELECT marca_nome, marca_url FROM tb_marca WHERE marca_id = :id';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':id', $id, PDO::PARAM_INT);
        		$p_sql->execute();
        
        		return self::PopulaMarca($p_sql->fetch(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Categoria_Id(int $id)
        {
            try {
                $sql = 'SELECT marca_ctg_id FROM tb_marca WHERE marca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Categorai(int $id)
        {
            try {
                $sql = 'SELECT marca_id, marca_ctg_id, marca_nome, marca_url FROM tb_marca WHERE marca_ctg_id = :id ORDER BY marca_nome';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaMarcas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Categorai(int $id)
        {
        	try {
        		$sql = 'SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :id';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':id', $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
        		$id_marcas = array();
        		
        		foreach ($rows as $row) {
        			$id_marcas[] = $row['marca_id'];
        		}
        		
        		return $id_marcas;
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_ID_Por_URL(int $categoria_id, string $url)
        {
        	try {
        		$sql = 'SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :ca_id AND marca_url = :url';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':ca_id', $categoria_id, PDO::PARAM_INT);
        		$p_sql->bindValue(':url', $url, PDO::PARAM_STR);
        		$p_sql->execute();
        
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Verificar_Marca_Repetida(Object_Marca $object_marca) : bool
        {
        	try {
        		$sql = 'SELECT marca_id FROM tb_marca WHERE marca_ctg_id = :ca_id AND (marca_nome = :nome OR marca_url = :url)';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':ca_id', $object_marca->get_categoria_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(':nome', $object_marca->get_nome(), PDO::PARAM_STR);
        		$p_sql->bindValue(':url', $object_marca->get_url(), PDO::PARAM_STR);
        		$p_sql->execute();
        		
        		$marca_id = $p_sql->fetch(PDO::FETCH_COLUMN);
        
        		if (!empty($marca_id) AND $marca_id != $object_marca->get_id()) {
        			return false;
        		} else {
        			return true;
        		}
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function PopulaMarca(array $row) : Object_Marca
        {
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
        
        public static function PopulaMarcas(array $rows) : array
        {
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
