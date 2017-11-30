<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Cidade as Object_Cidade;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Cidade
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Cidade $object_cidade) : bool
        {
            try {
                $sql = "INSERT INTO tb_cidade (cidade_id, cidade_est_id, cidade_nome, cidade_url) 
                        VALUES (:id, :es_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':es_id', $object_cidade->get_estado_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_cidade->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_cidade->get_url(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Cidade $object_cidade) : bool
        {
            try {
                $sql = "UPDATE tb_cidade SET
                cidade_id = :id,
                cidade_est_id = :es_id,
                cidade_nome = :nome,
                cidade_url = :url 
                WHERE cidade_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':es_id', $object_cidade->get_estado_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_cidade->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_cidade->get_url(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_cidade WHERE cidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT cidade_id, cidade_est_id, cidade_nome, cidade_url FROM tb_cidade WHERE cidade_est_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidades($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_ID_Cidade(int $id)
        {
            try {
                $sql = 'SELECT cidade_id, cidade_est_id, cidade_nome, cidade_url FROM tb_cidade WHERE cidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidade($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Url(string $url)
        {
            try {
                $sql = 'SELECT cidade_id FROM tb_cidade WHERE cidade_url = :url';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':url', $url, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaCidades(array $rows) : array
        {
            $cidades = array();
            
            foreach ($rows as $row) {
                $object_cidade = new Object_Cidade();
                
                if (isset($row['cidade_id'])) {
                    $object_cidade->set_id($row['cidade_id']);
                }
                
                if (isset($row['cidade_est_id'])) {
                    $object_cidade->set_estado_id($row['cidade_est_id']);
                }
                
                if (isset($row['cidade_nome'])) {
                    $object_cidade->set_nome($row['cidade_nome']);
                }
                
                if (isset($row['cidade_url'])) {
                    $object_cidade->set_url($row['cidade_url']);
                }
                
                $cidades[] = $object_cidade;
            }

            return $cidades;
        }
        
        public static function PopulaCidade(array $row) : Object_Cidade
        {
            $object_cidade = new Object_Cidade();
            
            if (isset($row['cidade_id'])) {
                $object_cidade->set_id($row['cidade_id']);
            }
            
            if (isset($row['cidade_est_id'])) {
                $object_cidade->set_estado_id($row['cidade_est_id']);
            }
            
            if (isset($row['cidade_nome'])) {
                $object_cidade->set_nome($row['cidade_nome']);
            }
            
            if (isset($row['cidade_url'])) {
                $object_cidade->set_url($row['cidade_url']);
            }
            
            return $object_cidade;
        }
    }
