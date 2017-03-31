<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/versao_pativel.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Versao_Pativel as Object_Versao_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Versao_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Versao_Pativel $object_versao_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_versao_pativel (versao_pativel_pec_id, versao_pativel_vrs_id, versao_pativel_ano_de, versao_pativel_ano_ate) 
                        VALUES (:pc_id, :vs_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_versao_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":vs_id", $object_versao_pativel->get_versao_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_versao_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_versao_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Versao_Pativel $object_versao_pativel) : bool {
            try {
                $sql = "UPDATE tb_versao_pativel SET
                versao_pativel_pec_id = :pc_id,
                versao_pativel_vrs_id = :vs_id,
                versao_pativel_ano_de = :ano_de,
                versao_pativel_ano_ate = :ano_ate 
                WHERE versao_pativel_pec_id = :pc_id AND versao_pativel_vrs_id = :vs_id";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_versao_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":vs_id", $object_versao_pativel->get_versao_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_versao_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_versao_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_versao_pativel WHERE versao_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT versao_pativel_pec_id, versao_pativel_vrs_id, versao_pativel_ano_de, versao_pativel_ano_ate FROM tb_versao_pativel WHERE versao_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Lista_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Popula_Lista_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_versao_pativel = new Object_Versao_Pativel();
	            
	            if (isset($row['versao_pativel_pec_id'])) {
	            	$object_versao_pativel->set_peca_id($row['versao_pativel_pec_id']);
	            }
	            
	            if (isset($row['versao_pativel_vrs_id'])) {
	            	$object_versao_pativel->set_versao_id($row['versao_pativel_vrs_id']);
	            }
	            
	            if (isset($row['versao_pativel_ano_de'])) {
	            	$object_versao_pativel->set_ano_de($row['versao_pativel_ano_de']);
	            }
	            
	            if (isset($row['versao_pativel_ano_ate'])) {
	            	$object_versao_pativel->set_ano_ate($row['versao_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_versao_pativel;
			}
            
            return $pativeis;
        }
    }
?>