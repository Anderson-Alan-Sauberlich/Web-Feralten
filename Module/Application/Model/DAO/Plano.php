<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Plano as OBJ_Plano;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Plano
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Plano $obj_plano) : bool
        {
            try {
                $sql = "INSERT INTO tb_plano (plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao) 
                        VALUES (:id, :vlr_msl, :vlr_anl, :lmt_pcs, :dsc);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_plano->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_msl', $obj_plano->get_valor_mensal(), PDO::PARAM_STR);
                $p_sql->bindValue(':vrl_anl', $obj_plano->get_valor_anual(), PDO::PARAM_STR);
                $p_sql->bindValue(':vrl_lmt_pcs', $obj_plano->get_limite_pecas(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_plano->get_descricao(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Plano $obj_plano) : bool
        {
            try {
                $sql = "UPDATE tb_plano SET
                        plano_id = :id,
                        plano_valor_mensal = :vrl_msl,
                           plano_valor_anual = :vrl_anl,
                        plano_limite_pecas = :lmt_pcs,
                        plano_descricao = :dsc 
                        WHERE plano_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_plano->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':vrl_msl', $obj_plano->get_valor_mensal(), PDO::PARAM_STR);
                $p_sql->bindValue(':vrl_anl', $obj_plano->get_valor_anual(), PDO::PARAM_STR);
                $p_sql->bindValue(':vrl_lmt_pcs', $obj_plano->get_limite_pecas(), PDO::PARAM_INT);
                $p_sql->bindValue(':dsc', $obj_plano->get_descricao(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
 
         public static function Deletar(int $id) : bool
         {
            try {
                $sql = 'DELETE FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarTodos()
        {
            try {
                $sql = 'SELECT plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao FROM tb_plano';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaArrayPlanos($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT plano_id, plano_valor_mensal, plano_valor_anual, plano_limite_pecas, plano_descricao FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPlano($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarValorMensalPorCOD(int $id)
        {
            try {
                $sql = 'SELECT plano_valor_mensal FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Limite_Por_Id(int $id)
        {
            try {
                $sql = 'SELECT plano_limite_pecas FROM tb_plano WHERE plano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaArrayPlanos(array $rows) : array
        {
            $planos = array();
            
            foreach ($rows as $row) {
                $obj_plano = new OBJ_Plano();
                $bool = true;
                
                if (isset($row['plano_id'])) {
                    $obj_plano->set_id($row['plano_id']);
                } else {
                    $bool = false;
                }
                
                if (isset($row['plano_valor_mensal'])) {
                    $obj_plano->set_valor_mensal($row['plano_valor_mensal']);
                } else {
                    $bool = false;
                }
                
                if (isset($row['plano_valor_anual'])) {
                    $obj_plano->set_valor_anual($row['plano_valor_anual']);
                } else {
                    $bool = false;
                }
                
                if (isset($row['plano_limite_pecas'])) {
                    $obj_plano->set_limite_pecas($row['plano_limite_pecas']);
                } else {
                    $bool = false;
                }
                
                if (isset($row['plano_descricao'])) {
                    $obj_plano->set_descricao($row['plano_descricao']);
                } else {
                    $bool = false;
                }
                
                if ($bool) {
                    $planos[$row['plano_id']] = $obj_plano;
                }
            }
            
            return $planos;
        }
        
        public static function PopulaPlano(array $row) : OBJ_Plano
        {
            $obj_plano = new OBJ_Plano();
            
            if (isset($row['plano_id'])) {
                $obj_plano->set_id($row['plano_id']);
            }
            
            if (isset($row['plano_valor_mensal'])) {
                $obj_plano->set_valor_mensal($row['plano_valor_mensal']);
            }
            
            if (isset($row['plano_valor_anual'])) {
                $obj_plano->set_valor_anual($row['plano_valor_anual']);
            }
            
            if (isset($row['plano_limite_pecas'])) {
                $obj_plano->set_limite_pecas($row['plano_limite_pecas']);
            }
            
            if (isset($row['plano_descricao'])) {
                $obj_plano->set_descricao($row['plano_descricao']);
            }
            
            return $obj_plano;
        }
    }
