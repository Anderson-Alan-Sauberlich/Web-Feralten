<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Entidade
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Entidade $obj_entidade)
        {
            try {
                $sql = "INSERT INTO tb_entidade (entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial,
                        entidade_imagem, entidade_site, entidade_data_cadastro, entidade_pln_id, entidade_int_pag_id, entidade_data_contratacao_plano) 
                        VALUES (:us_id, :su_id, :cpf_cnpj, :nome, :img, :site, :data, :pln_id, :int_pag_id, :data_cnt_pln);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':us_id', $obj_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':su_id', $obj_entidade->get_status_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':cpf_cnpj', $obj_entidade->get_cpf_cnpj(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $obj_entidade->get_nome_comercial(), PDO::PARAM_STR);
                $p_sql->bindValue(':img', $obj_entidade->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':site', $obj_entidade->get_site(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $obj_entidade->get_data(), PDO::PARAM_STR);
                $p_sql->bindValue(':pln_id', $obj_entidade->get_plano_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':int_pag_id', $obj_entidade->get_intervalo_pagamento_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_cnt_pln', $obj_entidade->get_data_contratacao_plano(), PDO::PARAM_STR);
                
                $p_sql->execute();
                
                return Conexao::Conectar()->lastInsertId();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Entidade $obj_entidade) : bool
        {
            try {
                $sql = "UPDATE tb_entidade SET
                entidade_nome_comercial = :nome,
                entidade_imagem = :img,
                entidade_site = :site 
                WHERE entidade_usr_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':us_id', $obj_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_entidade->get_nome_comercial(), PDO::PARAM_STR);
                $p_sql->bindValue(':img', $obj_entidade->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':site', $obj_entidade->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Dados(OBJ_Entidade $obj_entidade) : bool
        {
            try {
                $sql = "UPDATE tb_entidade SET
                entidade_nome_comercial = :nome,
                entidade_site = :site 
                WHERE entidade_usr_id = :us_id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':us_id', $obj_entidade->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_entidade->get_nome_comercial(), PDO::PARAM_STR);
                $p_sql->bindValue(':site', $obj_entidade->get_site(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Status(int $id_entidade, int $id_status_entidade) : bool
        {
            try {
                $sql = "UPDATE tb_entidade SET entidade_sts_ent_id = :sts_ent_id WHERE entidade_id = :ent_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ent_id', $id_entidade, PDO::PARAM_INT);
                $p_sql->bindValue(':sts_ent_id', $id_status_entidade, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Imagem(string $imagem, int $entidade) : bool
        {
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
        
        public static function Atualizar_Financeiro(OBJ_Entidade $obj_entidade) : bool
        {
            try {
                $sql = "UPDATE tb_entidade SET
                entidade_pln_id = :pln_id,
                entidade_int_pag_id = :int_pag_id,
                entidade_data_contratacao_plano = :data_cnt_pln 
                WHERE entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_entidade->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pln_id', $obj_entidade->get_plano_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':int_pag_id', $obj_entidade->get_intervalo_pagamento_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_cnt_pln', $obj_entidade->get_data_contratacao_plano(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_entidade WHERE entidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Verificar_CPF_CNPJ(string $cpf_cnpj)
        {
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
        
        public static function Pegar_Status_Entidade(int $id)
        {
            try {
                $sql = 'SELECT entidade_sts_ent_id FROM tb_entidade WHERE entidade_usr_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Pegar_Plano_Id(int $id)
        {
            try {
                $sql = 'SELECT entidade_pln_id FROM tb_entidade WHERE entidade_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_Id_Usuario(int $usuario_id)
        {
            try {
                $sql = "SELECT entidade_id, entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial,
                        entidade_imagem, entidade_site, entidade_data_cadastro, entidade_pln_id, entidade_int_pag_id, entidade_data_contratacao_plano 
                        FROM tb_entidade WHERE entidade_usr_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $usuario_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $entidade = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($entidade) AND $entidade != false) {
                    return self::PopulaEntidade($entidade);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $entidade_id)
        {
            try {
                $sql = "SELECT entidade_id, entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial, 
                        entidade_imagem, entidade_site, entidade_data_cadastro, entidade_pln_id, entidade_int_pag_id, entidade_data_contratacao_plano 
                        FROM tb_entidade WHERE entidade_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $entidade = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($entidade) AND $entidade != false) {
                    return self::PopulaEntidade($entidade);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarVendedores()
        {
            try {
                $sql = "SELECT entidade_id, entidade_usr_id, entidade_sts_ent_id, entidade_cpf_cnpj, entidade_nome_comercial,
                        entidade_imagem, entidade_site, entidade_data_cadastro, entidade_pln_id, entidade_int_pag_id, entidade_data_contratacao_plano
                        FROM tb_entidade WHERE entidade_id IN (SELECT peca_ent_id FROM tb_peca) ORDER BY -(entidade_nome_comercial)";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaEntidades($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Pegar_Imagem_Entidade(int $id) : ?string
        {
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
        
        public static function PopulaEntidade(array $row) : OBJ_Entidade
        {
            $obj_entidade = new OBJ_Entidade();
            
            if (isset($row['entidade_id'])) {
                $obj_entidade->set_id($row['entidade_id']);
                $obj_entidade->set_endereco(DAO_Endereco::Buscar_Por_Id_Entidade($row['entidade_id']));
            }
            
            if (isset($row['entidade_usr_id'])) {
                $obj_entidade->set_usuario(DAO_Usuario::Buscar_Usuario($row['entidade_usr_id']));
            }
            
            if (isset($row['entidade_sts_ent_id'])) {
                $obj_entidade->set_status_id($row['entidade_sts_ent_id']);
            }
            
            if (isset($row['entidade_cpf_cnpj'])) {
                $obj_entidade->set_cpf_cnpj($row['entidade_cpf_cnpj']);
            }
            
            if (isset($row['entidade_nome_comercial'])) {
                $obj_entidade->set_nome_comercial($row['entidade_nome_comercial']);
            }
            
            if (isset($row['entidade_imagem'])) {
                $obj_entidade->set_imagem($row['entidade_imagem']);
            }
            
            if (isset($row['entidade_site'])) {
                $obj_entidade->set_site($row['entidade_site']);
            }
            
            if (isset($row['entidade_data_cadastro'])) {
                $obj_entidade->set_data($row['entidade_data_cadastro']);
            }
            
            if (isset($row['entidade_pln_id'])) {
                $obj_entidade->set_plano_id($row['entidade_pln_id']);
            }
            
            if (isset($row['entidade_int_pag_id'])) {
                $obj_entidade->set_intervalo_pagamento_id($row['entidade_int_pag_id']);
            }
            
            if (isset($row['entidade_data_contratacao_plano'])) {
                $obj_entidade->set_data_contratacao_plano($row['entidade_data_contratacao_plano']);
            }
            
            return $obj_entidade;
        }
        
        public static function PopulaEntidades(array $rows) : array
        {
            $entidades = [];
            
            foreach ($rows as $row) {
                $obj_entidade = new OBJ_Entidade();
                
                if (isset($row['entidade_id'])) {
                    $obj_entidade->set_id($row['entidade_id']);
                    $obj_entidade->set_endereco(DAO_Endereco::Buscar_Por_Id_Entidade($row['entidade_id']));
                }
                
                if (isset($row['entidade_usr_id'])) {
                    $obj_entidade->set_usuario(DAO_Usuario::Buscar_Usuario($row['entidade_usr_id']));
                }
                
                if (isset($row['entidade_sts_ent_id'])) {
                    $obj_entidade->set_status_id($row['entidade_sts_ent_id']);
                }
                
                if (isset($row['entidade_cpf_cnpj'])) {
                    $obj_entidade->set_cpf_cnpj($row['entidade_cpf_cnpj']);
                }
                
                if (isset($row['entidade_nome_comercial'])) {
                    $obj_entidade->set_nome_comercial($row['entidade_nome_comercial']);
                }
                
                if (isset($row['entidade_imagem'])) {
                    $obj_entidade->set_imagem($row['entidade_imagem']);
                }
                
                if (isset($row['entidade_site'])) {
                    $obj_entidade->set_site($row['entidade_site']);
                }
                
                if (isset($row['entidade_data_cadastro'])) {
                    $obj_entidade->set_data($row['entidade_data_cadastro']);
                }
                
                if (isset($row['entidade_pln_id'])) {
                    $obj_entidade->set_plano_id($row['entidade_pln_id']);
                }
                
                if (isset($row['entidade_int_pag_id'])) {
                    $obj_entidade->set_intervalo_pagamento_id($row['entidade_int_pag_id']);
                }
                
                if (isset($row['entidade_data_contratacao_plano'])) {
                    $obj_entidade->set_data_contratacao_plano($row['entidade_data_contratacao_plano']);
                }
                
                $entidades[] = $obj_entidade;
            }
            
            return $entidades;
        }
    }
