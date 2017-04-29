<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/estado.php';
    require_once RAIZ.'/application/model/common/util/conexao.php';
    
    use application\model\object\Estado as Object_Estado;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
	
    class Estado {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Estado $object_estado) : bool {
            try {
                $sql = "INSERT INTO tb_estado (estado_id, estado_uf, estado_nome) 
                        VALUES (:id, :uf, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_estado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":uf", $object_estado->get_uf(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_estado->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Estado $object_estado) : bool {
            try {
                $sql = "UPDATE tb_estado SET estado_id = :id, estado_uf = :uf, estado_nome = :nome 
                		WHERE estado_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":id", $object_estado->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":uf", $object_estado->get_uf(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_estado->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_estado WHERE estado_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT estado_id, estado_uf, estado_nome FROM tb_estado WHERE estado_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popular_Estado($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarTodos() {
            try {
                $sql = "SELECT estado_id, estado_uf, estado_nome FROM tb_estado";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::Popular_Estados($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Popular_Estado(array $row) : Object_Estado {
        	$object_estado = new Object_Estado();
        	
        	if (isset($row['estado_id'])) {
        		$object_estado->set_id($row['estado_id']);
        	}
        	
        	if (isset($row['estado_uf'])) {
        		$object_estado->set_uf($row['estado_uf']);
        	}
			
       		if (isset($row['estado_nome'])) {
        		$object_estado->set_nome($row['estado_nome']);
        	}
        
        	return $object_estado;
        }
        
        public static function Popular_Estados(array $rows) : array {
            $estados = array();
            
            foreach ($rows as $row) {
                $object_estado = new Object_Estado();
                
                if (isset($row['estado_id'])) {
                	$object_estado->set_id($row['estado_id']);
                }
                
                if (isset($row['estado_uf'])) {
                	$object_estado->set_uf($row['estado_uf']);
                }
                
                if (isset($row['estado_nome'])) {
                	$object_estado->set_nome($row['estado_nome']);
                }
                
                $estados[] = $object_estado;
            }
            
            return $estados;
        }
    }
?>