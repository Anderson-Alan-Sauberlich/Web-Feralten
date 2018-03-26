<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Visualizado as OBJ_Visualizado;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Visualizado
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Visualizado $obj_visualizado) : bool
        {
            try {
                $obj_visualizado->set_id(self::Achar_ID_Livre($obj_visualizado->get_obj_entidade()->get_id()));
                
                $sql = "INSERT INTO tb_visualizado (visualizado_id, visualizado_ent_id, visualizado_usr_id, visualizado_datahora) 
                        VALUES (:id, :ent_id, :usr_id, :datahora);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_visualizado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_visualizado->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_visualizado->get_obj_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_visualizado->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Visualizado $obj_visualizado) : bool
        {
            try {
                $sql = "UPDATE tb_visualizado SET
                visualizado_id = :id,
                visualizado_ent_id = :ent_id,
                visualizado_usr_id = :usr_id,
                visualizado_datahora = :datahora 
                WHERE visualizado_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_visualizado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_visualizado->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_visualizado->get_obj_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $obj_visualizado->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_visualizado WHERE visualizado_id = :id';
                
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
                $sql = 'SELECT fc_achar_id_livre_visualizado(:ent_id)';
                
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
                $sql = 'SELECT visualizado_id, visualizado_ent_id, visualizado_usr_id, visualizado_datahora FROM tb_visualizado WHERE visualizado_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Visualizados($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD_Entidade(int $id)
        {
            try {
                $sql = 'SELECT visualizado_id, visualizado_ent_id, visualizado_usr_id, visualizado_datahora FROM tb_visualizado WHERE visualizado_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Visualizados($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Visualizados(array $rows) : array
        {
            $visualizados = array();
            
            foreach ($rows as $row) {
                $obj_visualizado = new OBJ_Visualizado();
                
                if (isset($row['visualizado_id'])) {
                    $obj_visualizado->set_id($row['visualizado_id']);
                }
                
                if (isset($row['visualizado_ent_id'])) {
                    $obj_visualizado->set_obj_entidade(DAO_Entidade::BuscarPorCOD($row['visualizado_ent_id']));
                }
                
                if (isset($row['visualizado_usr_id'])) {
                    $obj_visualizado->set_obj_usuario(DAO_Usuario::Buscar_Usuario($row['visualizado_usr_id']));
                }
                                
                if (isset($row['visualizado_datahora'])) {
                    $obj_visualizado->set_datahora($row['visualizado_datahora']);
                }
                
                $visualizados[] = $obj_visualizado;
            }

            return $visualizados;
        }
        
        public static function Popula_Visualizado(array $row) : OBJ_Visualizado
        {
            $obj_visualizado = new OBJ_Visualizado();
            
            if (isset($row['visualizado_id'])) {
                $obj_visualizado->set_id($row['visualizado_id']);
            }
            
            if (isset($row['visualizado_ent_id'])) {
                $obj_visualizado->set_obj_entidade(DAO_Entidade::BuscarPorCOD($row['visualizado_ent_id']));
            }
            
            if (isset($row['visualizado_usr_id'])) {
                $obj_visualizado->set_obj_usuario(DAO_Usuario::Buscar_Usuario($row['visualizado_usr_id']));
            }
            
            if (isset($row['visualizado_datahora'])) {
                $obj_visualizado->set_datahora($row['visualizado_datahora']);
            }
            
            return $obj_visualizado;
        }
    }
