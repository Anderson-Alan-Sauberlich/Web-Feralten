<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/cidade.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Cidade as Object_Cidade;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Cidade {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Cidade $object_cidade) {
            try {
                $sql = "INSERT INTO tb_cidade (cidade_id, cidade_es_id, cidade_nome) 
                        VALUES (:id, :es_id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $object_cidade->get_es_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_cidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Cidade $object_cidade) {
            try {
                $sql = "UPDATE tb_cidade SET
                cidade_id = :id,
                cidade_es_id = :es_id,
                cidade_nome = :nome 
                WHERE cidade_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_cidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $object_cidade->get_es_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $object_cidade->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_cidade WHERE cidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT cidade_id, cidade_es_id, cidade_nome FROM tb_cidade WHERE cidade_es_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidades($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_ID_Cidade($id) {
            try {
                $sql = "SELECT cidade_id, cidade_es_id, cidade_nome FROM tb_cidade WHERE cidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCidade($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        private static function PopulaCidades($rows) {
            $cidades = array();
            
            foreach ($rows as $row) {
                $object_cidade = new Object_Cidade();
            	
                if (isset($row['cidade_id'])) {
                	$object_cidade->set_id($row['cidade_id']);
                }
                
                if (isset($row['cidade_es_id'])) {
                	$object_cidade->set_estado_id($row['cidade_es_id']);
                }
                
                if (isset($row['cidade_nome'])) {
                	$object_cidade->set_nome($row['cidade_nome']);
                }
                
                $cidades[] = $object_cidade;
            }

            return $cidades;
        }
        
        private static function PopulaCidade($row) {
            $object_cidade = new Object_Cidade();
            
            if (isset($row['cidade_id'])) {
            	$object_cidade->set_id($row['cidade_id']);
            }
            
            if (isset($row['cidade_es_id'])) {
            	$object_cidade->set_estado_id($row['cidade_es_id']);
            }
            
            if (isset($row['cidade_nome'])) {
            	$object_cidade->set_nome($row['cidade_nome']);
            }
            
            return $object_cidade;
        }
    }
?>