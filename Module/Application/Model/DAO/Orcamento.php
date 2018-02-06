<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Orcamento
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Orcamento $object_orcamento) : bool
        {
            try {
                $sql = "INSERT INTO tb_orcamento (orcamento_id, orcamento_usr_id, orcamento_ctg_id, orcamento_mrc_id, orcamento_mdl_id, orcamento_vrs_id, orcamento_ano_de, orcamento_ano_ate, orcamento_peca_nome, orcamento_numero_serie, orcamento_std_uso_pec_id, orcamento_prf_ntr_id, orcamento_descricao, orcamento_data_solicitacao, orcamento_data_validade) 
                        VALUES (:id, :usr_id, :ctg_id, :mrc_id, :mdl_id, :vrs_id, :ano_de, :ano_ate, :pec_nome, :num_serie, :std_uso_id, :prf_ntr_id, :dscrc, :data_slctc, :data_vldd);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_orcamento->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_orcamento->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ctg_id', $object_orcamento->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mrc_id', $object_orcamento->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mdl_id', $object_orcamento->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrs_id', $object_orcamento->get_versao_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ano_de', $object_orcamento->get_ano_de(), PDO::PARAM_INT);
                $p_sql->bindValue(':ano_ate', $object_orcamento->get_ano_ate(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_nome', $object_orcamento->get_peca_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':num_serie', $object_orcamento->get_numero_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':std_uso_id', $object_orcamento->get_estado_uso_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':prf_ntr_id', $object_orcamento->get_preferencia_entrega_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dscrc', $object_orcamento->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_slctc', $object_orcamento->get_datahora_solicitacao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_vldd', $object_orcamento->get_datahora_validade(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Orcamento $object_orcamento) : bool
        {
            try {
                $sql = "UPDATE tb_orcamento SET
                orcamento_id = :id,
                orcamento_usr_id = :usr_id,
                orcamento_ctg_id = :ctg_id,
                orcamento_mrc_id = :mrc_id,
                orcamento_mdl_id = :mdl_id,
                orcamento_vrs_id = :vrs_id,
                orcamento_ano_de = :ano_de,
                orcamento_ano_ate = :ano_ate,
                orcamento_peca_nome = :pec_nome,
                orcamento_numero_serie = :num_serie,
                orcamento_std_uso_pec_id = :std_uso_id,
                orcamento_prf_ntr_id = :prf_ntr_id,
                orcamento_descricao = :dscrc,
                orcamento_data_solicitacao = :data_slctc,
                orcamento_data_validade = :data_vldd 
                WHERE orcamento_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $object_orcamento->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_orcamento->get_usuario_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ctg_id', $object_orcamento->get_categoria_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mrc_id', $object_orcamento->get_marca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':mdl_id', $object_orcamento->get_modelo_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrs_id', $object_orcamento->get_versao_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ano_de', $object_orcamento->get_ano_de(), PDO::PARAM_INT);
                $p_sql->bindValue(':ano_ate', $object_orcamento->get_ano_ate(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_nome', $object_orcamento->get_peca_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':num_serie', $object_orcamento->get_numero_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':std_uso_id', $object_orcamento->get_estado_uso_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':prf_ntr_id', $object_orcamento->get_preferencia_entrega_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':dscrc', $object_orcamento->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_slctc', $object_orcamento->get_datahora_solicitacao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data_vldd', $object_orcamento->get_datahora_validade(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_orcamento WHERE orcamento_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT orcamento_id, orcamento_usr_id, orcamento_ctg_id, orcamento_mrc_id, orcamento_mdl_id, orcamento_vrs_id, orcamento_ano_de, orcamento_ano_ate, orcamento_peca_nome, orcamento_numero_serie, orcamento_std_uso_pec_id, orcamento_prf_ntr_id, orcamento_descricao, orcamento_data_solicitacao, orcamento_data_validade FROM tb_orcamento WHERE orcamento_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaOrcamento($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Por_ID_Usuario(int $id)
        {
            try {
                $sql = 'SELECT orcamento_id, orcamento_usr_id, orcamento_ctg_id, orcamento_mrc_id, orcamento_mdl_id, orcamento_vrs_id, orcamento_ano_de, orcamento_ano_ate, orcamento_peca_nome, orcamento_numero_serie, orcamento_std_uso_pec_id, orcamento_prf_ntr_id, orcamento_descricao, orcamento_data_solicitacao, orcamento_data_validade FROM tb_orcamento WHERE orcamento_usr_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaOrcamentos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorData(string $data_solicitacao)
        {
            try {
                $sql = 'SELECT orcamento_id, orcamento_data_solicitacao, orcamento_data_validade FROM tb_orcamento WHERE orcamento_data_solicitacao > :data_slctc';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':data_slctc', $data_solicitacao, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopulaOrcamentos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT orcamento_id, orcamento_usr_id, orcamento_ctg_id, orcamento_mrc_id, orcamento_mdl_id, orcamento_vrs_id, orcamento_ano_de, orcamento_ano_ate, orcamento_peca_nome, orcamento_numero_serie, orcamento_std_uso_pec_id, orcamento_prf_ntr_id, orcamento_descricao, orcamento_data_solicitacao, orcamento_data_validade FROM tb_orcamento';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaOrcamentos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaOrcamentos(array $rows) : array
        {
            $orcamentos = array();
            
            foreach ($rows as $row) {
                $object_orcamento = new Object_Orcamento();
                
                if (isset($row['orcamento_id'])) {
                    $object_orcamento->set_id($row['orcamento_id']);
                }
                
                if (isset($row['orcamento_usr_id'])) {
                    $object_orcamento->set_usuario_id($row['orcamento_usr_id']);
                }
                
                if (isset($row['orcamento_ctg_id'])) {
                    $object_orcamento->set_categoria(DAO_Categoria::BuscarPorCOD($row['orcamento_ctg_id']));
                }
                
                if (isset($row['orcamento_mrc_id'])) {
                    $object_orcamento->set_marca(DAO_Marca::BuscarPorCOD($row['orcamento_mrc_id']));
                }
                
                if (isset($row['orcamento_mdl_id'])) {
                    $object_orcamento->set_modelo(DAO_Modelo::BuscarPorCOD($row['orcamento_mdl_id']));
                }
                
                if (isset($row['orcamento_vrs_id'])) {
                    $object_orcamento->set_versao(DAO_Versao::BuscarPorCOD($row['orcamento_vrs_id']));
                }
                
                if (isset($row['orcamento_ano_de'])) {
                    $object_orcamento->set_ano_de($row['orcamento_ano_de']);
                }
                
                if (isset($row['orcamento_ano_ate'])) {
                    $object_orcamento->set_ano_ate($row['orcamento_ano_ate']);
                }
                
                if (isset($row['orcamento_peca_nome'])) {
                    $object_orcamento->set_peca_nome($row['orcamento_peca_nome']);
                }
                
                if (isset($row['orcamento_numero_serie'])) {
                    $object_orcamento->set_numero_serie($row['orcamento_numero_serie']);
                }
                
                if (isset($row['orcamento_std_uso_pec_id'])) {
                    $object_orcamento->set_estado_uso_id($row['orcamento_std_uso_pec_id']);
                }
                
                if (isset($row['orcamento_prf_ntr_id'])) {
                    $object_orcamento->set_preferencia_entrega_id($row['orcamento_prf_ntr_id']);
                }
                
                if (isset($row['orcamento_descricao'])) {
                    $object_orcamento->set_descricao($row['orcamento_descricao']);
                }
                
                if (isset($row['orcamento_data_solicitacao'])) {
                    $object_orcamento->set_datahora_solicitacao($row['orcamento_data_solicitacao']);
                }
                
                if (isset($row['orcamento_data_validade'])) {
                    $object_orcamento->set_datahora_validade($row['orcamento_data_validade']);
                }
                
                $orcamentos[] = $object_orcamento;
            }

            return $orcamentos;
        }
        
        public static function PopulaOrcamento(array $row) : Object_Orcamento
        {
            $object_orcamento = new Object_Orcamento();
            
            if (isset($row['orcamento_id'])) {
                $object_orcamento->set_id($row['orcamento_id']);
            }
            
            if (isset($row['orcamento_usr_id'])) {
                $object_orcamento->set_usuario_id($row['orcamento_usr_id']);
            }
            
            if (isset($row['orcamento_ctg_id'])) {
                $object_orcamento->set_categoria(DAO_Categoria::BuscarPorCOD($row['orcamento_ctg_id']));
            }
            
            if (isset($row['orcamento_mrc_id'])) {
                $object_orcamento->set_marca(DAO_Marca::BuscarPorCOD($row['orcamento_mrc_id']));
            }
            
            if (isset($row['orcamento_mdl_id'])) {
                $object_orcamento->set_modelo(DAO_Modelo::BuscarPorCOD($row['orcamento_mdl_id']));
            }
            
            if (isset($row['orcamento_vrs_id'])) {
                $object_orcamento->set_versao(DAO_Versao::BuscarPorCOD($row['orcamento_vrs_id']));
            }
            
            if (isset($row['orcamento_ano_de'])) {
                $object_orcamento->set_ano_de($row['orcamento_ano_de']);
            }
            
            if (isset($row['orcamento_ano_ate'])) {
                $object_orcamento->set_ano_ate($row['orcamento_ano_ate']);
            }
            
            if (isset($row['orcamento_peca_nome'])) {
                $object_orcamento->set_peca_nome($row['orcamento_peca_nome']);
            }
            
            if (isset($row['orcamento_numero_serie'])) {
                $object_orcamento->set_numero_serie($row['orcamento_numero_serie']);
            }
            
            if (isset($row['orcamento_std_uso_pec_id'])) {
                $object_orcamento->set_estado_uso_id($row['orcamento_std_uso_pec_id']);
            }
            
            if (isset($row['orcamento_prf_ntr_id'])) {
                $object_orcamento->set_preferencia_entrega_id($row['orcamento_prf_ntr_id']);
            }
            
            if (isset($row['orcamento_descricao'])) {
                $object_orcamento->set_descricao($row['orcamento_descricao']);
            }
            
            if (isset($row['orcamento_data_solicitacao'])) {
                $object_orcamento->set_datahora_solicitacao($row['orcamento_data_solicitacao']);
            }
            
            if (isset($row['orcamento_data_validade'])) {
                $object_orcamento->set_datahora_validade($row['orcamento_data_validade']);
            }
            
            return $object_orcamento;
        }
    }
