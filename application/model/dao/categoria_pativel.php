<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/categoria_pativel.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Categoria_Pativel as Object_Categoria_Pativel;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Categoria_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_categoria_pativel (categoria_pativel_pc_id, categoria_pativel_ca_id, categoria_pativel_ano_de, categoria_pativel_ano_ate) 
                        VALUES (:pc_id, :ca_id, :ano_de, :ano_ate);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Categoria_Pativel $object_categoria_pativel) : bool {
            try {
                $sql = "UPDATE tb_categoria_pativel SET
                categoria_pativel_pc_id = :pc_id,
                categoria_pativel_ca_id = :ca_id,
                categoria_pativel_ano_de = :ano_de,
                categoria_pativel_ano_ate = :ano_ate 
                WHERE categoria_pativel_pc_id = :pc_id AND categoria_pativel_ca_id = :ca_id";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pc_id", $object_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ca_id", $object_categoria_pativel->get_categoria_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_de", $object_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
				$p_sql->bindValue(":ano_ate", $object_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_categoria_pativel WHERE categoria_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT categoria_pativel_pc_id, categoria_pativel_ca_id, categoria_pativel_ano_de, categoria_pativel_ano_ate FROM tb_categoria_pativel WHERE categoria_pativel_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Categoria_Pativeis($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        private static function Popula_Categoria_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_categoria_pativel = new Object_Categoria_Pativel();
	            
	            if (isset($row['categoria_pativel_pc_id'])) {
	            	$object_categoria_pativel->set_peca_id($row['categoria_pativel_pc_id']);
	            }
	            
	            if (isset($row['categoria_pativel_ca_id'])) {
	            	$object_categoria_pativel->set_categoria_id($row['categoria_pativel_ca_id']);
	            }
	            
	            if (isset($row['categoria_pativel_ano_de'])) {
	            	$object_categoria_pativel->set_ano_de($row['categoria_pativel_ano_de']);
	            }
	            
	            if (isset($row['categoria_pativel_ano_ate'])) {
	            	$object_categoria_pativel->set_ano_ate($row['categoria_pativel_ano_ate']);
	            }
	            
				$pativeis[] = $object_categoria_pativel;
			}
            
            return $pativeis;
        }
    }
?>