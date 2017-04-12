<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/endereco.php';
    require_once RAIZ.'/application/model/dao/cidade.php';
    require_once RAIZ.'/application/model/dao/estado.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Endereco as Object_Endereco;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\dao\Estado as DAO_Estado;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Endereco {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Endereco $object_endereco) : bool {
            try {
                $sql = "INSERT INTO tb_endereco (endereco_id, endereco_cid_id, endereco_ent_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, 
                                                 endereco_bairro) VALUES (:id, :ci_id, :ent_id, :es_id, :numero, :cep, :rua, :complemento, :bairro);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_endereco->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ci_id", $object_endereco->get_cidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $object_endereco->get_estado()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ent_id", $object_endereco->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":numero", $object_endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(":cep", $object_endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(":rua", $object_endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(":complemento", $object_endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(":bairro", $object_endereco->get_bairro(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Endereco $object_endereco) : bool {
            try {
                $sql = "UPDATE tb_endereco SET
                endereco_cid_id = :ci_id,
                endereco_ent_id = :ent_id,
                endereco_est_id = :es_id,
                endereco_numero = :numero,
                endereco_cep = :cep,
                endereco_rua = :rua,
                endereco_complemento = :complemento,
                endereco_bairro = :bairro 
                WHERE endereco_ent_id = :ent_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":ci_id", $object_endereco->get_cidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":ent_id", $object_endereco->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":es_id", $object_endereco->get_estado()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":numero", $object_endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(":cep", $object_endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(":rua", $object_endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(":complemento", $object_endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(":bairro", $object_endereco->get_bairro(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_endereco WHERE endereco_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Endereco(int $endereco_id) {
        	try {
        		$sql = "SELECT endereco_id, endereco_ent_id, endereco_cid_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, endereco_bairro FROM tb_endereco WHERE endereco_id = :id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $endereco_id, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		$endereco = $p_sql->fetch(PDO::FETCH_ASSOC);
        		
        		if (!empty($endereco) AND $endereco != false) {
        			return self::PopulaEndereco($endereco);
        		} else {
        			return false;
        		}
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Por_Id_Entidade(int $entidade_id) {
            try {
                $sql = "SELECT endereco_id, endereco_ent_id, endereco_cid_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, endereco_bairro FROM tb_endereco WHERE endereco_ent_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $endereco = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($endereco) AND $endereco != false) {
                	return self::PopulaEndereco($endereco);
                } else {
                	return false;
                }
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Entidade(int $entidade_id) {
        	try {
        		$sql = "SELECT endereco_id FROM tb_endereco WHERE endereco_ent_id = :id";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $entidade_id, PDO::PARAM_INT);
        		$p_sql->execute();
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        		
        		return $row['endereco_id'];
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function PopulaEndereco(array $row) : Object_Endereco {
            $object_endereco = new Object_Endereco();
            
            if (isset($row['endereco_id'])) {
            	$object_endereco->set_id($row['endereco_id']);
            }
            
            if (isset($row['endereco_cid_id'])) {
            	$object_endereco->set_cidade(DAO_Cidade::Buscar_Por_ID_Cidade($row['endereco_cid_id']));
            }
            
            if (isset($row['endereco_ent_id'])) {
            	$object_endereco->set_entidade_id($row['endereco_ent_id']);
            }
            
            if (isset($row['endereco_est_id'])) {
            	$object_endereco->set_estado(DAO_Estado::BuscarPorCOD($row['endereco_est_id']));
            }
            
            if (isset($row['endereco_numero'])) {
            	$object_endereco->set_numero($row['endereco_numero']);
            }
            
            if (isset($row['endereco_cep'])) {
            	$object_endereco->set_cep($row['endereco_cep']);
            }
            
            if (isset($row['endereco_rua'])) {
            	$object_endereco->set_rua($row['endereco_rua']);
            }
            
            if (isset($row['endereco_complemento'])) {
            	$object_endereco->set_complemento($row['endereco_complemento']);
            }
            
            if (isset($row['endereco_bairro'])) {
            	$object_endereco->set_bairro($row['endereco_bairro']);
            }
            
            return $object_endereco;
        }
    }
?>