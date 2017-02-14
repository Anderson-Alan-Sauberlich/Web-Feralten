<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/modelo_pativel.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Modelo_Pativel as Object_Modelo_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Modelo_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Modelo_Pativel $object_modelo_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_modelo_pativel (modelo_pativel_pc_id, modelo_pativel_mo_id, modelo_pativel_ano_de, modelo_pativel_ano_ate) 
                        VALUES (:pc_id, :mo_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mo_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_modelo_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_modelo_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Modelo_Pativel $object_modelo_pativel) : bool {
            try {
                $sql = "UPDATE tb_modelo_pativel SET
                modelo_pativel_pc_id = :pc_id,
                modelo_pativel_mo_id = :mo_id,
                modelo_pativel_ano_de = :ano_de,
                modelo_pativel_ano_ate = :ano_ate 
                WHERE modelo_pativel_pc_id = :pc_id AND modelo_pativel_mo_id = :mo_id";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_modelo_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mo_id", $object_modelo_pativel->get_modelo_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_modelo_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_modelo_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_modelo_pativel WHERE modelo_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT modelo_pativel_pc_id, modelo_pativel_mo_id, modelo_pativel_ano_de, modelo_pativel_ano_ate FROM tb_modelo_pativel WHERE modelo_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Modelo_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        private static function Popula_Modelo_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_modelo_pativel = new Object_Modelo_Pativel();
	            
	            if (isset($row['modelo_pativel_pc_id'])) {
	            	$object_modelo_pativel->set_peca_id($row['modelo_pativel_pc_id']);
	            }
	            
	            if (isset($row['modelo_pativel_mo_id'])) {
	            	$object_modelo_pativel->set_modelo_id($row['modelo_pativel_mo_id']);
	            }
	            
	            if (isset($row['modelo_pativel_ano_de'])) {
	            	$object_modelo_pativel->set_ano_de($row['modelo_pativel_ano_de']);
	            }
	            
	            if (isset($row['modelo_pativel_ano_ate'])) {
	            	$object_modelo_pativel->set_ano_ate($row['modelo_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_modelo_pativel;
			}
            
            return $pativeis;
        }
    }
?>