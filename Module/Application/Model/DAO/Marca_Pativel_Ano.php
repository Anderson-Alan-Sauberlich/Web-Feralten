<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Marca_Pativel_Ano as OBJ_Marca_Pativel_Ano;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Marca_Pativel_Ano
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Marca_Pativel_Ano $obj_marca_pativel_ano) : bool
        {
            try {
                $anos = $obj_marca_pativel_ano->get_anos();
                
                if (!empty($anos) AND !empty($proximo_id_ano)) {
                       foreach ($anos as $ano) {
                           $sql = "INSERT INTO tb_marca_pativel_ano (marca_pativel_ano_id, marca_pativel_ano_ano)
                                   VALUES (:ano_id, :ano);";
                           
                           $p_sql = Conexao::Conectar()->prepare($sql);
                           
                           $p_sql->bindValue(':ano_id', $proximo_id_ano, PDO::PARAM_INT);
                           $p_sql->bindValue(':ano', $ano, PDO::PARAM_INT);
                           
                           $p_sql->execute();
                       }
                       
                       return true;
                } else {
                    return true;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Marca_Pativel_Ano $obj_marca_pativel_ano) : bool
        {
            try {
                
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Por_Objeto(OBJ_Marca_Pativel_Ano $obj_marca_pativel_ano) : bool
        {
            try {
                
            } catch (Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id_peca) : bool
        {
            try {
                $id_anos = self::Pegar_Id_Anos($id_peca);
                
                if (!empty($id_anos)) {
                    foreach ($id_anos as $id_ano) {
                        if (!empty($id_ano)) {
                            if (self::Deletar_Anos($id_ano)) {
                                self::Salvar_Id_Ano($id_ano);
                            }
                        }
                    }
                }
                
                $sql = 'DELETE FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pec_id', $id_peca, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Anos(int $ano_id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_marca_pativel_ano WHERE marca_pativel_ano_id = :ano_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':ano_id', $ano_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                return false;
            }
        }
        
        private static function Salvar_Id_Ano(int $id) : bool
        {
            try {
                $sql = "INSERT INTO tb_id_livre_ano_mrc (id_livre_ano_mrc)
                        VALUES (:id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        private static function Pegar_Proximo_Id_Ano() : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_ano_marca()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function Pegar_Id_Ano(int $peca_id, int $marca_id) : ?int
        {
            try {
                $sql = 'SELECT marca_pativel_ano_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id AND marca_pativel_mrc_id = :mrc_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(':mrc_id', $marca_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $id_ano = $p_sql->fetch(PDO::FETCH_COLUMN);
                
                if (!empty($id_ano) AND $id_ano != false) {
                    return $id_ano;
                } else {
                    return null;
                }
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function Pegar_Id_Anos(int $peca_id) : ?array
        {
            try {
                $sql = 'SELECT marca_pativel_ano_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                $id_anos = $p_sql->fetchAll(PDO::FETCH_COLUMN);
                
                if (!empty($id_anos) AND $id_anos != false) {
                    return $id_anos;
                } else {
                    return null;
                }
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT marca_pativel_pec_id, marca_pativel_mrc_id, marca_pativel_ano_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Marca_Pativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Peca(int $id_peca)
        {
            try {
                $sql = 'SELECT marca_pativel_mrc_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Ano_Por_Id_Ano(int $id_ano)
        {
            try {
                $sql = 'SELECT marca_pativel_ano_ano FROM tb_marca_pativel_ano WHERE marca_pativel_ano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id_ano, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Marca_Pativeis(array $rows) : array
        {
            $pativeis = array();
            
            foreach ($rows as $row) {
                $obj_marca_pativel_ano = new OBJ_Marca_Pativel_Ano();
                
                if (isset($row['marca_pativel_mrc_id'])) {
                    $obj_marca_pativel_ano->set_ano_id($row['marca_pativel_mrc_id']);
                }
                
                if (isset($row['marca_pativel_ano_id'])) {
                    $obj_marca_pativel_ano->set_anos($row['marca_pativel_ano_id']);
                }
                
                $pativeis[] = $obj_marca_pativel_ano;
            }
            
            return $pativeis;
        }
    }
