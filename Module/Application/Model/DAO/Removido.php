<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Removido as Object_Removido;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Removido
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Removido $object_removido) : bool
        {
            try {
                $object_removido->set_id(self::Achar_ID_Livre($object_removido->get_object_entidade()->get_id()));
                
                $sql = "INSERT INTO tb_removido (removido_id, removido_ent_id, removido_usr_id, removido_datahora) 
                        VALUES (:id, :ent_id, :usr_id, :datahora);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_removido->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_removido->get_object_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_removido->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_removido->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Removido $object_removido) : bool
        {
            try {
                $sql = "UPDATE tb_removido SET
                removido_id = :id,
                removido_ent_id = :ent_id,
                removido_usr_id = :usr_id,
                removido_datahora = :datahora 
                WHERE removido_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_removido->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_removido->get_object_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_removido->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_removido->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_removido WHERE removido_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Achar_ID_Livre(int $entidade_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_removido(:ent_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ent_id', $entidade_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT removido_id, removido_ent_id, removido_usr_id, removido_datahora FROM tb_removido WHERE removido_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Removidos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD_Entidade(int $id)
        {
            try {
                $sql = 'SELECT removido_id, removido_ent_id, removido_usr_id, removido_datahora FROM tb_removido WHERE removido_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Removidos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Removidos(array $rows) : array
        {
            $removidos = array();
            
            foreach ($rows as $row) {
                $object_removido = new Object_Removido();
                
                if (isset($row['removido_id'])) {
                    $object_removido->set_id($row['removido_id']);
                }
                
                if (isset($row['removido_ent_id'])) {
                    $object_removido->set_object_entidade(DAO_Entidade::BuscarPorCOD($row['removido_ent_id']));
                }
                
                if (isset($row['removido_usr_id'])) {
                    $object_removido->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['removido_usr_id']));
                }
                                
                if (isset($row['removido_datahora'])) {
                    $object_removido->set_datahora($row['removido_datahora']);
                }
                
                $removidos[] = $object_removido;
            }

            return $removidos;
        }
        
        public static function Popula_Removido(array $row) : Object_Removido
        {
            $object_removido = new Object_Removido();
            
            if (isset($row['removido_id'])) {
                $object_removido->set_id($row['removido_id']);
            }
            
            if (isset($row['removido_ent_id'])) {
                $object_removido->set_object_entidade(DAO_Entidade::BuscarPorCOD($row['removido_ent_id']));
            }
            
            if (isset($row['removido_usr_id'])) {
                $object_removido->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['removido_usr_id']));
            }
            
            if (isset($row['removido_datahora'])) {
                $object_removido->set_datahora($row['removido_datahora']);
            }
            
            return $object_removido;
        }
    }
