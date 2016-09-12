<?php
namespace application\model\dao;

    require_once(RAIZ.'/application/model/object/class_foto_peca.php');
    require_once(RAIZ.'/application/model/util/conexao.php');
    
    use application\model\object\Foto_Peca;
    use application\model\util\Conexao;
    use \PDO;
    use \PDOException;

    class DAO_Foto_Peca {

        function __construct() {
            
        }
        
        public static function Inserir(Foto_Peca $foto_peca) {
            try {
                $sql = "INSERT INTO tb_foto_peca (foto_peca_pc_id, foto_peca_endereco, foto_peca_numero) 
                        VALUES (:pc_id, :endereco, :num);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":pc_id", $foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":endereco", $foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(":num", $foto_peca->get_numero(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Atualizar(Foto_Peca $foto_peca) {
            try {
                $sql = "UPDATE tb_foto_peca SET foto_peca_pc_id = :pc_id, foto_peca_endereco = :endereco, foto_peca_numero = :num WHERE foto_peca_pc_id = :pc_id AND foto_peca_numero = :num";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(":pc_id", $foto_peca->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(":endereco", $foto_peca->get_endereco(), PDO::PARAM_STR);
                $p_sql->bindValue(":num", $foto_peca->get_numero(), PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar_Fotos($id_peca) {
            try {
                $sql = "DELETE FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Deletar_Foto($id_peca, $num_peca) {
            try {
                $sql = "DELETE FROM tb_foto_peca WHERE foto_peca_pc_id = :pc_id AND foto_peca_numero = :num";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
				$p_sql->bindValue(":num", $num_peca, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
		
        public static function Buscar_Fotos($id_peca) {
            try {
                $sql = "SELECT foto_peca_pc_id, foto_peca_endereco, foto_peca_numero FROM tb_foto_peca WHERE foto_peca_pc_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFotosPecas($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
        
        public static function Buscar_Foto($id_peca, $num_peca) {
            try {
                $sql = "SELECT foto_peca_pc_id, foto_peca_endereco, foto_peca_numero FROM tb_foto_peca WHERE foto_peca_pc_id = :id AND foto_peca_numero = :num";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":pc_id", $id_peca, PDO::PARAM_INT);
				$p_sql->bindValue(":num", $num_peca, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaFotoPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
            }
        }
		
        private function PopulaFotoPeca($row) {
            $foto_peca = new Foto_Peca();
            
            $foto_peca->set_peca_id($row['foto_peca_pc_id']);
            $foto_peca->set_endereco($row['foto_peca_endereco']);
            $foto_peca->set_numero($row['foto_peca_numero']);

            return $foto_peca;
        }
        
        private function PopulaFotosPecas($rows) {
            $fotos_pecas = array();
            
            foreach ($rows as $row) {
                $foto_peca = new Foto_Peca();
                
                $foto_peca->set_peca_id($row['foto_peca_pc_id']);
                $foto_peca->set_endereco($row['foto_peca_endereco']);
                $foto_peca->set_numero($row['foto_peca_numero']);
                
                $fotos_pecas[] = $foto_peca;
            }

            return $fotos_pecas;
        }
    }
?>