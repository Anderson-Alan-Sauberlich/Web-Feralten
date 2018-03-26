<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Foto_Peca as OBJ_Foto_Peca;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Foto_Peca
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Foto_Peca $obj_foto_peca) : bool
        {
            try {
                $sql = "INSERT INTO tb_foto_peca (foto_peca_pec_id, foto_peca_endereco, foto_peca_numero, foto_peca_nome) 
                        VALUES (:pc_id, :endereco, :num, :nome);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pc_id', $obj_foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':endereco', $obj_foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(':num', $obj_foto_peca->get_numero(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_foto_peca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Foto_Peca $obj_foto_peca) : bool
        {
            try {
                $sql = "UPDATE tb_foto_peca SET foto_peca_pec_id = :pc_id, foto_peca_endereco = :endereco, foto_peca_numero = :num, foto_peca_nome = :nome WHERE foto_peca_pec_id = :pc_id AND foto_peca_numero = :num";

                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pc_id', $obj_foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':endereco', $obj_foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(':num', $obj_foto_peca->get_numero(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_foto_peca->get_nome(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Por_Num(int $numero, OBJ_Foto_Peca $obj_foto_peca) : bool
        {
            try {
                $sql = "UPDATE tb_foto_peca SET foto_peca_endereco = :endereco, foto_peca_numero = :numero, foto_peca_nome = :nome WHERE foto_peca_pec_id = :pc_id AND foto_peca_numero = :num";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pc_id', $obj_foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':endereco', $obj_foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(':num', $obj_foto_peca->get_numero(), PDO::PARAM_INT);
                $p_sql->bindValue(':numero', $numero, PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_foto_peca->get_nome(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Fotos(int $id_peca) : bool
        {
            try {
                $sql = 'DELETE FROM tb_foto_peca WHERE foto_peca_pec_id = :pc_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pc_id', $id_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Foto(int $id_peca, int $num_peca) : bool
        {
            try {
                $sql = 'DELETE FROM tb_foto_peca WHERE foto_peca_pec_id = :pc_id AND foto_peca_numero = :num';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pc_id', $id_peca, PDO::PARAM_INT);
                $p_sql->bindValue(':num', $num_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Fotos(int $id_peca)
        {
            try {
                $sql = 'SELECT foto_peca_pec_id, foto_peca_endereco, foto_peca_numero, foto_peca_nome FROM tb_foto_peca WHERE foto_peca_pec_id = :pc_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pc_id', $id_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFotosPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Foto(int $id_peca, int $num_peca)
        {
            try {
                $sql = 'SELECT foto_peca_pec_id, foto_peca_endereco, foto_peca_numero, foto_peca_nome FROM tb_foto_peca WHERE foto_peca_pec_id = :pc_id AND foto_peca_numero = :num';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pc_id', $id_peca, PDO::PARAM_INT);
                $p_sql->bindValue(':num', $num_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                $foto = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($foto) AND $foto !== false) {
                    return self::PopulaFotoPeca($foto);
                } else {
                    return null;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaFotoPeca(array $row) : OBJ_Foto_Peca
        {
            $obj_foto_peca = new OBJ_Foto_Peca();
            
            if (isset($row['foto_peca_pec_id'])) {
                $obj_foto_peca->set_peca_id($row['foto_peca_pec_id']);
            }
            
            if (isset($row['foto_peca_endereco'])) {
                $obj_foto_peca->set_endereco($row['foto_peca_endereco']);
            }
            
            if (isset($row['foto_peca_numero'])) {
                $obj_foto_peca->set_numero($row['foto_peca_numero']);
            }
            
            if (isset($row['foto_peca_nome'])) {
                $obj_foto_peca->set_nome($row['foto_peca_nome']);
            }
            
            return $obj_foto_peca;
        }
        
        public static function PopulaFotosPecas(array $rows) : array
        {
            $fotos_pecas = array();
            
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $obj_foto_peca = new OBJ_Foto_Peca();
                    
                    if (isset($row['foto_peca_pec_id'])) {
                        $obj_foto_peca->set_peca_id($row['foto_peca_pec_id']);
                    }
                    
                    if (isset($row['foto_peca_endereco'])) {
                        $obj_foto_peca->set_endereco($row['foto_peca_endereco']);
                    }
                    
                    if (isset($row['foto_peca_numero'])) {
                        $obj_foto_peca->set_numero($row['foto_peca_numero']);
                    }
                    
                    if (isset($row['foto_peca_nome'])) {
                        $obj_foto_peca->set_nome($row['foto_peca_nome']);
                    }
                    
                    $fotos_pecas[] = $obj_foto_peca;
                }
            }

            return $fotos_pecas;
        }
    }
