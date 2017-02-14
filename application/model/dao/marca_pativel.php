<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/marca_pativel.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Marca_Pativel as Object_Marca_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Marca_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Marca_Pativel $object_marca_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_marca_pativel (marca_pativel_pc_id, marca_pativel_ma_id, marca_pativel_ano_de, marca_pativel_ano_ate) 
                        VALUES (:pc_id, :ma_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ma_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_marca_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_marca_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Marca_Pativel $object_marca_pativel) : bool {
            try {
                $sql = "UPDATE tb_marca_pativel SET
                marca_pativel_pc_id = :pc_id,
                marca_pativel_ma_id = :ma_id,
                marca_pativel_ano_de = :ano_de,
                marca_pativel_ano_ate = :ano_ate 
                WHERE marca_pativel_pc_id = :pc_id AND marca_pativel_ma_id = :ma_id";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ma_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_marca_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_marca_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_marca_pativel WHERE marca_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT marca_pativel_pc_id, marca_pativel_ma_id, marca_pativel_ano_de, marca_pativel_ano_ate FROM tb_marca_pativel WHERE marca_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Marca_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        private static function Popula_Marca_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_marca_pativel = new Object_Marca_Pativel();
				
	            if (isset($row['marca_pativel_pc_id'])) {
	            	$object_marca_pativel->set_peca_id($row['marca_pativel_pc_id']);
	            }
	            
	            if (isset($row['marca_pativel_ma_id'])) {
	            	$object_marca_pativel->set_marca_id($row['marca_pativel_ma_id']);
	            }
	            
	            if (isset($row['marca_pativel_ano_de'])) {
	            	$object_marca_pativel->set_ano_de($row['marca_pativel_ano_de']);
	            }
	            
	            if (isset($row['marca_pativel_ano_ate'])) {
	            	$object_marca_pativel->set_ano_ate($row['marca_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_marca_pativel;
			}
            
            return $pativeis;
        }
    }
?>