<?php
namespace application\model\dao;

    require_once RAIZ.'/application/model/object/dados_usuario.php';
    require_once RAIZ.'/application/model/dao/endereco.php';
    require_once RAIZ.'/application/model/util/conexao.php';
    
    use application\model\object\Dados_Usuario as Object_Dados_Usuario;
    use application\model\dao\Endereco as DAO_Endereco;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;
	
	class Dados_Usuario {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Dados_Usuario $object_dados_usuario) : bool {
            try {
                $sql = "INSERT INTO tb_dados_usuario (dados_usuario_us_id, dados_usuario_su_id, dados_usuario_cpf_cnpj, dados_usuario_nome_fantasia,
                        dados_usuario_imagem, dados_usuario_site, dados_usuario_data_cadastro, dados_usuario_telefone1, dados_usuario_telefone2, dados_usuario_email) 
                		VALUES (:us_id, :su_id, :cpf_cnpj, :nome, :imagem, :site, :data, :fone1, :fone2, :email);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":su_id", $object_dados_usuario->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
                $p_sql->bindValue(":imagem", $object_dados_usuario->get_imagem(), PDO::PARAM_STR);
				$p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
                $p_sql->bindValue(":data", $object_dados_usuario->get_data(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone1", $object_dados_usuario->get_telefone1(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone2", $object_dados_usuario->get_telefone2(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $object_dados_usuario->get_email(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Dados_Usuario $object_dados_usuario) : bool {
            try {
                $sql = "UPDATE tb_dados_usuario SET
                dados_usuario_cpf_cnpj = :cpf_cnpj,
                dados_usuario_nome_fantasia = :nome,
                dados_usuario_imagem = :imagem,
                dados_usuario_site = :site,
                dados_usuario_telefone1 = :fone1,
                dados_usuario_telefone2 = :fone2,
                dados_usuario_email = :email 
                WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
                $p_sql->bindValue(":imagem", $object_dados_usuario->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone1", $object_dados_usuario->get_telefone1(), PDO::PARAM_STR);
                $p_sql->bindValue(":fone2", $object_dados_usuario->get_telefone2(), PDO::PARAM_STR);
                $p_sql->bindValue(":email", $object_dados_usuario->get_email(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar_Dados(Object_Dados_Usuario $object_dados_usuario) : bool {
            try {
                $sql = "UPDATE tb_dados_usuario SET
                dados_usuario_cpf_cnpj = :cpf_cnpj,
                dados_usuario_nome_fantasia = :nome,
                dados_usuario_site = :site,
                dados_usuario_telefone1 = :fone1,
                dados_usuario_telefone2 = :fone2,
                dados_usuario_email = :email 
                WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $object_dados_usuario->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":cpf_cnpj", $object_dados_usuario->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(":nome", $object_dados_usuario->get_nome_fantasia(), PDO::PARAM_STR);
				$p_sql->bindValue(":site", $object_dados_usuario->get_site(), PDO::PARAM_STR);
				$p_sql->bindValue(":fone1", $object_dados_usuario->get_telefone1(), PDO::PARAM_STR);
				$p_sql->bindValue(":fone2", $object_dados_usuario->get_telefone2(), PDO::PARAM_STR);
				$p_sql->bindValue(":email", $object_dados_usuario->get_email(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Atualizar_Imagem(string $imagem, int $usuario) : bool {
            try {
                $sql = "UPDATE tb_dados_usuario SET dados_usuario_imagem = :imagem WHERE dados_usuario_us_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":us_id", $usuario, PDO::PARAM_INT);
                $p_sql->bindValue(":imagem", $imagem, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = "DELETE FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function Verificar_CPF_CNPJ(string $cpf_cnpj) {
        	try {
        		$sql = "SELECT dados_usuario_us_id FROM tb_dados_usuario WHERE dados_usuario_cpf_cnpj = :cpf_cnpj";
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":cpf_cnpj", $cpf_cnpj, PDO::PARAM_STR);
        		$p_sql->execute();
        		
        		$row = $p_sql->fetch(PDO::FETCH_ASSOC);
        		
        		$select = 0;
        		
        		if (isset($row['dados_usuario_us_id'])) {
        			$select = $row['dados_usuario_us_id'];
        		}
        		
        		return $select;
        	} catch (PDOException $e) {
        		return false;
        	}
        }
        
        public static function Pegar_Status_Usuario(int $id) {
            try {
                $sql = "SELECT dados_usuario_su_id FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                return $row['dados_usuario_su_id'];
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT dados_usuario_us_id, dados_usuario_su_id, dados_usuario_cpf_cnpj, dados_usuario_nome_fantasia, 
                		dados_usuario_imagem, dados_usuario_site, dados_usuario_data_cadastro, dados_usuario_telefone1, 
                		dados_usuario_telefone2, dados_usuario_email FROM tb_dados_usuario WHERE dados_usuario_us_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
				return false;
            }
        }
        
        public static function PopulaUsuario(array $row) : Object_Dados_Usuario {
            $object_dados_usuario = new Object_Dados_Usuario();
            
            if (isset($row['dados_usuario_us_id'])) {
            	$object_dados_usuario->set_usuario_id($row['dados_usuario_us_id']);
            	$object_dados_usuario->set_endereco(DAO_Endereco::Buscar_Por_Id_Usuario($row['dados_usuario_us_id']));
            }
            
            if (isset($row['dados_usuario_su_id'])) {
            	$object_dados_usuario->set_status_id($row['dados_usuario_su_id']);
            }
            
            if (isset($row['dados_usuario_cpf_cnpj'])) {
            	$object_dados_usuario->set_cpf_cnpj($row['dados_usuario_cpf_cnpj']);
            }
            
            if (isset($row['dados_usuario_nome_fantasia'])) {
            	$object_dados_usuario->set_nome_fantasia($row['dados_usuario_nome_fantasia']);
            }
            
            if (isset($row['dados_usuario_imagem'])) {
            	$object_dados_usuario->set_imagem($row['dados_usuario_imagem']);
            }
            
            if (isset($row['dados_usuario_site'])) {
            	$object_dados_usuario->set_site($row['dados_usuario_site']);
            }
            
            if (isset($row['dados_usuario_data_cadastro'])) {
            	$object_dados_usuario->set_data($row['dados_usuario_data_cadastro']);
            }
            
            if (isset($row['dados_usuario_telefone1'])) {
            	$object_dados_usuario->set_telefone1($row['dados_usuario_telefone1']);
            }
            
            if (isset($row['dados_usuario_telefone2'])) {
            	$object_dados_usuario->set_telefone2($row['dados_usuario_telefone2']);
            }
            
            if (isset($row['dados_usuario_email'])) {
            	$object_dados_usuario->set_email($row['dados_usuario_email']);
            }
            
            return $object_dados_usuario;
        }
	}
?>