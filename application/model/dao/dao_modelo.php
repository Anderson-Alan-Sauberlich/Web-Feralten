<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_modelo.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Modelo;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Modelo {
        
        function __construct() {
            
        }
        
        public static function Inserir(Modelo $modelo) {
            try {
                $sql = "INSERT INTO tb_modelo (modelo_id, modelo_ma_id, modelo_nome) 
                        VALUES (:id, :ma_id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $modelo->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ma_id", $modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $modelo->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Modelo $modelo) {
            try {
                $sql = "UPDATE tb_modelo SET
                modelo_id = :id,
                modelo_ma_id = :ma_id,
                modelo_nome = :nome 
                WHERE modelo_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $modelo->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ma_id", $modelo->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $modelo->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT modelo_id, modelo_ma_id, modelo_nome FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelo($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Marca_Id($id) {
            try {
                $sql = "SELECT modelo_ma_id FROM tb_modelo WHERE modelo_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
				
                return $row['modelo_ma_id'];
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Por_ID_Marca($id) {
            try {
                $sql = "SELECT modelo_id, modelo_ma_id, modelo_nome FROM tb_modelo WHERE modelo_ma_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaModelos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaModelo($row) {
            $modelo = new Modelo();
            
            $modelo->set_id($row['modelo_id']);
            $modelo->set_marca_id($row['modelo_ma_id']);
            $modelo->set_nome($row['modelo_nome']);
            
            return $modelo;
        }
        
        private function PopulaModelos($rows) {
            $modelos = array();
            
            foreach ($rows as $row) {
                $modelo = new Modelo();
                
                $modelo->set_id($row['modelo_id']);
                $modelo->set_marca_id($row['modelo_ma_id']);
                $modelo->set_nome($row['modelo_nome']);
                
                $modelos[] = $modelo;
            }
            return $modelos;
        }
    }
?>