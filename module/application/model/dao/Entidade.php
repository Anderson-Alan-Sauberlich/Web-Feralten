<?php
namespace module\application\model\dao;
	
    use module\application\model\object\Entidade as Object_Entidade;
    use module\application\model\dao\Endereco as DAO_Endereco;
    use module\application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
	
	class Entidade {

        function __construct() {
            
        }
        
        public static function Inserir(Object_Entidade $object_entidade) {
            try {
                $sql = "INSERT INTO tb_entidade (entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial,
                        entidade_imagem, entidade_site, entidade_data_cadastro) 
                		VALUES (:us_id, :su_id, :cpf_cnpj, :nome, :img, :site, :data);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':us_id', $object_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':su_id', $object_entidade->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':cpf_cnpj', $object_entidade->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $object_entidade->get_nome_comercial(), PDO::PARAM_STR);
                $p_sql->bindValue(':img', $object_entidade->get_imagem(), PDO::PARAM_STR);
				$p_sql->bindValue(':site', $object_entidade->get_site(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $object_entidade->get_data(), PDO::PARAM_STR);
                
                $p_sql->execute();
                
                return Conexao::Conectar()->lastInsertId();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Entidade $object_entidade) : bool {
            try {
                $sql = "UPDATE tb_entidade SET
                entidade_nome_comercial = :nome,
                entidade_imagem = :img,
                entidade_site = :site 
                WHERE entidade_usr_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':us_id', $object_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_entidade->get_nome_comercial(), PDO::PARAM_STR);
                $p_sql->bindValue(':img', $object_entidade->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':site', $object_entidade->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar_Dados(Object_Entidade $object_entidade) : bool {
            try {
                $sql = "UPDATE tb_entidade SET
                entidade_nome_comercial = :nome,
                entidade_site = :site 
                WHERE entidade_usr_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':us_id', $object_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_entidade->get_nome_comercial(), PDO::PARAM_STR);
				$p_sql->bindValue(':site', $object_entidade->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar_Imagem(string $imagem, int $entidade) : bool {
            try {
                $sql = 'UPDATE tb_entidade SET entidade_imagem = :img WHERE entidade_id = :ent_id';

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':ent_id', $entidade, PDO::PARAM_INT);
                $p_sql->bindValue(':img', $imagem, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Deletar(int $id) : bool {
            try {
                $sql = 'DELETE FROM tb_entidade WHERE entidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Verificar_CPF_CNPJ(string $cpf_cnpj) {
        	try {
        		$sql = 'SELECT entidade_id FROM tb_entidade WHERE entidade_cpf_cnpj = :cpf_cnpj';
        
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Pegar_Status_Entidade(int $id) {
            try {
                $sql = 'SELECT entidade_sts_ent_id FROM tb_entidade WHERE entidade_usr_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                return $row['entidade_sts_ent_id'];
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Por_Id_Usuario(int $usuario_id) {
        	try {
        		$sql = "SELECT entidade_id, entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial,
                		entidade_imagem, entidade_site, entidade_data_cadastro
                		FROM tb_entidade WHERE entidade_usr_id = :id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':id', $usuario_id, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		$entidade = $p_sql->fetch(PDO::FETCH_ASSOC);
        		
        		if (!empty($entidade) AND $entidade != false) {
        			return self::PopulaUsuario($entidade);
        		} else {
        			return false;
        		}
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function BuscarPorCOD(int $entidade_id) {
            try {
                $sql = "SELECT entidade_id, entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial, 
                		entidade_imagem, entidade_site, entidade_data_cadastro 
                		FROM tb_entidade WHERE entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $entidade = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($entidade) AND $entidade != false) {
                	return self::PopulaUsuario($entidade);
                } else {
                	return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Pegar_Imagem_Entidade(int $id) : ?string {
        	try {
        		$sql = 'SELECT entidade_imagem FROM tb_entidade WHERE entidade_id = :id';
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(':id', $id, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return null;
        	}
        }
        
        public static function PopulaUsuario(array $row) : Object_Entidade {
            $object_entidade = new Object_Entidade();
            
            if (isset($row['entidade_id'])) {
            	$object_entidade->set_id($row['entidade_id']);
            	$object_entidade->set_endereco(DAO_Endereco::Buscar_Por_Id_Entidade($row['entidade_id']));
            }
            
            if (isset($row['entidade_usr_id'])) {
            	$object_entidade->set_usuario_id($row['entidade_usr_id']);
            }
            
            if (isset($row['entidade_sts_ent_id'])) {
            	$object_entidade->set_status_id($row['entidade_sts_ent_id']);
            }
            
            if (isset($row['entidade_cpf_cnpj'])) {
            	$object_entidade->set_cpf_cnpj($row['entidade_cpf_cnpj']);
            }
            
            if (isset($row['entidade_nome_comercial'])) {
            	$object_entidade->set_nome_comercial($row['entidade_nome_comercial']);
            }
            
            if (isset($row['entidade_imagem'])) {
            	$object_entidade->set_imagem($row['entidade_imagem']);
            }
            
            if (isset($row['entidade_site'])) {
            	$object_entidade->set_site($row['entidade_site']);
            }
            
            if (isset($row['entidade_data_cadastro'])) {
            	$object_entidade->set_data($row['entidade_data_cadastro']);
            }
            
            return $object_entidade;
        }
	}
?>