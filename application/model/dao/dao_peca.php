<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_peca.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Peca {
        
        function __construct() {
            
        }
        
        public static function Inserir(Peca $peca) {
            try {
                                 
                $sql = "INSERT INTO tb_peca (peca_id, peca_du_us_id, peca_en_id, peca_co_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade) 
                        VALUES (:id, :du_us_id, :en_id, :co_id, :st_id, :nome, :fabricante, :preco, :descricao, :data, :serie, :prioridade);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $peca->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $peca->get_endereco_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":co_id", $peca->get_contato_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $peca->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $peca->get_nome(), PDO::PARAM_STR);
				$p_sql->bindValue(":fabricante", $peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(":preco", $peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(":descricao", $peca->get_descricao(), PDO::PARAM_STR);
				$p_sql->bindValue(":data", $peca->get_data_anuncio(), PDO::PARAM_STR);
				$p_sql->bindValue(":serie", $peca->get_serie(), PDO::PARAM_STR);
				$p_sql->bindValue(":prioridade", $peca->get_prioridade(), PDO::PARAM_BOOL);
				
                $p_sql->execute();
				
				return Conexao::Conectar()->lastInsertId();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Peca $peca) {
            try {
                $sql = "UPDATE tb_peca SET peca_id = :id, peca_du_us_id = :du_us_id, peca_en_id = :en_id, peca_co_id = :co_id, 
                peca_sp_id = :st_id, peca_nome = :nome, peca_fabricante = :fabricante, peca_preco = :preco, peca_descricao = :descricao, 
                peca_data_anuncio = :data, peca_numero_serie = :serie, peca_prioridade = :prioridade WHERE peca_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":du_us_id", $peca->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":en_id", $peca->get_endereco_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":co_id", $peca->get_contato_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":st_id", $peca->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":nome", $peca->get_nome(), PDO::PARAM_STR);
				$p_sql->bindValue(":fabricante", $peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(":preco", $peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(":descricao", $peca->get_descricao(), PDO::PARAM_STR);
				$p_sql->bindValue(":data", $peca->get_data_anuncio(), PDO::PARAM_STR);
				$p_sql->bindValue(":serie", $peca->get_serie(), PDO::PARAM_STR);
				$p_sql->bindValue(":prioridade", $peca->get_prioridade(), PDO::PARAM_BOOL);
				
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT peca_id, peca_du_us_id, peca_en_id, peca_co_id, peca_sp_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade FROM tb_peca WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function PopulaPeca($row) {
            $peca = new Peca();
            
            $peca->set_id($row['peca_id']);
            $peca->set_usuario_id($row['peca_du_us_id']);
			$peca->set_endereco_id($row['peca_en_id']);
			$peca->set_contato_id($row['peca_co_id']);
			$peca->set_status_id($row['peca_sp_id']);
            $peca->set_nome($row['peca_nome']);
            $peca->set_fabricante($row['peca_fabricante']);
            $peca->set_preco($row['peca_preco']);
            $peca->set_descricao($row['peca_descricao']);
            $peca->set_data_anuncio($row['peca_data_anuncio']);
			$peca->set_serie($row['peca_numero_serie']);
			$peca->set_prioridade($row['peca_prioridade']);
            
            return $peca;
        }
    }
?>