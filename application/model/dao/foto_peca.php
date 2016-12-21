<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/foto_peca.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Foto_Peca as Object_Foto_Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Foto_Peca {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Foto_Peca $object_foto_peca) : bool {
            try {
                $sql = "INSERT INTO tb_foto_peca (foto_peca_id, foto_peca_pc_id, foto_peca_endereco, foto_peca_numero) 
                        VALUES (:id, :pc_id, :endereco, :num);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_foto_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":pc_id", $object_foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":endereco", $object_foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(":num", $object_foto_peca->get_numero(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Foto_Peca $object_foto_peca) : bool {
            try {
                $sql = "UPDATE tb_foto_peca SET foto_peca_id = :id, foto_peca_pc_id = :pc_id, foto_peca_endereco = :endereco, foto_peca_numero = :num WHERE foto_peca_pc_id = :pc_id AND foto_peca_numero = :num";

                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":id", $object_foto_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":pc_id", $object_foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":endereco", $object_foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(":num", $object_foto_peca->get_numero(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar_Fotos(int $id_peca) : bool {
            try {
                $sql = "DELETE FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar_Foto(int $id_peca, int $num_peca) : bool {
            try {
                $sql = "DELETE FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id AND foto_peca_numero = :num";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
				$p_sql->bindValue(":num", $num_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
		
        public static function Buscar_Fotos(int $id_peca) {
            try {
                $sql = "SELECT foto_peca_id, foto_peca_pc_id, foto_peca_endereco, foto_peca_numero FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFotosPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Foto(int $id_peca, int $num_peca) {
            try {
                $sql = "SELECT foto_peca_id, foto_peca_pc_id, foto_peca_endereco, foto_peca_numero FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id AND foto_peca_numero = :num";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
				$p_sql->bindValue(":num", $num_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFotoPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
		
        private static function PopulaFotoPeca(array $row) : Object_Foto_Peca {
            $object_foto_peca = new Object_Foto_Peca();
            
            if (isset($row['foto_peca_id'])) {
            	$object_foto_peca->set_id($row['foto_peca_id']);
            }
            
            if (isset($row['foto_peca_pc_id'])) {
            	$object_foto_peca->set_peca_id($row['foto_peca_pc_id']);
            }
            
            if (isset($row['foto_peca_endereco'])) {
            	$object_foto_peca->set_endereco($row['foto_peca_endereco']);
            }
            
            if (isset($row['foto_peca_numero'])) {
            	$object_foto_peca->set_numero($row['foto_peca_numero']);
            }
            
            return $object_foto_peca;
        }
        
        private static function PopulaFotosPecas(array $rows) : array {
            $fotos_pecas = array();
            
            if (!empty($rows)) {
	            foreach ($rows as $row) {
	                $object_foto_peca = new Object_Foto_Peca();
	                
	                if (isset($row['foto_peca_id'])) {
	                	$object_foto_peca->set_id($row['foto_peca_id']);
	                }
	                
	                if (isset($row['foto_peca_pc_id'])) {
	                	$object_foto_peca->set_peca_id($row['foto_peca_pc_id']);
	                }
	                
	                if (isset($row['foto_peca_endereco'])) {
	                	$object_foto_peca->set_endereco($row['foto_peca_endereco']);
	                }
	                
	                if (isset($row['foto_peca_numero'])) {
	                	$object_foto_peca->set_numero($row['foto_peca_numero']);
	                }
	                
	                $fotos_pecas[] = $object_foto_peca;
	            }
            }

            return $fotos_pecas;
        }
    }
?>