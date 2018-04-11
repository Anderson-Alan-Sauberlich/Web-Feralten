<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Cancelar_Contratacao as OBJ_Cancelar_Contratacao;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Cancelar_Contratacao
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Cancelar_Contratacao $obj_cancelar_contratacao) : bool
        {
            try {
                self::Deletar($obj_cancelar_contratacao->get_obj_usuario()->get_id());
                
                $sql = "INSERT INTO tb_cancelar_contratacao (cancelar_contratacao_ent_id, cancelar_contratacao_data_hora, cancelar_contratacao_codigo) 
                        VALUES (:ent_id, :data_hora, :codigo);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ent_id', $obj_cancelar_contratacao->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_hora', $obj_cancelar_contratacao->get_data_hora(), PDO::PARAM_STR);
                $p_sql->bindValue(':codigo', $obj_cancelar_contratacao->get_codigo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Cancelar_Contratacao $obj_cancelar_contratacao) : bool
        {
            try {
                $sql = "UPDATE tb_cancelar_contratacao SET cancelar_contratacao_usuario_id = :ent_id, cancelar_contratacao_data_hora = :data_hora, cancelar_contratacao_codigo = :codigo WHERE cancelar_contratacao_usr_id = :usr_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ent_id', $obj_cancelar_contratacao->get_obj_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':data_hora', $obj_cancelar_contratacao->get_data_hora(), PDO::PARAM_STR);
                $p_sql->bindValue(':codigo', $obj_cancelar_contratacao->get_codigo(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
         
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_cancelar_contratacao WHERE cancelar_contratacao_ent_id = :ent_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ent_id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCodigo(string $codigo)
        {
            try {
                $sql = 'SELECT cancelar_contratacao_ent_id, cancelar_contratacao_data_hora, cancelar_contratacao_codigo FROM tb_cancelar_contratacao WHERE cancelar_contratacao_codigo = :codigo';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':codigo', $codigo, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::PopularCancelarContratacao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorId(int $id)
        {
            try {
                $sql = 'SELECT cancelar_contratacao_ent_id, cancelar_contratacao_data_hora, cancelar_contratacao_codigo FROM tb_cancelar_contratacao WHERE cancelar_contratacao_ent_id = :ent_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ent_id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopularCancelarContratacao($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT cancelar_contratacao_ent_id, cancelar_contratacao_data_hora, cancelar_contratacao_codigo FROM tb_cancelar_contratacao';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopularCancelarContratacoes($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopularCancelarContratacao(array $row) : OBJ_Cancelar_Contratacao
        {
            $obj_cancelar_contratacao = new OBJ_Cancelar_Contratacao();
            
            if (isset($row['cancelar_contratacao_ent_id'])) {
                $obj_cancelar_contratacao->set_obj_entidade(DAO_Entidade::Buscar_Entidade($row['cancelar_contratacao_ent_id']));
            }
            
            if (isset($row['cancelar_contratacao_data_hora'])) {
                $obj_cancelar_contratacao->set_data_hora($row['cancelar_contratacao_data_hora']);
            }
            
            if (isset($row['cancelar_contratacao_codigo'])) {
                $obj_cancelar_contratacao->set_codigo($row['cancelar_contratacao_codigo']);
            }
            
            return $obj_cancelar_contratacao;
        }
        
        public static function PopularCancelarContratacoes(array $rows) : array
        {
            $cancelar_contratacoes = [];
            
            foreach ($rows as $row) {
                $obj_cancelar_contratacao = new OBJ_Cancelar_Contratacao();
                
                if (isset($row['cancelar_contratacao_ent_id'])) {
                    $obj_cancelar_contratacao->set_obj_entidade(DAO_Entidade::Buscar_Entidade($row['cancelar_contratacao_ent_id']));
                }
                
                if (isset($row['cancelar_contratacao_data_hora'])) {
                    $obj_cancelar_contratacao->set_data_hora($row['cancelar_contratacao_data_hora']);
                }
                
                if (isset($row['cancelar_contratacao_codigo'])) {
                    $obj_cancelar_contratacao->set_codigo($row['cancelar_contratacao_codigo']);
                }
                
                $cancelar_contratacoes[] = $obj_cancelar_contratacao;
            }
            
            return $cancelar_contratacoes;
        }
    }
