<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\DAO\Cidade as DAO_Cidade;
    use Module\Application\Model\DAO\Estado as DAO_Estado;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Endereco
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Endereco $obj_endereco) : bool
        {
            try {
                $sql = "INSERT INTO tb_endereco (endereco_id, endereco_cid_id, endereco_ent_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, 
                                                 endereco_bairro) VALUES (:id, :ci_id, :ent_id, :es_id, :numero, :cep, :rua, :complemento, :bairro);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_endereco->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ci_id', $obj_endereco->get_cidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':es_id', $obj_endereco->get_estado()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_endereco->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':numero', $obj_endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(':cep', $obj_endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(':rua', $obj_endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(':complemento', $obj_endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(':bairro', $obj_endereco->get_bairro(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Endereco $obj_endereco) : bool
        {
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
                
                $p_sql->bindValue(':ci_id', $obj_endereco->get_cidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_endereco->get_entidade_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':es_id', $obj_endereco->get_estado()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':numero', $obj_endereco->get_numero(), PDO::PARAM_STR);
                $p_sql->bindValue(':cep', $obj_endereco->get_cep(), PDO::PARAM_STR);
                $p_sql->bindValue(':rua', $obj_endereco->get_rua(), PDO::PARAM_STR);
                $p_sql->bindValue(':complemento', $obj_endereco->get_complemento(), PDO::PARAM_STR);
                $p_sql->bindValue(':bairro', $obj_endereco->get_bairro(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_endereco WHERE endereco_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_Id_Endereco(int $endereco_id)
        {
            try {
                $sql = 'SELECT endereco_id, endereco_ent_id, endereco_cid_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, endereco_bairro FROM tb_endereco WHERE endereco_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $endereco_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $endereco = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($endereco) AND $endereco != false) {
                    return self::PopulaEndereco($endereco);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_Id_Entidade(int $entidade_id)
        {
            try {
                $sql = 'SELECT endereco_id, endereco_ent_id, endereco_cid_id, endereco_est_id, endereco_numero, endereco_cep, endereco_rua, endereco_complemento, endereco_bairro FROM tb_endereco WHERE endereco_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $endereco = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($endereco) AND $endereco != false) {
                    return self::PopulaEndereco($endereco);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Entidade(int $entidade_id)
        {
            try {
                $sql = 'SELECT endereco_id FROM tb_endereco WHERE endereco_ent_id = :id';
        
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, OBJ_Endereco $obj_endereco) : string
        {
            if (!empty($obj_endereco->get_id())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_id = :end_id";
            }
            if (!empty($obj_endereco->get_entidade_id())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_ent_id = :ent_id";
            }
            if (!empty($obj_endereco->get_cidade())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_cid_id = :cid_id";
            }
            if (!empty($obj_endereco->get_estado())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_est_id = :est_id";
            }
            if (!empty($obj_endereco->get_numero())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_numero = :numero";
            }
            if (!empty($obj_endereco->get_cep())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_cep = :cep";
            }
            if (!empty($obj_endereco->get_rua())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_rua = :rua";
            }
            if (!empty($obj_endereco->get_complemento())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_complemento = :complemento";
            }
            if (!empty($obj_endereco->get_bairro())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "endereco_bairro = :bairro";
            }
            
            return $pesquisa;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, OBJ_Endereco $obj_endereco) : PDOStatement
        {
            if (!empty($obj_endereco->get_id())) {
                $p_sql->bindValue(':end_id', $obj_endereco->get_id(), PDO::PARAM_INT);
            }
            if (!empty($obj_endereco->get_entidade_id())) {
                $p_sql->bindValue(':ent_id', $obj_endereco->get_entidade_id(), PDO::PARAM_INT);
            }
            if (!empty($obj_endereco->get_cidade())) {
                $p_sql->bindValue(':cid_id', $obj_endereco->get_cidade()->get_id(), PDO::PARAM_INT);
            }
            if (!empty($obj_endereco->get_estado())) {
                $p_sql->bindValue(':est_id', $obj_endereco->get_estado()->get_id(), PDO::PARAM_INT);
            }
            if (!empty($obj_endereco->get_numero())) {
                $p_sql->bindValue(':numero', $obj_endereco->get_numero(), PDO::PARAM_INT);
            }
            if (!empty($obj_endereco->get_cep())) {
                $p_sql->bindValue(':cep', $obj_endereco->get_cep(), PDO::PARAM_STR);
            }
            if (!empty($obj_endereco->get_rua())) {
                $p_sql->bindValue(':rua', $obj_endereco->get_rua(), PDO::PARAM_STR);
            }
            if (!empty($obj_endereco->get_complemento())) {
                $p_sql->bindValue(':complemento', $obj_endereco->get_complemento(), PDO::PARAM_STR);
            }
            if (!empty($obj_endereco->get_bairro())) {
                $p_sql->bindValue(':bairro', $obj_endereco->get_bairro(), PDO::PARAM_STR);
            }
            
            return $p_sql;
        }
        
        public static function PopulaEndereco(array $row) : OBJ_Endereco
        {
            $obj_endereco = new OBJ_Endereco();
            
            if (isset($row['endereco_id'])) {
                $obj_endereco->set_id($row['endereco_id']);
            }
            
            if (isset($row['endereco_cid_id'])) {
                $obj_endereco->set_cidade(DAO_Cidade::Buscar_Por_ID_Cidade($row['endereco_cid_id']));
            }
            
            if (isset($row['endereco_ent_id'])) {
                $obj_endereco->set_entidade_id($row['endereco_ent_id']);
            }
            
            if (isset($row['endereco_est_id'])) {
                $obj_endereco->set_estado(DAO_Estado::BuscarPorCOD($row['endereco_est_id']));
            }
            
            if (isset($row['endereco_numero'])) {
                $obj_endereco->set_numero($row['endereco_numero']);
            }
            
            if (isset($row['endereco_cep'])) {
                $obj_endereco->set_cep($row['endereco_cep']);
            }
            
            if (isset($row['endereco_rua'])) {
                $obj_endereco->set_rua($row['endereco_rua']);
            }
            
            if (isset($row['endereco_complemento'])) {
                $obj_endereco->set_complemento($row['endereco_complemento']);
            }
            
            if (isset($row['endereco_bairro'])) {
                $obj_endereco->set_bairro($row['endereco_bairro']);
            }
            
            return $obj_endereco;
        }
    }
