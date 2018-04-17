<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Modelo as OBJ_Modelo;
    use Module\Application\Model\OBJ\Modelo_Compativel as OBJ_Modelo_Compativel;
    use Module\Application\Model\DAO\Modelo_Compativel as DAO_Modelo_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Modelo
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Modelo $obj_modelo) : bool
        {
            try {
                if (empty($obj_modelo->get_id())) {
                    $obj_modelo->set_id(self::Achar_ID_Livre($obj_modelo->get_marca_id()));
                }
                
                $sql = "INSERT INTO tb_modelo (modelo_id, modelo_mrc_id, modelo_nome, modelo_url) 
                        VALUES (:id, :ma_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_modelo->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ma_id', $obj_modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_modelo->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_modelo->get_url(), PDO::PARAM_STR);

                if ($p_sql->execute()) {
                    $obj_modelo_compativel = new OBJ_Modelo_Compativel();
                    
                    $obj_modelo_compativel->set_com_id($obj_modelo->get_id());
                    $obj_modelo_compativel->set_da_id($obj_modelo->get_id());
                    
                    return DAO_Modelo_Compativel::Inserir($obj_modelo_compativel);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Modelo $obj_modelo) : bool
        {
            try {
                $sql = "UPDATE tb_modelo SET modelo_mrc_id = :ma_id, modelo_nome = :nome, modelo_url = :url WHERE modelo_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_modelo->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ma_id', $obj_modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_modelo->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_modelo->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_modelo WHERE modelo_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                if ($p_sql->execute()) {
                    return DAO_Modelo_Compativel::Deletar($id);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Achar_ID_Livre(int $marca_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_modelo(:ma_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ma_id', $marca_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT modelo_id, modelo_mrc_id, modelo_nome, modelo_url FROM tb_modelo';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaModelos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT modelo_id, modelo_mrc_id, modelo_nome, modelo_url FROM tb_modelo WHERE modelo_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelo($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id)
        {
            try {
                $sql = 'SELECT modelo_nome, modelo_url FROM tb_modelo WHERE modelo_id = :id';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
        
                return self::PopulaModelo($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Marca_Id(int $id)
        {
            try {
                $sql = 'SELECT modelo_mrc_id FROM tb_modelo WHERE modelo_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_Id_Marca(int $id)
        {
            try {
                $sql = 'SELECT modelo_id, modelo_mrc_id, modelo_nome, modelo_url FROM tb_modelo WHERE modelo_mrc_id = :id ORDER BY modelo_nome';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Marca(int $id)
        {
            try {
                $sql = 'SELECT modelo_id FROM tb_modelo WHERE modelo_mrc_id = :id';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                $rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
                $id_modelos = array();
                
                foreach ($rows as $row) {
                    $id_modelos[] = $row['modelo_id'];
                }
                
                return $id_modelos;
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_ID_Por_URL(int $marca_id, string $url)
        {
            try {
                $sql = 'SELECT modelo_id FROM tb_modelo WHERE modelo_mrc_id = :ma_id AND modelo_url = :url';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ma_id', $marca_id, PDO::PARAM_INT);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                $p_sql->execute();
        
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Verificar_Modelo_Repetido(OBJ_Modelo $obj_modelo) : bool
        {
            try {
                $sql = 'SELECT modelo_id FROM tb_modelo WHERE modelo_mrc_id = :ma_id AND (modelo_nome = :nome OR modelo_url = :url)';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ma_id', $obj_modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_modelo->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_modelo->get_url(), PDO::PARAM_STR);
                $p_sql->execute();
                
                $modelo_id = $p_sql->fetch(PDO::FETCH_COLUMN);
        
                if (!empty($modelo_id) AND $modelo_id != $obj_modelo->get_id()) {
                    return false;
                } else {
                    return true;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaModelo(array $row) : OBJ_Modelo
        {
            $obj_modelo = new OBJ_Modelo();
            
            if (isset($row['modelo_id'])) {
                $obj_modelo->set_id($row['modelo_id']);
            }
            
            if (isset($row['modelo_mrc_id'])) {
                $obj_modelo->set_marca_id($row['modelo_mrc_id']);
            }
            
            if (isset($row['modelo_nome'])) {
                $obj_modelo->set_nome($row['modelo_nome']);
            }
            
            if (isset($row['modelo_url'])) {
                $obj_modelo->set_url($row['modelo_url']);
            }
            
            return $obj_modelo;
        }
        
        public function PopulaModelos(array $rows) : array
        {
            $modelos = array();
            
            foreach ($rows as $row) {
                $obj_modelo = new OBJ_Modelo();
                
                if (isset($row['modelo_id'])) {
                    $obj_modelo->set_id($row['modelo_id']);
                }
                
                if (isset($row['modelo_mrc_id'])) {
                    $obj_modelo->set_marca_id($row['modelo_mrc_id']);
                }
                
                if (isset($row['modelo_nome'])) {
                    $obj_modelo->set_nome($row['modelo_nome']);
                }
                
                if (isset($row['modelo_url'])) {
                    $obj_modelo->set_url($row['modelo_url']);
                }
                
                $modelos[] = $obj_modelo;
            }
            
            return $modelos;
        }
    }
