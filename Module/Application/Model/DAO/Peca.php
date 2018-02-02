<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\Object\Peca as Object_Peca;
    use Module\Application\Model\DAO\Foto_Peca as DAO_Foto_Peca;
    use Module\Application\Model\DAO\Status_Peca as DAO_Status_Peca;
    use Module\Application\Model\DAO\Estado_Uso_Peca as DAO_Estado_Uso_Peca;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Categoria_Pativel as DAO_Categoria_Pativel;
    use Module\Application\Model\DAO\Marca_Pativel as DAO_Marca_Pativel;
    use Module\Application\Model\DAO\Modelo_Pativel as DAO_Modelo_Pativel;
    use Module\Application\Model\DAO\Versao_Pativel as DAO_Versao_Pativel;
    use Module\Application\Model\DAO\Contato_Anunciante as DAO_Contato_Anunciante;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Peca
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(Object_Peca $object_peca)
        {
            try {
                if (empty($object_peca->get_id())) {
                    $id_peca = self::Achar_ID_Livre();
                    
                    if (empty($id_peca)) {
                        $object_peca->set_id(0);
                    } else {
                        $object_peca->set_id($id_peca);
                    }
                }
                
                $sql = "INSERT INTO tb_peca (peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado) 
                        VALUES (:id, :ent_id, :usr_id, :end_id, :st_id, :nome, :url, :fabricante, :preco, :descricao, :data, :serie, :prioridade, :prf_ntr, :std_uso_id, :num_visualizado);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_peca->get_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_peca->get_responsavel()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':end_id', $object_peca->get_endereco()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':st_id', $object_peca->get_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_peca->get_url(), PDO::PARAM_STR);
                $p_sql->bindValue(':fabricante', $object_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(':preco', $object_peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(':descricao', $object_peca->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $object_peca->get_data_anuncio(), PDO::PARAM_STR);
                $p_sql->bindValue(':serie', $object_peca->get_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':prioridade', $object_peca->get_prioridade(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':prf_ntr', $object_peca->get_preferencia_entrega(), PDO::PARAM_INT);
                $p_sql->bindValue(':std_uso_id', $object_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':num_visualizado', $object_peca->get_num_visualizado(), PDO::PARAM_INT);
                
                if ($p_sql->execute()) {
                    return Conexao::Conectar()->lastInsertId();
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(Object_Peca $object_peca) : bool
        {
            try {
                $sql = "UPDATE tb_peca SET 
                        peca_id = :id, 
                        peca_ent_id = :ent_id, 
                        peca_responsavel_usr_id = :usr_id,
                        peca_end_id = :end_id, 
                        peca_sts_pec_id = :st_id, 
                        peca_nome = :nome, 
                        peca_url = :url, 
                        peca_fabricante = :fabricante, 
                        peca_preco = :preco, 
                        peca_descricao = :descricao, 
                        peca_data_anuncio = :data, 
                        peca_numero_serie = :serie, 
                        peca_prioridade = :prioridade, 
                        peca_prf_ntr_id = :prf_ntr,
                        peca_std_uso_pec_id = :std_uso_id,
                        peca_num_visualizado = :num_visualizado 
                        WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $object_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $object_peca->get_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $object_peca->get_responsavel()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':end_id', $object_peca->get_endereco()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':st_id', $object_peca->get_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $object_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $object_peca->get_url(), PDO::PARAM_STR);
                $p_sql->bindValue(':fabricante', $object_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(':preco', $object_peca->get_preco(), PDO::PARAM_INT);
                $p_sql->bindValue(':descricao', $object_peca->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $object_peca->get_data_anuncio(), PDO::PARAM_STR);
                $p_sql->bindValue(':serie', $object_peca->get_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':prioridade', $object_peca->get_prioridade(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':prf_ntr', $object_peca->get_preferencia_entrega(), PDO::PARAM_INT);
                $p_sql->bindValue(':std_uso_id', $object_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':num_visualizado', $object_peca->get_num_visualizado(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_Status(int $id_peca, int $id_status) : bool
        {
            try {
                $sql = "UPDATE tb_peca SET peca_sts_pec_id = :st_id WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id_peca, PDO::PARAM_INT);
                $p_sql->bindValue(':st_id', $id_status, PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar_URL(int $id_peca, int $url) : bool
        {
            try {
                $sql = "UPDATE tb_peca SET peca_url = :url WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id_peca, PDO::PARAM_INT);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Deletar(int $id) : bool
        {
            try {
                DAO_Categoria_Pativel::Deletar($id);
                DAO_Marca_Pativel::Deletar($id);
                DAO_Modelo_Pativel::Deletar($id);
                DAO_Versao_Pativel::Deletar($id);
                DAO_Foto_Peca::Deletar_Fotos($id);
                DAO_Contato_Anunciante::Deletar_Por_Peca($id);
                
                $sql = 'DELETE FROM tb_peca WHERE peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                if ($p_sql->execute()) {
                    if (self::Salvar_Id_Peca($id)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Achar_ID_Livre() : ?int
        {
            try {
                $sql = 'SELECT fc_achar_id_livre_peca()';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return null;
            }
        }
        
        private static function Salvar_Id_Peca(int $id) : bool
        {
            try {
                $sql = "INSERT INTO tb_id_livre_peca (id_livre_peca)
                        VALUES (:id);";
                
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
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado FROM tb_peca WHERE peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Quantidade_Pecas_Por_Entidade(int $id)
        {
            try {
                $sql = 'SELECT COUNT(peca_id) FROM tb_peca WHERE peca_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorURL(string $url)
        {
            try {
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado FROM tb_peca WHERE peca_url = :url';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':url', $url, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPeca($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(Object_Peca $object_peca, array $form_filtro)
        {
            $pesquisa = '';
            
            $pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_peca, $form_filtro);
            
            if (!empty($pesquisa)) {
                if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                    $pesquisa = "WHERE $pesquisa";
                }
            }
            
            try {
                $sql = "SELECT peca_id FROM vw_peca $pesquisa";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $object_peca, $form_filtro);
                
                $p_sql->execute();
                $select = $p_sql->fetchAll();
                $cont = count($select);
                
                return ceil($cont / 9);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Pecas(Object_Peca $object_peca, array $form_filtro, int $pg)
        {
            $limite = 9;
            $inicio = ($pg * $limite) - $limite;
            $pesquisa = "";
            
            $pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_peca, $form_filtro);
            
            if (!empty($pesquisa)) {
                if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                    $pesquisa = "WHERE $pesquisa";
                }
            }
            
            try {
                $sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade, peca_std_uso_pec_id, peca_num_visualizado 
                FROM vw_peca $pesquisa LIMIT :inicio, :limite";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $object_peca, $form_filtro);
                
                $p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, Object_Peca $object_peca, array $form_filtro) : string
        {
            if (!empty($object_peca->get_entidade())) {
                $object_entidade = $object_peca->get_entidade();
                
                if (!empty($object_entidade->get_usuario_id())) {
                    if (!empty($pesquisa)) {
                        $pesquisa .= " AND ";
                    }
                    $pesquisa .= "peca_ent_id = :ent_id";
                }
            }
            
            if (!empty($object_peca->get_endereco())) {
                $object_endereco = $object_peca->get_endereco();
                
                $pesquisa = DAO_Endereco::Criar_String_Pesquisa($pesquisa, $object_endereco);
            }
            
            if (!empty($object_peca->get_status())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_sts_pec_id = :sp_id";
            } else {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_sts_pec_id != 3";
            }
            
            if (!empty($object_peca->get_estado_uso())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_std_uso_pec_id = :std_uso_id";
            }
            
            if (!empty($object_peca->get_nome())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_nome LIKE '%' :nome '%'";
            }
            
            if (!empty($object_peca->get_url())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_url = :url";
            }
            
            if (!empty($object_peca->get_fabricante())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_fabricante LIKE '%' :fabricante '%'";
            }
            
            if (!empty($object_peca->get_preco())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_preco = :preco";
            }
            
            if (!empty($object_peca->get_descricao())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_descricao LIKE '%' :descricao '%'";
            }
            
            if (!empty($object_peca->get_data_anuncio())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_data_anuncio = :data_anuncio";
            }
            
            if (!empty($object_peca->get_serie())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_numero_serie = :numero_serie";
            }
            
            if (!empty($object_peca->get_preferencia_entrega())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_prf_ntr_id = :prf_ntr";
            }
            
            if (!empty($object_peca->get_prioridade())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_prioridade = :prioridade";
            }
            
            if (!empty($object_peca->get_num_visualizado())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_num_visualizado = :num_visualizado";
            }
            
            if (!empty($form_filtro)) {
                $pesquisa .= self::Gerar_String_Order_By($form_filtro);
            }
            
            return $pesquisa;
        }
        
        public static function Gerar_String_Order_By(array $form_filtro) : string
        {
            $order_by = "";
            
            if (!empty($form_filtro['ordem_preco'])) {
                if (!empty($order_by)) {
                    $order_by .= ", ";
                }
                
                $order_by .= "peca_preco ";
                
                if ($form_filtro['ordem_preco'] == 'por_menor') {
                    $order_by .= "ASC";
                } else if ($form_filtro['ordem_preco'] = 'por_maior') {
                    $order_by .= "DESC";
                }
            }
            
            if (!empty($form_filtro['ordem_data'])) {
                if (!empty($order_by)) {
                    $order_by .= ", ";
                }
                
                $order_by .= "peca_data_anuncio ";
                
                if ($form_filtro['ordem_data'] == 'menos_recente') {
                    $order_by .= "ASC";
                } else if ($form_filtro['ordem_data'] = 'mais_recente') {
                    $order_by .= "DESC";
                }
            }
            
            if (!empty($order_by)) {
                $order_by = " ORDER BY $order_by";
            }
            
            return $order_by;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, Object_Peca $object_peca, array $form_filtro) : PDOStatement
        {
            if (!empty($object_peca->get_entidade())) {
                $object_entidade = $object_peca->get_entidade();
                
                if (!empty($object_entidade->get_usuario_id())) {
                    $p_sql->bindValue(":ent_id", $object_entidade->get_usuario_id(), PDO::PARAM_INT);
                }
            }
            
            if (!empty($object_peca->get_endereco())) {
                $object_endereco = $object_peca->get_endereco();
                
                $p_sql = DAO_Endereco::Bind_String_Pesquisa($p_sql, $object_endereco);
            }
            
            if (!empty($object_peca->get_status())) {
                $p_sql->bindValue(":sp_id", $object_peca->get_status()->get_id(), PDO::PARAM_INT);
            }
            
            if (!empty($object_peca->get_estado_uso())) {
                $p_sql->bindValue(":std_uso_id", $object_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
            }
            
            if (!empty($object_peca->get_nome())) {
                $p_sql->bindValue(":nome", $object_peca->get_nome(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_url())) {
                $p_sql->bindValue(":url", $object_peca->get_url(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_fabricante())) {
                $p_sql->bindValue(":fabricante", $object_peca->get_fabricante(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_preco())) {
                $p_sql->bindValue(":preco", $object_peca->get_preco(), PDO::PARAM_INT);
            }
            
            if (!empty($object_peca->get_descricao())) {
                $p_sql->bindValue(":descricao", $object_peca->get_descricao(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_data_anuncio())) {
                $p_sql->bindValue(":data", $object_peca->get_data_anuncio(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_serie())) {
                $p_sql->bindValue(":serie", $object_peca->get_serie(), PDO::PARAM_STR);
            }
            
            if (!empty($object_peca->get_preferencia_entrega())) {
                $p_sql->bindValue(":prf_ntr", $object_peca->get_preferencia_entrega(), PDO::PARAM_INT);
            }
            
            if (!empty($object_peca->get_prioridade())) {
                $p_sql->bindValue(":prioridade", $object_peca->get_prioridade(), PDO::PARAM_BOOL);
            }
            
            if (!empty($object_peca->get_num_visualizado())) {
                $p_sql->bindValue(":num_visualizado", $object_peca->get_num_visualizado(), PDO::PARAM_INT);
            }
            
            return $p_sql;
        }
        
        public static function Retornar_Dono_Peca(int $id)
        {
            try {
                $sql = 'SELECT peca_responsavel_usr_id FROM tb_peca WHERE peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Retornar_Id_Por_URL(string $url)
        {
            try {
                $sql = 'SELECT peca_id FROM tb_peca WHERE peca_url = :url';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function PopulaPeca(array $row) : Object_Peca
        {
            $object_peca = new Object_Peca();
            
            if (isset($row['peca_id'])) {
                $object_peca->set_id($row['peca_id']);
                $object_peca->set_fotos(DAO_Foto_Peca::Buscar_Fotos($row['peca_id']));
            }
            
            if (isset($row['peca_ent_id'])) {
                $object_peca->set_entidade(DAO_Entidade::BuscarPorCOD($row['peca_ent_id']));
            }
            
            if (isset($row['peca_responsavel_usr_id'])) {
                $object_peca->set_responsavel(DAO_Usuario::Buscar_Usuario($row['peca_responsavel_usr_id']));
            }
            
            if (isset($row['peca_end_id'])) {
                $object_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Endereco($row['peca_end_id']));
            }
            
            if (isset($row['peca_sts_pec_id'])) {
                $object_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sts_pec_id']));
            }
            
            if (isset($row['peca_nome'])) {
                $object_peca->set_nome($row['peca_nome']);
            }
            
            if (isset($row['peca_url'])) {
                $object_peca->set_url($row['peca_url']);
            }
            
            if (isset($row['peca_fabricante'])) {
                $object_peca->set_fabricante($row['peca_fabricante']);
            }
            
            if (isset($row['peca_preco'])) {
                $object_peca->set_preco($row['peca_preco']);
            }
            
            if (isset($row['peca_descricao'])) {
                $object_peca->set_descricao($row['peca_descricao']);
            }
            
            if (isset($row['peca_data_anuncio'])) {
                $object_peca->set_data_anuncio($row['peca_data_anuncio']);
            }
            
            if (isset($row['peca_numero_serie'])) {
                $object_peca->set_serie($row['peca_numero_serie']);
            }
            
            if (isset($row['peca_prioridade'])) {
                $object_peca->set_prioridade($row['peca_prioridade']);
            }
            
            if (isset($row['peca_prf_ntr_id'])) {
                $object_peca->set_preferencia_entrega($row['peca_prf_ntr_id']);
            }
            
            if (isset($row['peca_std_uso_pec_id'])) {
                $object_peca->set_estado_uso(DAO_Estado_Uso_Peca::BuscarPorCOD($row['peca_std_uso_pec_id']));
            }
            
            if (isset($row['peca_num_visualizado'])) {
                $object_peca->set_num_visualizado($row['peca_num_visualizado']);
            }
            
            return $object_peca;
        }
        
        public static function PopulaPecas(array $rows) : array
        {
            $object_pecas = array();
            
            foreach ($rows as $row) {
                $object_peca = new Object_Peca();
                
                if (isset($row['peca_id'])) {
                    $object_peca->set_id($row['peca_id']);
                    
                    $fotos = DAO_Foto_Peca::Buscar_Fotos($row['peca_id']);
                    
                    if (!empty($fotos) AND $fotos !== false) {
                        $object_peca->set_fotos($fotos);
                    }
                }
                
                if (isset($row['peca_ent_id'])) {
                    $object_peca->set_entidade(DAO_Entidade::BuscarPorCOD($row['peca_ent_id']));
                }
                
                if (isset($row['peca_responsavel_usr_id'])) {
                    $object_peca->set_responsavel(DAO_Usuario::Buscar_Usuario($row['peca_responsavel_usr_id']));
                }
                
                if (isset($row['peca_end_id'])) {
                    $object_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Endereco($row['peca_end_id']));
                }
                
                if (isset($row['peca_sts_pec_id'])) {
                    $object_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sts_pec_id']));
                }
                
                if (isset($row['peca_nome'])) {
                    $object_peca->set_nome($row['peca_nome']);
                }
                
                if (isset($row['peca_url'])) {
                    $object_peca->set_url($row['peca_url']);
                }
                
                if (isset($row['peca_fabricante'])) {
                    $object_peca->set_fabricante($row['peca_fabricante']);
                }
                
                if (isset($row['peca_preco'])) {
                    $object_peca->set_preco($row['peca_preco']);
                }
                
                if (isset($row['peca_descricao'])) {
                    $object_peca->set_descricao($row['peca_descricao']);
                }
                
                if (isset($row['peca_data_anuncio'])) {
                    $object_peca->set_data_anuncio($row['peca_data_anuncio']);
                }
                
                if (isset($row['peca_numero_serie'])) {
                    $object_peca->set_serie($row['peca_numero_serie']);
                }
                
                if (isset($row['peca_prioridade'])) {
                    $object_peca->set_prioridade($row['peca_prioridade']);
                }
                
                if (isset($row['peca_prf_ntr_id'])) {
                    $object_peca->set_preferencia_entrega($row['peca_prf_ntr_id']);
                }
                
                if (isset($row['peca_std_uso_pec_id'])) {
                    $object_peca->set_estado_uso(DAO_Estado_Uso_Peca::BuscarPorCOD($row['peca_std_uso_pec_id']));
                }
                
                if (isset($row['peca_num_visualizado'])) {
                    $object_peca->set_num_visualizado($row['peca_num_visualizado']);
                }
                
                $object_pecas[] = $object_peca;
            }
            
            return $object_pecas;
        }
    }
