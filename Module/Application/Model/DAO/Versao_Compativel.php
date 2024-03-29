<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Versao_Compativel as OBJ_Versao_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Versao_Compativel
    {
        function __construct()
        {
    
        }
    
        public static function Inserir(OBJ_Versao_Compativel $obj_versao_compativel) : bool
        {
            try {
                $sql = "INSERT INTO tb_versao_compativel (versao_compativel_da_id_vrs, versao_compativel_com_id_vrs)
                        VALUES (:da_id, :com_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_versao_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_versao_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Atualizar(OBJ_Versao_Compativel $obj_versao_compativel) : bool
        {
            try {
                $sql = "UPDATE tb_versao_compativel SET versao_compativel_da_id_vrs = :da_id, versao_compativel_com_id_vrs = :com_id WHERE versao_compativel_da_id_vrs = :da_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':da_id', $obj_versao_compativel->get_da_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':com_id', $obj_versao_compativel->get_com_id(), PDO::PARAM_INT);
    
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_versao_compativel WHERE versao_compativel_da_id_vrs = :id';
    
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
                $sql = 'SELECT versao_compativel_da_id_vrs, versao_compativel_com_id_vrs FROM tb_versao_compativel';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
    
                return self::PopulaVersoesCompativeisOBJ($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT versao_compativel_com_id_vrs FROM tb_versao_compativel WHERE versao_compativel_da_id_vrs = :da_id';
    
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':da_id', $id, PDO::PARAM_INT);
                $p_sql->execute();
    
                return self::PopulaVersoesCompativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
    
        public static function PopulaVersaoCompativel(array $row) : OBJ_Versao_Compativel
        {
            $obj_versao_compativel = new OBJ_Versao_Compativel();
            
            if (isset($row['versao_compativel_da_id_vrs'])) {
                $obj_versao_compativel->set_da_id($row['versao_compativel_da_id_vrs']);
            }
            
            if (isset($row['versao_compativel_com_id_vrs'])) {
                $obj_versao_compativel->set_com_id($row['versao_compativel_com_id_vrs']);
            }
            
            return $obj_versao_compativel;
        }
        
        public static function PopulaVersoesCompativeisOBJ(array $rows) : array
        {
            $versoes_compativeis = array();
            
            foreach ($rows as $row) {
                $obj_versao_compativel = new OBJ_Versao_Compativel();
                
                if (isset($row['versao_compativel_da_id_vrs'])) {
                    $obj_versao_compativel->set_da_id($row['versao_compativel_da_id_vrs']);
                }
                
                if (isset($row['versao_compativel_com_id_vrs'])) {
                    $obj_versao_compativel->set_com_id($row['versao_compativel_com_id_vrs']);
                }
                
                $versoes_compativeis[] = $obj_versao_compativel;
            }
            
            return $versoes_compativeis;
        }
    
        public static function PopulaVersoesCompativeis(array $rows) : array
        {
            $versoes_compativeis = array();
    
            foreach ($rows as $row) {
                if (isset($row['versao_compativel_com_id_vrs'])) {
                    $versoes_compativeis[] = $row['versao_compativel_com_id_vrs'];
                }
            }
    
            return $versoes_compativeis;
        }
    }
