<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_endereco.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Endereco;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Endereco {

        function __construct() {
            
        }
        
        public static function Inserir(Endereco $endereco) {
            try {
                $sql = "INSERT INTO tb_endereco (endereco_id, endereco_ci_id, endereco_du_us_id, endereco_es_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, 
                                                 endereco_bairro) VALUES (:id, :ci_id, :du_us_id, :es_id, :numero, :cep, :rua, :complemento, :bairro);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $endereco->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ci_id", $endereco->get_cidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $endereco->get_estado_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $endereco->get_dados_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":numero", $endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(":cep", $endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(":rua", $endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(":complemento", $endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(":bairro", $endereco->get_bairro(), PDO::PARAM_STR);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Endereco $endereco) {
            try {
                $sql = "UPDATE tb_endereco SET
                endereco_ci_id = :ci_id,
                endereco_du_us_id = :du_us_id,
                endereco_es_id = :es_id,
                endereco_numero = :numero,
                endereco_cep = :cep,
                endereco_rua = :rua,
                endereco_complemento = :complemento,
                endereco_bairro = :bairro 
                WHERE endereco_du_us_id = :du_us_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":ci_id", $endereco->get_cidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $endereco->get_dados_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $endereco->get_estado_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":numero", $endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(":cep", $endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(":rua", $endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(":complemento", $endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(":bairro", $endereco->get_bairro(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_endereco WHERE endereco_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Por_Id_Usuario($id) {
            try {
                $sql = "SELECT endereco_id, endereco_du_us_id, endereco_ci_id, endereco_es_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, endereco_bairro FROM tb_endereco WHERE endereco_du_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaEndereco($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaEndereco($row) {
            $endereco = new Endereco();
            
            $endereco->set_id($row['endereco_id']);
            $endereco->set_cidade_id($row['endereco_ci_id']);
            $endereco->set_dados_usuario_id($row['endereco_du_us_id']);
            $endereco->set_estado_id($row['endereco_es_id']);
            $endereco->set_numero($row['endereco_numero']);
            $endereco->set_cep($row['endereco_cep']);
            $endereco->set_rua($row['endereco_rua']);
            $endereco->set_complemento($row['endereco_complemento']);
            $endereco->set_bairro($row['endereco_bairro']);
            
            return $endereco;
        }
    }
?>