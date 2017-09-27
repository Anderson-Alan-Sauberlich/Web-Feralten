<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Contador_Clique as Object_Contador_Clique;
    use module\application\model\dao\Peca as DAO_Peca;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
    class Contador_Clique {
		
        function __construct() {
            
        }
        
        public static function Inserir(Object_Contador_Clique $object_contador_clique) : bool {
            try {
                $object_contador_clique->set_id(self::Achar_ID_Livre($object_contador_clique->get_object_peca()->get_id()));
                
                $sql = "INSERT INTO tb_contador_clique (contador_clique_id, contador_clique_pec_id, contador_clique_datahora) 
                        VALUES (:id, :pec_id, :datahora);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(':id', $object_contador_clique->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $object_contador_clique->get_object_peca()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_contador_clique->get_datahora(), PDO::PARAM_STR);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Contador_Clique $object_contador_clique) : bool {
            try {
                $sql = "UPDATE tb_contador_clique SET
                contador_clique_id = :id,
                contador_clique_pec_id = :pec_id,
                contador_clique_datahora = :datahora 
                WHERE contador_clique_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_contador_clique->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $object_contador_clique->get_object_peca()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':datahora', $object_contador_clique->get_datahora(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_contador_clique WHERE contador_clique_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
				
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Achar_ID_Livre(int $peca_id) : ?int {
            try {
                $sql = 'SELECT fc_achar_id_livre_contador_clique(:pec_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = 'SELECT contador_clique_id, contador_clique_pec_id, contador_clique_datahora FROM tb_contador_clique WHERE contador_clique_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaContatosAnunciante($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD_Usuario(int $id) {
            try {
                $sql = 'SELECT contador_clique_id, contador_clique_pec_id, contador_clique_datahora FROM vw_pec_cnt_clq WHERE peca_responsavel_usr_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaContatosAnunciante($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaContatosAnunciante(array $rows) : array {
            $contador_cliques = array();
            
            foreach ($rows as $row) {
                $object_contador_clique = new Object_Contador_Clique();
            	
                if (isset($row['contador_clique_id'])) {
                	$object_contador_clique->set_id($row['contador_clique_id']);
                }
                
                if (isset($row['contador_clique_pec_id'])) {
                    $object_contador_clique->set_object_peca(DAO_Peca::BuscarPorCOD($row['contador_clique_pec_id']));
                }
                                
                if (isset($row['contador_clique_datahora'])) {
                    $object_contador_clique->set_datahora($row['contador_clique_datahora']);
                }
                
                $contador_cliques[] = $object_contador_clique;
            }

            return $contador_cliques;
        }
        
        public static function PopulaContatoAnunciante(array $row) : Object_Contador_Clique {
            $object_contador_clique = new Object_Contador_Clique();
            
            if (isset($row['contador_clique_id'])) {
            	$object_contador_clique->set_id($row['contador_clique_id']);
            }
            
            if (isset($row['contador_clique_pec_id'])) {
                $object_contador_clique->set_object_peca(DAO_Peca::BuscarPorCOD($row['contador_clique_pec_id']));
            }
            
            if (isset($row['contador_clique_datahora'])) {
                $object_contador_clique->set_datahora($row['contador_clique_datahora']);
            }
            
            return $object_contador_clique;
        }
    }
?>