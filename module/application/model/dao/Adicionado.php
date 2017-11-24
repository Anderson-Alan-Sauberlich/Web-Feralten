<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Adicionado as Object_Adicionado;
    use module\application\model\dao\Entidade as DAO_Entidade;
    use module\application\model\dao\Usuario as DAO_Usuario;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Adicionado
    {
		
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Adicionado $object_adicionado) : bool
        {
            try {
                $object_adicionado->set_id(self::Achar_ID_Livre($object_adicionado->get_object_entidade()->get_id()));
                
                $sql = "INSERT INTO tb_adicionado (adicionado_id, adicionado_ent_id, adicionado_usr_id, adicionado_datahora) 
                        VALUES (:id, :ent_id, :usr_id, :datahora);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_adicionado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_adicionado->get_object_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_adicionado->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_adicionado->get_datahora(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Adicionado $object_adicionado) : bool
        {
            try {
                $sql = "UPDATE tb_adicionado SET
                adicionado_id = :id,
                adicionado_ent_id = :ent_id,
                adicionado_usr_id = :usr_id,
                adicionado_datahora = :datahora 
                WHERE adicionado_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_adicionado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_adicionado->get_object_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_adicionado->get_object_usuario()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_adicionado->get_datahora(), PDO::PARAM_STR);
                
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
                $object_adicionado = new Object_Adicionado();
            	
                if (isset($row['adicionado_id'])) {
                	$object_adicionado->set_id($row['adicionado_id']);
                }
                
                if (isset($row['adicionado_ent_id'])) {
                    $object_adicionado->set_object_entidade(DAO_Entidade::BuscarPorCOD($row['adicionado_ent_id']));
                }
                
                if (isset($row['adicionado_usr_id'])) {
                    $object_adicionado->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['adicionado_usr_id']));
                }
                                
                if (isset($row['adicionado_datahora'])) {
                    $object_adicionado->set_datahora($row['adicionado_datahora']);
                }
                
                $adicionados[] = $object_adicionado;
            }

            return $adicionados;
        }
        
        public static function Popula_Adicionado(array $row) : Object_Adicionado
        {
            $object_adicionado = new Object_Adicionado();
            
            if (isset($row['adicionado_id'])) {
            	$object_adicionado->set_id($row['adicionado_id']);
            }
            
            if (isset($row['adicionado_ent_id'])) {
                $object_adicionado->set_object_entidade(DAO_Entidade::BuscarPorCOD($row['adicionado_ent_id']));
            }
            
            if (isset($row['adicionado_usr_id'])) {
                $object_adicionado->set_object_usuario(DAO_Usuario::Buscar_Usuario($row['adicionado_usr_id']));
            }
            
            if (isset($row['adicionado_datahora'])) {
                $object_adicionado->set_datahora($row['adicionado_datahora']);
            }
            
            return $object_adicionado;
        }
    }
