<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Categoria_Pativel_Ano as Object_Categoria_Pativel_Ano;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Categoria_Pativel_Ano
    {
        
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Categoria_Pativel_Ano $object_categoria_pativel_ano) : bool
        {
            try {
                $anos = $object_categoria_pativel_ano->get_anos();
                
                if (!empty($anos) AND !empty($object_categoria_pativel_ano->get_ano_id())) {
                    foreach ($anos as $ano) {
                           $sql = "INSERT INTO tb_categoria_pativel_ano (categoria_pativel_ano_id, categoria_pativel_ano_ano)
                                   VALUES (:ano_id, :ano);";
                           
                           $p_sql = Conexao::Conectar()->prepare($sql);
                           
                           $p_sql->bindValue(':ano_id', $object_categoria_pativel_ano->get_ano_id(), PDO::PARAM_INT);
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
        
        public static function Atualizar(Object_Categoria_Pativel_Ano $object_categoria_pativel_ano) : bool
        {
            try {
                
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Por_Objeto(Object_Categoria_Pativel_Ano $object_categoria_pativel_ano) : bool
        {
            try {
                
            } catch (Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id_ano) : bool
        {
            try {
                
            } catch (Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Anos(int $ano_id) : bool
        {
            try {
                
            } catch (Exception $e) {
                return false;
            }
        }
        
        private static function Salvar_Id_Ano(int $id) : bool
        {
            try {
                $sql = "INSERT INTO tb_id_livre_ano_ctg (id_livre_ano_ctg)
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
                $sql = 'SELECT fc_achar_id_livre_ano_categoria()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT categoria_pativel_ano_id, categoria_pativel_ano_ano FROM tb_categoria_pativel_ano WHERE categoria_pativel_ano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Categoria_Pativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Ano_Por_Id_Ano(int $id_ano)
        {
            try {
                $sql = 'SELECT categoria_pativel_ano_ano FROM tb_categoria_pativel_ano WHERE categoria_pativel_ano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id_ano, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Popula_Categoria_Pativeis(array $rows) : array
        {
            $pativeis = array();
            
            foreach ($rows as $row) {
                $object_categoria_pativel_ano = new Object_Categoria_Pativel_Ano();
                
                if (isset($row['categoria_pativel_ctg_id'])) {
                    $object_categoria_pativel_ano->set_ano_id();
                }
                
                if (isset($row['categoria_pativel_ano_id'])) {
                    $object_categoria_pativel_ano->set_anos($row['categoria_pativel_ano_id']);
                }
                
                $pativeis[] = $object_categoria_pativel_ano;
            }
            
            return $pativeis;
        }
    }
