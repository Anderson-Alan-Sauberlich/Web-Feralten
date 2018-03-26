<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Categoria_Compativel as OBJ_Categoria_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Categoria_Compativel
    {
        function __construct()
        {
            
        }
    
        public static function Inserir(OBJ_Categoria_Compativel $obj_categoria_compativel) : bool
        {
            try {
                $sql = "INSERT INTO tb_categoria_compativel (categoria_compativel_da_id_ctg, categoria_compativel_com_id_ctg)
                        VALUES (:da_id, :com_id);";
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_categoria_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_categoria_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Atualizar(OBJ_Categoria_Compativel $obj_categoria_compativel) : bool
        {
            try {
                $sql = "UPDATE tb_categoria_compativel SET categoria_compativel_da_id_ctg = :da_id, categoria_compativel_com_id_ctg = :com_id 
                        WHERE categoria_compativel_da_id_ctg = :da_id";
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_categoria_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_categoria_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_categoria_compativel WHERE categoria_compativel_da_id_ctg = :da_id';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':da_id', $id, PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT categoria_compativel_da_id_ctg, categoria_compativel_com_id_ctg FROM tb_categoria_compativel';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
    
                return self::PopulaCategoriasCompativeisOBJ($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT categoria_compativel_com_id_ctg FROM tb_categoria_compativel WHERE categoria_compativel_da_id_ctg = :da_id';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':da_id', $id, PDO::PARAM_INT);
                $p_sql->execute();
    
                return self::PopulaCategoriasCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function PopulaCategoriaCompativel(array $row) : OBJ_Categoria_Compativel
        {
            $obj_categoria_compativel = new OBJ_Categoria_Compativel();
            
            if (isset($row['categoria_compativel_da_id_ctg'])) {
                $obj_categoria_compativel->set_da_id($row['categoria_compativel_da_id_ctg']);
            }
            
            if (isset($row['categoria_compativel_com_id_ctg'])) {
                $obj_categoria_compativel->set_com_id($row['categoria_compativel_com_id_ctg']);
            }
            
            return $obj_categoria_compativel;
        }
        
        public static function PopulaCategoriasCompativeisOBJ(array $rows) : array
        {
            $categorias_compativeis = array();
            
            foreach ($rows as $row) {
                $obj_categoria_compativel = new OBJ_Categoria_Compativel();
                
                if (isset($row['categoria_compativel_da_id_ctg'])) {
                    $obj_categoria_compativel->set_da_id($row['categoria_compativel_da_id_ctg']);
                }
                
                if (isset($row['categoria_compativel_com_id_ctg'])) {
                    $obj_categoria_compativel->set_com_id($row['categoria_compativel_com_id_ctg']);
                }
                
                $categorias_compativeis[] = $obj_categoria_compativel;
            }
            
            return $categorias_compativeis;
        }
    
        public static function PopulaCategoriasCompativeis(array $rows) : array
        {
            $categorias_compativeis = array();
    
            foreach ($rows as $row) {
                if (isset($row['categoria_compativel_com_id_ctg'])) {
                    $categorias_compativeis[] = $row['categoria_compativel_com_id_ctg'];
                }
            }
    
            return $categorias_compativeis;
        }
    }
