<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_lista_pativel.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Lista_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Lista_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Lista_Pativel $lista_pativel) {
            try {
                                 
                $sql = "INSERT INTO tb_lista_pativel (lista_pativel_pc_id, lista_pativel_ca_id, lista_pativel_ma_id, lista_pativel_mo_id, lista_pativel_vs_id, lista_pativel_ano_de, lista_pativel_ano_ate) 
                        VALUES (:pc_id, :ca_id, :ma_id, :mo_id, :vs_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":pc_id", $lista_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $lista_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ma_id", $lista_pativel->get_marca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mo_id", $lista_pativel->get_modelo_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":vs_id", $lista_pativel->get_versao_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $lista_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $lista_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Lista_Pativel $lista_pativel) {
            try {
                $sql = "UPDATE tb_lista_pativel SET
                lista_pativel_pc_id = :pc_id,
                lista_pativel_ca_id = :ca_id,
                lista_pativel_ma_id = :ma_id,
                lista_pativel_mo_id = :mo_id,
                lista_pativel_vs_id = :vs_id,
                lista_pativel_ano_de = :ano_de,
                lista_pativel_ano_ate = :ano_ate 
                WHERE lista_pativel_pc_id = :pc_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":pc_id", $lista_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $lista_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ma_id", $lista_pativel->get_marca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mo_id", $lista_pativel->get_modelo_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":vs_id", $lista_pativel->get_versao_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $lista_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $lista_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar($id) {
            try {
                $sql = "DELETE FROM tb_lista_pativel WHERE lista_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function BuscarPorCOD($id) {
            try {
                $sql = "SELECT lista_pativel_pc_id, lista_pativel_ca_id, lista_pativel_ma_id, lista_pativel_mo_id, lista_pativel_vs_id, lista_pativel_ano_de, lista_pativel_ano_ate FROM tb_lista_pativel WHERE lista_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Lista_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        private function Popula_Lista_Pativeis($rows) {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $pativel = new Lista_Pativel();
	            
	            $pativel->set_peca_id($row['lista_pativel_pc_id']);
	            $pativel->set_categoria_id($row['lista_pativel_ca_id']);
	            $pativel->set_marca_id($row['lista_pativel_ma_id']);
				$pativel->set_modelo_id($row['lista_pativel_mo_id']);
				$pativel->set_versao_id($row['lista_pativel_vs_id']);
	            $pativel->set_ano_de($row['lista_pativel_ano_de']);
	            $pativel->set_ano_ate($row['lista_pativel_ano_ate']);
				
				$pativeis[] = $pativel;
			}
            
            return $pativeis;
        }
    }
?>