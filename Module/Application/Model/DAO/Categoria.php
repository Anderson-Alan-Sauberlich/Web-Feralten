<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Categoria as OBJ_Categoria;
    use Module\Application\Model\OBJ\Categoria_Compativel as OBJ_Categoria_Compativel;
    use Module\Application\Model\DAO\Categoria_Compativel as DAO_Categoria_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Categoria
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Categoria $obj_categoria) : bool
        {
            try {
                if (empty($obj_categoria->get_id())) {
                    $obj_categoria->set_id(self::Achar_ID_Livre());
                }
                
                $sql = "INSERT INTO tb_categoria (categoria_id, categoria_nome, categoria_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_categoria->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_categoria->get_url(), PDO::PARAM_STR);

                if ($p_sql->execute()) {
                    $obj_categoria_compativel = new OBJ_Categoria_Compativel();
                    
                    $obj_categoria_compativel->set_com_id($obj_categoria->get_id());
                    $obj_categoria_compativel->set_da_id($obj_categoria->get_id());
                    
                    return DAO_Categoria_Compativel::Inserir($obj_categoria_compativel);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Categoria $obj_categoria) : bool
        {
            try {
                $sql = "UPDATE tb_categoria SET categoria_id = :id, categoria_nome = :nome, categoria_url = :url 
                        WHERE categoria_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_categoria->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_categoria->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_categoria WHERE categoria_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                if ($p_sql->execute()) {
                    return DAO_Categoria_Compativel::Deletar($id);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Achar_ID_Livre() : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_categoria()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT categoria_id, categoria_nome, categoria_url FROM tb_categoria';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaCategorias($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
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
        
        public static function Buscar_Nome_URL_Por_ID(int $id)
        {
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
        
        public static function Buscar_ID_Por_URL(string $url)
        {
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
        
        public static function Verificar_Categoria_Repetida(OBJ_Categoria $obj_categoria) : bool
        {
            try {
                $sql = 'SELECT categoria_id FROM tb_categoria WHERE categoria_nome = :nome OR categoria_url = :url';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':nome', $obj_categoria->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_categoria->get_url(), PDO::PARAM_STR);
                $p_sql->execute();
                
                $categoria_id = $p_sql->fetch(PDO::FETCH_COLUMN);
        
                if (!empty($categoria_id) AND $categoria_id != $obj_categoria->get_id()) {
                    return false;
                } else {
                    return true;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaCategoria(array $row) : OBJ_Categoria
        {
            $obj_categoria = new OBJ_Categoria();
            
            if (isset($row['categoria_id'])) {
                $obj_categoria->set_id($row['categoria_id']);
            }
            
            if (isset($row['categoria_nome'])) {
                $obj_categoria->set_nome($row['categoria_nome']);
            }
            
            if (isset($row['categoria_url'])) {
                $obj_categoria->set_url($row['categoria_url']);
            }
            
            return $obj_categoria;
        }
        
        public static function PopulaCategorias(array $rows) : array
        {
            $categorias = array();
            
            foreach ($rows as $row) {
                $obj_categoria = new OBJ_Categoria();
                
                if (isset($row['categoria_id'])) {
                    $obj_categoria->set_id($row['categoria_id']);
                }
                
                if (isset($row['categoria_nome'])) {
                    $obj_categoria->set_nome($row['categoria_nome']);
                }
                
                if (isset($row['categoria_url'])) {
                    $obj_categoria->set_url($row['categoria_url']);
                }
                
                $categorias[] = $obj_categoria;
            }
            
            return $categorias;
        }
    }
