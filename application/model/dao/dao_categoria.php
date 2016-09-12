<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_categoria.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Categoria;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Categoria {

        function __construct() {
            
        }
        
        public static function Inserir(Categoria $categoria) {
            try {
                $sql = "INSERT INTO tb_categoria (categoria_id, categoria_nome) 
                        VALUES (:id, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $categoria->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Categoria $categoria) {
            try {
                $sql = "UPDATE tb_categoria SET
                categoria_id = :id,
                categoria_nome = :nome 
                WHERE categoria_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $categoria->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $categoria->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_categoria WHERE categoria_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = "SELECT categoria_id, categoria_nome FROM tb_categoria";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaCategorias($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT categoria_id, categoria_nome FROM tb_categoria WHERE categoria_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaCategoria($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaCategoria($row) {
            $categoria = new Categoria();
            
            $categoria->set_id($row['categoria_id']);
            $categoria->set_nome($row['categoria_nome']);
            
            return $categoria;
        }
        
        private function PopulaCategorias($rows) {
            $categorias = array();
            
            foreach ($rows as $row) {
                $categoria = new Categoria();
                
                $categoria->set_id($row['categoria_id']);
                $categoria->set_nome($row['categoria_nome']);
                
                $categorias[] = $categoria;
            }
            
            return $categorias;
        }
    }
?>