<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Versao_Pativel_Ano as Object_Versao_Pativel_Ano;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Versao_Pativel_Ano
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Versao_Pativel_Ano $object_versao_pativel_ano) : bool
        {
            try {
                $anos = $object_versao_pativel->get_anos();
                
                if (!empty($anos) AND !empty($proximo_id_ano)) {
                    foreach ($anos as $ano) {
                        $sql = "INSERT INTO tb_versao_pativel_ano (versao_pativel_ano_id, versao_pativel_ano_ano)
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
        
        public static function Atualizar(Object_Versao_Pativel_Ano $object_versao_pativel_ano) : bool
        {
            try {
                
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Por_Objeto(Object_Versao_Pativel_Ano $object_versao_pativel_ano) : bool
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
                
                $sql = 'DELETE FROM tb_versao_pativel WHERE versao_pativel_pec_id = :pec_id';
                
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
                $sql = 'DELETE FROM tb_versao_pativel_ano WHERE versao_pativel_ano_id = :ano_id';
                
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
                $sql = "INSERT INTO tb_id_livre_ano_vrs (id_livre_ano_vrs)
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
                $sql = 'SELECT fc_achar_id_livre_ano_versao()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function Pegar_Id_Ano(int $peca_id, int $versao_id) : ?int
        {
            try {
                $sql = 'SELECT versao_pativel_ano_id FROM tb_versao_pativel WHERE versao_pativel_pec_id = :pec_id AND versao_pativel_vrs_id = :vrs_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(':vrs_id', $versao_id, PDO::PARAM_INT);
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
                $sql = 'SELECT versao_pativel_ano_id FROM tb_versao_pativel WHERE versao_pativel_pec_id = :pec_id';
                
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
                $sql = 'SELECT versao_pativel_pec_id, versao_pativel_vrs_id, versao_pativel_ano_id FROM tb_versao_pativel WHERE versao_pativel_pec_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Lista_Pativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Peca(int $id_peca)
        {
            try {
                $sql = 'SELECT versao_pativel_vrs_id FROM tb_versao_pativel WHERE versao_pativel_pec_id = :id';
                
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
                $sql = 'SELECT versao_pativel_ano_ano FROM tb_versao_pativel_ano WHERE versao_pativel_ano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id_ano, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Lista_Pativeis(array $rows) : array
        {
            $pativeis = array();
            
            foreach ($rows as $row) {
                $object_versao_pativel_ano = new Object_Versao_Pativel_Ano();
                
                if (isset($row['versao_pativel_vrs_id'])) {
                    $object_versao_pativel_ano->set_ano_id($row['versao_pativel_vrs_id']);
                }
                
                if (isset($row['versao_pativel_ano_id'])) {
                    $object_versao_pativel_ano->set_anos($row['versao_pativel_ano_id']);
                }
                
                $pativeis[] = $object_versao_pativel_ano;
            }
            
            return $pativeis;
        }
    }
