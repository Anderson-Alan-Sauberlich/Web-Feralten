<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Adicionado as OBJ_Adicionado;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Adicionado
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Adicionado $obj_adicionado) : bool
        {
            try {
                $obj_adicionado->set_id(self::Achar_ID_Livre($obj_adicionado->get_obj_entidade()->get_id()));
                
                $sql = "INSERT INTO tb_adicionado (adicionado_id, adicionado_ent_id, adicionado_usr_id, adicionado_datahora) 
                        VALUES (:id, :ent_id, :usr_id, :datahora);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_adicionado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_adicionado->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_adicionado->get_obj_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_adicionado->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Adicionado $obj_adicionado) : bool
        {
            try {
                $sql = "UPDATE tb_adicionado SET
                adicionado_id = :id,
                adicionado_ent_id = :ent_id,
                adicionado_usr_id = :usr_id,
                adicionado_datahora = :datahora 
                WHERE adicionado_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_adicionado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_adicionado->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_adicionado->get_obj_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_adicionado->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_adicionado WHERE adicionado_id = :id';
                
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
                $sql = 'SELECT fc_achar_id_livre_adicionado(:ent_id)';
                
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
                $sql = 'SELECT adicionado_id, adicionado_ent_id, adicionado_usr_id, adicionado_datahora FROM tb_adicionado WHERE adicionado_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Adicionados($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD_Entidade(int $id)
        {
            try {
                $sql = 'SELECT adicionado_id, adicionado_ent_id, adicionado_usr_id, adicionado_datahora FROM tb_adicionado WHERE adicionado_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Adicionados($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Adicionados(array $rows) : array
        {
            $adicionados = array();
            
            foreach ($rows as $row) {
                $obj_adicionado = new OBJ_Adicionado();
                
                if (isset($row['adicionado_id'])) {
                    $obj_adicionado->set_id($row['adicionado_id']);
                }
                
                if (isset($row['adicionado_ent_id'])) {
                    $obj_adicionado->set_obj_entidade(DAO_Entidade::BuscarPorCOD($row['adicionado_ent_id']));
                }
                
                if (isset($row['adicionado_usr_id'])) {
                    $obj_adicionado->set_obj_usuario(DAO_Usuario::Buscar_Usuario($row['adicionado_usr_id']));
                }
                                
                if (isset($row['adicionado_datahora'])) {
                    $obj_adicionado->set_datahora($row['adicionado_datahora']);
                }
                
                $adicionados[] = $obj_adicionado;
            }

            return $adicionados;
        }
        
        public static function Popula_Adicionado(array $row) : OBJ_Adicionado
        {
            $obj_adicionado = new OBJ_Adicionado();
            
            if (isset($row['adicionado_id'])) {
                $obj_adicionado->set_id($row['adicionado_id']);
            }
            
            if (isset($row['adicionado_ent_id'])) {
                $obj_adicionado->set_obj_entidade(DAO_Entidade::BuscarPorCOD($row['adicionado_ent_id']));
            }
            
            if (isset($row['adicionado_usr_id'])) {
                $obj_adicionado->set_obj_usuario(DAO_Usuario::Buscar_Usuario($row['adicionado_usr_id']));
            }
            
            if (isset($row['adicionado_datahora'])) {
                $obj_adicionado->set_datahora($row['adicionado_datahora']);
            }
            
            return $obj_adicionado;
        }
    }
