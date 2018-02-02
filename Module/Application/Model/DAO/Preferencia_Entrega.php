<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Preferencia_Entrega as Object_Preferencia_Entrega;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Preferencia_Entrega
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Preferencia_Entrega $object_preferencia_entrega) : bool
        {
            try {
                $sql = "INSERT INTO tb_preferencia_entrega (preferencia_entrega_id, preferencia_entrega_nome, preferencia_entrega_url) 
                        VALUES (:id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_preferencia_entrega->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_preferencia_entrega->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_preferencia_entrega->get_url(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Preferencia_Entrega $object_preferencia_entrega) : bool
        {
            try {
                $sql = "UPDATE tb_preferencia_entrega SET preferencia_entrega_id = :id, preferencia_entrega_nome = :nome, preferencia_entrega_url = :url WHERE preferencia_entrega_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_preferencia_entrega->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_preferencia_entrega->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_preferencia_entrega->get_url(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
         
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_preferencia_entrega WHERE preferencia_entrega_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Url(string $url) : ?int
        {
            try {
                $sql = 'SELECT preferencia_entrega_id FROM tb_preferencia_entrega WHERE preferencia_entrega_url = :url';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT preferencia_entrega_id, preferencia_entrega_nome, preferencia_entrega_url FROM tb_preferencia_entrega WHERE preferencia_entrega_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Preferencia_Entrega($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT preferencia_entrega_id, preferencia_entrega_nome, preferencia_entrega_url FROM tb_preferencia_entrega';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Preferencia_Entregas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Todos_Masivos()
        {
            try {
                $sql = "SELECT preferencia_entrega_id, preferencia_entrega_nome, preferencia_entrega_url FROM tb_preferencia_entrega 
                        WHERE preferencia_entrega_id = 1 
                        OR preferencia_entrega_id = 2 
                        OR preferencia_entrega_id = 4 
                        OR preferencia_entrega_id = 8 
                        OR preferencia_entrega_id = 16 
                        OR preferencia_entrega_id = 32 
                        OR preferencia_entrega_id = 64 
                        OR preferencia_entrega_id = 128";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Preferencia_Entregas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Lista_Todos()
        {
            try {
                $sql = 'SELECT preferencia_entrega_id, preferencia_entrega_nome, preferencia_entrega_url FROM tb_preferencia_entrega';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Lista_Preferencia_Entregas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popular_Preferencia_Entrega(array $row) : Object_Preferencia_Entrega
        {
            $object_preferencia_entrega = new Object_Preferencia_Entrega();
            
            if (isset($row['preferencia_entrega_id'])) {
                $object_preferencia_entrega->set_id($row['preferencia_entrega_id']);
            }
            
            if (isset($row['preferencia_entrega_nome'])) {
                $object_preferencia_entrega->set_nome($row['preferencia_entrega_nome']);
            }
            
            if (isset($row['preferencia_entrega_url'])) {
                $object_preferencia_entrega->set_url($row['preferencia_entrega_url']);
            }
            
            return $object_preferencia_entrega;
        }
        
        public static function Popular_Preferencia_Entregas(array $rows) : array
        {
            $preferencia_entregas = array();
            
            foreach ($rows as $row) {
                $object_preferencia_entrega = new Object_Preferencia_Entrega();
                
                if (isset($row['preferencia_entrega_id'])) {
                    $object_preferencia_entrega->set_id($row['preferencia_entrega_id']);
                }
                
                if (isset($row['preferencia_entrega_nome'])) {
                    $object_preferencia_entrega->set_nome($row['preferencia_entrega_nome']);
                }
                
                if (isset($row['preferencia_entrega_url'])) {
                    $object_preferencia_entrega->set_url($row['preferencia_entrega_url']);
                }
                
                $preferencia_entregas[] = $object_preferencia_entrega;
            }
            
            return $preferencia_entregas;
        }
        
        public static function Popular_Lista_Preferencia_Entregas(array $rows) : array
        {
            $preferencia_entregas = array();
            
            foreach ($rows as $row) {
                if (isset($row['preferencia_entrega_id']) AND isset($row['preferencia_entrega_nome'])) {
                    $preferencia_entregas[$row['preferencia_entrega_id']] = $row['preferencia_entrega_nome'];
                }
            }
            
            return $preferencia_entregas;
        }
    }
