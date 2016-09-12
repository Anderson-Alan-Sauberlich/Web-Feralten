<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_cidade.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Cidade;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Cidade {

        function __construct() {
            
        }
        
        public static function Inserir(Cidade $cidade) {
            try {
                                 
                $sql = "INSERT INTO tb_cidade (cidade_id, cidade_es_id, cidade_nome) 
                        VALUES (:id, :es_id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $cidade->get_es_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $cidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Editar(Cidade $cidade) {
            try {
                $sql = "UPDATE tb_cidade SET
                cidade_id = :id,
                cidade_es_id = :es_id,
                cidade_nome = :nome 
                WHERE cidade_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $cidade->get_es_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $cidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_cidade WHERE cidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT cidade_id, cidade_es_id, cidade_nome FROM tb_cidade WHERE cidade_es_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidades($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Por_ID_Cidade($id) {
            try {
                $sql = "SELECT cidade_id, cidade_es_id, cidade_nome FROM tb_cidade WHERE cidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidade($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaCidades($rows) {
            $cidades = array();
            
            foreach ($rows as $row) {
                $cidade = new Cidade();
            
                $cidade->set_id($row['cidade_id']);
                $cidade->set_estado_id($row['cidade_es_id']);
                $cidade->set_nome($row['cidade_nome']);
                
                $cidades[] = $cidade;
            }

            return $cidades;
        }
        
        private function PopulaCidade($row) {
            $cidade = new Cidade();
            
            $cidade->set_id($row['cidade_id']);
            $cidade->set_estado_id($row['cidade_es_id']);
            $cidade->set_nome($row['cidade_nome']);
            
            return $cidade;
        }
    }
?>