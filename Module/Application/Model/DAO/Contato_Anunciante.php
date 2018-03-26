<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Contato_Anunciante as OBJ_Contato_Anunciante;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Contato_Anunciante
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Contato_Anunciante $obj_contato_anunciante) : bool
        {
            try {
                $obj_contato_anunciante->set_id(self::Achar_ID_Livre($obj_contato_anunciante->get_obj_peca()->get_id()));
                
                $sql = "INSERT INTO tb_contato_anunciante (contato_anunciante_id, contato_anunciante_pec_id, contato_anunciante_nome, contato_anunciante_email, contato_anunciante_aprovacao, contato_anunciante_lido, contato_anunciante_telefone, contato_anunciante_whatsapp, contato_anunciante_mensagem, contato_anunciante_datahora_envio) 
                        VALUES (:id, :pec_id, :nome, :email, :aprovacao, :lido, :telefone, :whatsapp, :mensagem, :datahora_envio);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_contato_anunciante->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $obj_contato_anunciante->get_obj_peca()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_contato_anunciante->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':email', $obj_contato_anunciante->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(':aprovacao', $obj_contato_anunciante->get_aprovacao(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':lido', $obj_contato_anunciante->get_lido(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':telefone', $obj_contato_anunciante->get_telefone(), PDO::PARAM_STR);
                $p_sql->bindValue(':whatsapp', $obj_contato_anunciante->get_whatsapp(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':mensagem', $obj_contato_anunciante->get_mensagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':datahora_envio', $obj_contato_anunciante->get_datahora_envio(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Contato_Anunciante $obj_contato_anunciante) : bool
        {
            try {
                $sql = "UPDATE tb_contato_anunciante SET
                contato_anunciante_id = :id,
                contato_anunciante_pec_id = :pec_id,
                contato_anunciante_nome = :nome,
                contato_anunciante_email = :email,
                contato_anunciante_aprovacao = :aprovacao,
                contato_anunciante_lido = :lido,
                contato_anunciante_telefone = :telefone,
                contato_anunciante_whatsapp = :whatsapp,
                contato_anunciante_mensagem = :mensagem,
                contato_anunciante_datahora_envio = :datahora_envio 
                WHERE contato_anunciante_id = :id";

                $p_sql = Conexao::Conectar()->prepare($sql);

                $p_sql->bindValue(':id', $obj_contato_anunciante->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':pec_id', $obj_contato_anunciante->get_obj_peca()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_contato_anunciante->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':email', $obj_contato_anunciante->get_email(), PDO::PARAM_STR);
                $p_sql->bindValue(':aprovacao', $obj_contato_anunciante->get_aprovacao(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':lido', $obj_contato_anunciante->get_lido(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':telefone', $obj_contato_anunciante->get_telefone(), PDO::PARAM_STR);
                $p_sql->bindValue(':whatsapp', $obj_contato_anunciante->get_whatsapp(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':mensagem', $obj_contato_anunciante->get_mensagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':datahora_envio', $obj_contato_anunciante->get_datahora_envio(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_contato_anunciante WHERE contato_anunciante_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar_Por_Peca(int $peca_id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_contato_anunciante WHERE contato_anunciante_pec_id = :pec_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Achar_ID_Livre(int $peca_id) : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_contato_anunciante(:pec_id)';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT contato_anunciante_id, contato_anunciante_pec_id, contato_anunciante_nome, contato_anunciante_email, contato_anunciante_aprovacao, contato_anunciante_lido, contato_anunciante_telefone, contato_anunciante_whatsapp, contato_anunciante_mensagem, contato_anunciante_datahora_envio FROM tb_contato_anunciante WHERE contato_anunciante_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaContatosAnunciante($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaContatosAnunciante(array $rows) : array
        {
            $contato_anunciantes = array();
            
            foreach ($rows as $row) {
                $obj_contato_anunciante = new OBJ_Contato_Anunciante();
                
                if (isset($row['contato_anunciante_id'])) {
                    $obj_contato_anunciante->set_id($row['contato_anunciante_id']);
                }
                
                if (isset($row['contato_anunciante_pec_id'])) {
                    $obj_contato_anunciante->set_obj_peca(DAO_Peca::BuscarPorCOD($row['contato_anunciante_pec_id']));
                }
                
                if (isset($row['contato_anunciante_nome'])) {
                    $obj_contato_anunciante->set_nome($row['contato_anunciante_nome']);
                }
                
                if (isset($row['contato_anunciante_email'])) {
                    $obj_contato_anunciante->set_email($row['contato_anunciante_email']);
                }
                
                if (isset($row['contato_anunciante_aprovacao'])) {
                    $obj_contato_anunciante->set_aprovacao($row['contato_anunciante_aprovacao']);
                }
                
                if (isset($row['contato_anunciante_lido'])) {
                    $obj_contato_anunciante->set_lido($row['contato_anunciante_lido']);
                }
                
                if (isset($row['contato_anunciante_telefone'])) {
                    $obj_contato_anunciante->set_telefone($row['contato_anunciante_telefone']);
                }
                
                if (isset($row['contato_anunciante_whatsapp'])) {
                    $obj_contato_anunciante->set_whatsapp($row['contato_anunciante_whatsapp']);
                }
                
                if (isset($row['contato_anunciante_mensagem'])) {
                    $obj_contato_anunciante->set_mensagem($row['contato_anunciante_mensagem']);
                }
                
                if (isset($row['contato_anunciante_datahora_envio'])) {
                    $obj_contato_anunciante->set_datahora_envio($row['contato_anunciante_datahora_envio']);
                }
                
                $contato_anunciantes[] = $obj_contato_anunciante;
            }

            return $contato_anunciantes;
        }
        
        public static function PopulaContatoAnunciante(array $row) : OBJ_Contato_Anunciante
        {
            $obj_contato_anunciante = new OBJ_Contato_Anunciante();
            
            if (isset($row['contato_anunciante_id'])) {
                $obj_contato_anunciante->set_id($row['contato_anunciante_id']);
            }
            
            if (isset($row['contato_anunciante_pec_id'])) {
                $obj_contato_anunciante->set_obj_peca(DAO_Peca::BuscarPorCOD($row['contato_anunciante_pec_id']));
            }
            
            if (isset($row['contato_anunciante_nome'])) {
                $obj_contato_anunciante->set_nome($row['contato_anunciante_nome']);
            }
            
            if (isset($row['contato_anunciante_email'])) {
                $obj_contato_anunciante->set_email($row['contato_anunciante_email']);
            }
            
            if (isset($row['contato_anunciante_aprovacao'])) {
                $obj_contato_anunciante->set_aprovacao($row['contato_anunciante_aprovacao']);
            }
            
            if (isset($row['contato_anunciante_lido'])) {
                $obj_contato_anunciante->set_lido($row['contato_anunciante_lido']);
            }
            
            if (isset($row['contato_anunciante_telefone'])) {
                $obj_contato_anunciante->set_telefone($row['contato_anunciante_telefone']);
            }
            
            if (isset($row['contato_anunciante_whatsapp'])) {
                $obj_contato_anunciante->set_whatsapp($row['contato_anunciante_whatsapp']);
            }
            
            if (isset($row['contato_anunciante_mensagem'])) {
                $obj_contato_anunciante->set_mensagem($row['contato_anunciante_mensagem']);
            }
            
            if (isset($row['contato_anunciante_datahora_envio'])) {
                $obj_contato_anunciante->set_datahora_envio($row['contato_anunciante_datahora_envio']);
            }
            
            return $obj_contato_anunciante;
        }
    }
