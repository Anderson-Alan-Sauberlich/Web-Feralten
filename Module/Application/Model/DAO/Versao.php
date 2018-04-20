<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    use Module\Application\Model\OBJ\Versao_Compativel as OBJ_Versao_Compativel;
    use Module\Application\Model\DAO\Versao_Compativel as DAO_Versao_Compativel;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Versao
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Versao $obj_versao) : bool
        {
            try {
                if (empty($obj_versao->get_id())) {
                    $obj_versao->set_id(self::Achar_ID_Livre($obj_versao->get_modelo_id()));
                }
                
                $sql = "INSERT INTO tb_versao (versao_id, versao_mdl_id, versao_nome, versao_url) 
                        VALUES (:id, :mo_id, :nome, :url);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_versao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mo_id', $obj_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_versao->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_versao->get_url(), PDO::PARAM_STR);

                if ($p_sql->execute()) {
                    $obj_versao_compativel = new OBJ_Versao_Compativel();
                    
                    $obj_versao_compativel->set_com_id($obj_versao->get_id());
                    $obj_versao_compativel->set_da_id($obj_versao->get_id());
                    
                    return DAO_Versao_Compativel::Inserir($obj_versao_compativel);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Versao $obj_versao) : bool
        {
            try {
                $sql = "UPDATE tb_versao SET versao_mdl_id = :mo_id, versao_nome = :nome, versao_url = :url WHERE versao_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_versao->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mo_id', $obj_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_versao->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_versao->get_url(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Deleta em Casacade os elementos da compatibilidade.
         * Deve ser alterado quando existir a pagina admin para as compatibilidades.
         * Para que o usuario tenha que deletar manualemete todas as compatibilidades.
         *
         * @param int $id
         * @return bool
         */
        public static function Deletar(int $id) : bool
        {
            Conexao::Conectar()->beginTransaction();
            
            try {
                $sql = 'DELETE FROM tb_versao WHERE versao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                if (DAO_Versao_Compativel::Deletar($id)) {
                    if ($p_sql->execute()) {
                        return Conexao::$conection->commit();
                    } else {
                        Conexao::$conection->rollBack();
                        return false;
                    }
                } else {
                    Conexao::$conection->rollBack();
                    return false;
                }
            } catch (PDOException | Exception $e) {
                Conexao::$conection->rollBack();
                return false;
            }
        }
        
        public static function Achar_ID_Livre(int $modelo_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_versao(:mo_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':mo_id', $modelo_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT versao_id, versao_mdl_id, versao_nome, versao_url FROM tb_versao';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaVersoes($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT versao_id, versao_mdl_id, versao_nome, versao_url FROM tb_versao WHERE versao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Nome_URL_Por_ID(int $id)
        {
            try {
                $sql = 'SELECT versao_nome, versao_url FROM tb_versao WHERE versao_id = :id';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
        
                return self::PopulaVersao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Modelo_Id(int $id)
        {
            try {
                $sql = 'SELECT versao_mdl_id FROM tb_versao WHERE versao_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_Id_Modelo(int $id)
        {
            try {
                $sql = 'SELECT versao_id, versao_mdl_id, versao_nome, versao_url FROM tb_versao WHERE versao_mdl_id = :id ORDER BY versao_nome';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaVersoes($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Modelo(int $id)
        {
            try {
                $sql = 'SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :id';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $rows = $p_sql->fetchAll(PDO::FETCH_ASSOC);
                
                $id_versao = array();
                
                foreach ($rows as $row) {
                    $id_versao[] = $row['versao_id'];
                }
                
                return $id_versao;
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_ID_Por_URL(int $modelo_id, string $url)
        {
            try {
                $sql = 'SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :mo_id AND versao_url = :url';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':mo_id', $modelo_id, PDO::PARAM_INT);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                $p_sql->execute();
        
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Verificar_Versao_Repetida(OBJ_Versao $obj_versao) : bool
        {
            try {
                $sql = 'SELECT versao_id FROM tb_versao WHERE versao_mdl_id = :mo_id AND (versao_nome = :nome OR versao_url = :url)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':mo_id', $obj_versao->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_versao->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_versao->get_url(), PDO::PARAM_STR);
                $p_sql->execute();
                
                $versao_id = $p_sql->fetch(PDO::FETCH_COLUMN);
                
                if (!empty($versao_id) AND $versao_id != $obj_versao->get_id()) {
                    return false;
                } else {
                    return true;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaVersao(array $row) : OBJ_Versao
        {
            $obj_versao = new OBJ_Versao();
            
            if (isset($row['versao_id'])) {
                $obj_versao->set_id($row['versao_id']);
            }
            
            if (isset($row['versao_mdl_id'])) {
                $obj_versao->set_modelo_id($row['versao_mdl_id']);
            }
            
            if (isset($row['versao_nome'])) {
                $obj_versao->set_nome($row['versao_nome']);
            }
            
            if (isset($row['versao_url'])) {
                $obj_versao->set_url($row['versao_url']);
            }
            
            return $obj_versao;
        }
        
        public static function PopulaVersoes(array $rows) : array
        {
            $versoes = array();
            
            foreach ($rows as $row) {
                $obj_versao = new OBJ_Versao();
                
                if (isset($row['versao_id'])) {
                    $obj_versao->set_id($row['versao_id']);
                }
                
                if (isset($row['versao_mdl_id'])) {
                    $obj_versao->set_modelo_id($row['versao_mdl_id']);
                }
                
                if (isset($row['versao_nome'])) {
                    $obj_versao->set_nome($row['versao_nome']);
                }
                
                if (isset($row['versao_url'])) {
                    $obj_versao->set_url($row['versao_url']);
                }
                
                $versoes[] = $obj_versao;
            }
            
            return $versoes;
        }
    }
