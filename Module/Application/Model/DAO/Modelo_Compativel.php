<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Modelo_Compativel as OBJ_Modelo_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Modelo_Compativel
    {
        function __construct()
        {
    
        }
    
        public static function Inserir(OBJ_Modelo_Compativel $obj_modelo_compativel) : bool
        {
            try {
                $sql = "INSERT INTO tb_modelo_compativel (modelo_compativel_da_id_mdl, modelo_compativel_com_id_mdl)
                        VALUES (:da_id, :com_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_modelo_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_modelo_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
    
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Atualizar(OBJ_Modelo_Compativel $obj_modelo_compativel) : bool
        {
            try {
                $sql = "UPDATE tb_modelo_compativel SET modelo_compativel_da_id_mdl = :da_id, modelo_compativel_com_id_mdl = :com_id WHERE modelo_compativel_da_id_mdl = :da_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_modelo_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_modelo_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_modelo_compativel WHERE modelo_compativel_da_id_mdl = :id';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT modelo_compativel_da_id_mdl, modelo_compativel_com_id_mdl FROM tb_modelo_compativel';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
    
                return self::PopulaModelosCompativeisOBJ($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT modelo_compativel_com_id_mdl FROM tb_modelo_compativel WHERE modelo_compativel_da_id_mdl = :da_id';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':da_id', $id, PDO::PARAM_INT);
                $p_sql->execute();
    
                return self::PopulaModelosCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function PopulaModeloCompativel(array $row) : OBJ_Modelo_Compativel
        {
            $obj_modelo_compativel = new OBJ_Modelo_Compativel();
            
            if (isset($row['modelo_compativel_da_id_mdl'])) {
                $obj_modelo_compativel->set_da_id($row['modelo_compativel_da_id_mdl']);
            }
            
            if (isset($row['modelo_compativel_com_id_mdl'])) {
                $obj_modelo_compativel->set_com_id($row['modelo_compativel_com_id_mdl']);
            }
            
            return $obj_modelo_compativel;
        }
        
        public static function PopulaModelosCompativeisOBJ(array $rows) : array
        {
            $modelos_compativeis = array();
            
            foreach ($rows as $row) {
                $obj_modelo_compativel = new OBJ_Modelo_Compativel();
                
                if (isset($row['modelo_compativel_da_id_mdl'])) {
                    $obj_modelo_compativel->set_da_id($row['modelo_compativel_da_id_mdl']);
                }
                
                if (isset($row['modelo_compativel_com_id_mdl'])) {
                    $obj_modelo_compativel->set_com_id($row['modelo_compativel_com_id_mdl']);
                }
                
                $modelos_compativeis[] = $obj_modelo_compativel;
            }
            
            return $modelos_compativeis;
        }
    
        public static function PopulaModelosCompativeis(array $rows) : array
        {
            $modelos_compativeis = array();
    
            foreach ($rows as $row) {
                if (isset($row['modelo_compativel_com_id_mdl'])) {
                    $modelos_compativeis[] = $row['modelo_compativel_com_id_mdl'];
                }
            }
            
            return $modelos_compativeis;
        }
    }
