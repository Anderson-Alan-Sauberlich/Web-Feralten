<?php
namespace Module\Administration\Model\DAO;
    
    use Module\Administration\Model\Object\Patrocinador as Object_Patrocinador;
    use Module\Administration\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    class Usuario_Admin
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Patrocinador $object_patrocinador) : bool
        {
            try {
                $sql = 'INSERT INTO tb_patrocinador (patrocinador_id, patrocinador_link, patrocinador_imagem, patrocinador_status, patrocinador_descricao, patrocinador_nome, patrocinador_data_inicio, patrocinador_data_fim) 
                        VALUES (:id, :link, :imagem, :status, :descricao, :nome, :inicio, :fim);';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_patrocinador->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':link', $object_patrocinador->get_link(), PDO::PARAM_STR);
                $p_sql->bindValue(':imagem', $object_patrocinador->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':status', $object_patrocinador->get_status(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':descricao', $object_patrocinador->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $object_patrocinador->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':inicio', $object_patrocinador->get_data_inicio(), PDO::PARAM_STR);
                $p_sql->bindValue(':fim', $object_patrocinador->get_data_fim(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Patrocinador $object_patrocinador) : bool
        {
            try {
                $sql = 'UPDATE tb_patrocinador SET
                        patrocinador_id = :id, 
                        patrocinador_nome = :nome, 
                        patrocinador_imagem = :imagem,
                        patrocinador_link = :link,
                        patrocinador_status = :status,
                        patrocinador_descricao = :descricao,
                        patrocinador_data_inicio = :inicio,
                        patrocinador_data_fim = :fim 
                        WHERE patrocinador_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_patrocinador->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':link', $object_patrocinador->get_link(), PDO::PARAM_STR);
                $p_sql->bindValue(':imagem', $object_patrocinador->get_imagem(), PDO::PARAM_STR);
                $p_sql->bindValue(':status', $object_patrocinador->get_status(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':descricao', $object_patrocinador->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':nome', $object_patrocinador->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':inicio', $object_patrocinador->get_data_inicio(), PDO::PARAM_STR);
                $p_sql->bindValue(':fim', $object_patrocinador->get_data_fim(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                $sql = 'DELETE FROM tb_patrocinador WHERE patrocinador_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Usuario(int $id)
        {
            try {
                $sql = 'SELECT patrocinador_id, patrocinador_link, patrocinador_imagem, patrocinador_status, patrocinador_descricao, patrocinador_nome, patrocinador_data_inicio, patrocinador_data_fim 
                        FROM tb_patrocinador WHERE patrocinador_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPatrocinador($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaPatrocinador(array $row) : Object_Patrocinador
        {
            $object_patrocinador = new Object_Patrocinador();
            
            if (isset($row['patrocinador_id'])) {
                $object_patrocinador->set_id($row['patrocinador_id']);
            }
            
            if (isset($row['patrocinador_nome'])) {
                $object_patrocinador->set_nome($row['patrocinador_nome']);
            }
            
            if (isset($row['patrocinador_imagem'])) {
                $object_patrocinador->set_imagem($row['patrocinador_imagem']);
            }
            
            if (isset($row['patrocinador_link'])) {
                $object_patrocinador->set_link($row['patrocinador_link']);
            }
            
            if (isset($row['patrocinador_status'])) {
                $object_patrocinador->set_status($row['patrocinador_status']);
            }
            
            if (isset($row['patrocinador_descricao'])) {
                $object_patrocinador->set_descricao($row['patrocinador_descricao']);
            }
            
            if (isset($row['patrocinador_data_inicio'])) {
                $object_patrocinador->set_data_inicio($row['patrocinador_data_inicio']);
            }
            
            if (isset($row['patrocinador_data_fim'])) {
                $object_patrocinador->set_data_fim($row['patrocinador_data_fim']);
            }
            
            return $object_patrocinador;
        }
    }
