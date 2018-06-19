<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
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
    use Module\Application\Model\DAO\Orcamento_Peca as DAO_Orcamento_Peca;
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
        
        public static function Inserir(OBJ_Peca $obj_peca)
        {
            try {
                if (empty($obj_peca->get_id())) {
                    $id_peca = self::Achar_ID_Livre();
                    
                    if (empty($id_peca)) {
                        $obj_peca->set_id(0);
                    } else {
                        $obj_peca->set_id($id_peca);
                    }
                }
                
                $sql = "INSERT INTO tb_peca (peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado, peca_vip) 
                        VALUES (:id, :ent_id, :usr_id, :end_id, :st_id, :nome, :url, :fabricante, :preco, :descricao, :data, :serie, :prf_ntr, :std_uso_id, :num_visualizado, :vip);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_peca->get_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_peca->get_responsavel()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':end_id', $obj_peca->get_endereco()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':st_id', $obj_peca->get_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_peca->get_url(), PDO::PARAM_STR);
                $p_sql->bindValue(':fabricante', $obj_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(':preco', $obj_peca->get_preco(), PDO::PARAM_STR);
                $p_sql->bindValue(':descricao', $obj_peca->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $obj_peca->get_data_anuncio(), PDO::PARAM_STR);
                $p_sql->bindValue(':serie', $obj_peca->get_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':prf_ntr', $obj_peca->get_preferencia_entrega(), PDO::PARAM_INT);
                $p_sql->bindValue(':std_uso_id', $obj_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':num_visualizado', $obj_peca->get_num_visualizado(), PDO::PARAM_INT);
                $p_sql->bindValue(':vip', $obj_peca->get_vip(), PDO::PARAM_BOOL);
                
                if ($p_sql->execute()) {
                    return Conexao::Conectar()->lastInsertId();
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Peca $obj_peca) : bool
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
                        peca_prf_ntr_id = :prf_ntr,
                        peca_std_uso_pec_id = :std_uso_id,
                        peca_num_visualizado = :num_visualizado,
                        peca_vip = :vip 
                        WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_peca->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ent_id', $obj_peca->get_entidade()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':usr_id', $obj_peca->get_responsavel()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':end_id', $obj_peca->get_endereco()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':st_id', $obj_peca->get_status()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':nome', $obj_peca->get_nome(), PDO::PARAM_STR);
                $p_sql->bindValue(':url', $obj_peca->get_url(), PDO::PARAM_STR);
                $p_sql->bindValue(':fabricante', $obj_peca->get_fabricante(), PDO::PARAM_STR);
                $p_sql->bindValue(':preco', $obj_peca->get_preco(), PDO::PARAM_STR);
                $p_sql->bindValue(':descricao', $obj_peca->get_descricao(), PDO::PARAM_STR);
                $p_sql->bindValue(':data', $obj_peca->get_data_anuncio(), PDO::PARAM_STR);
                $p_sql->bindValue(':serie', $obj_peca->get_serie(), PDO::PARAM_STR);
                $p_sql->bindValue(':prf_ntr', $obj_peca->get_preferencia_entrega(), PDO::PARAM_INT);
                $p_sql->bindValue(':std_uso_id', $obj_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':num_visualizado', $obj_peca->get_num_visualizado(), PDO::PARAM_INT);
                $p_sql->bindValue(':vip', $obj_peca->get_vip(), PDO::PARAM_BOOL);
                
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
        
        public static function Incrementar_Mais1_Visualizados(int $id_peca) : bool
        {
            try {
                $sql = "UPDATE tb_peca SET peca_num_visualizado = peca_num_visualizado + 1 WHERE peca_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':id', $id_peca, PDO::PARAM_INT);
                
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
                $sql = 'DELETE FROM tb_peca WHERE peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function DeletarPorEntidade(int $id_entidade) : bool
        {
            try {
                $sql = 'DELETE FROM tb_peca WHERE peca_ent_id = :ent_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':ent_id', $id_entidade, PDO::PARAM_INT);
                
                return $p_sql->execute();
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
        
        public static function BuscarVips()
        {
            try {
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado, peca_vip FROM tb_peca WHERE peca_vip = true ORDER BY peca_num_visualizado LIMIT 4';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->execute();
                
                return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarVipPorPeca(int $peca_id) : ?int
        {
            try {
                $sql = 'SELECT peca_vip FROM tb_peca WHERE peca_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $peca_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarNumVipPorEntidade(int $entidade_id, bool $vip) : ?int
        {
            try {
                $sql = 'SELECT COUNT(peca_id) FROM tb_peca WHERE peca_vip = :vip AND peca_ent_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':vip', $vip, PDO::PARAM_BOOL);
                $p_sql->bindValue(':id', $entidade_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetch(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorStatus(int ...$status_id)
        {
            $query = '';
            
            foreach ($status_id as $id) {
                if (!empty($query)) {
                    $query .= " OR ";
                }
                
                $query .= "peca_sts_pec_id = :sts_id_$id";
            }
            
            try {
                $sql = "SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado, peca_vip FROM tb_peca WHERE ($query)";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                foreach ($status_id as $id) {
                    $p_sql->bindValue(":sts_id_$id", $id, PDO::PARAM_INT);
                }
                
                $p_sql->execute();
                
                return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function BuscarPorCOD(int $id)
        {
            try {
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado, peca_vip FROM tb_peca WHERE peca_id = :id';
                
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
                $sql = 'SELECT peca_id, peca_ent_id, peca_responsavel_usr_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prf_ntr_id, peca_std_uso_pec_id, peca_num_visualizado, peca_vip FROM tb_peca WHERE peca_url = :url';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':url', $url, PDO::PARAM_STR);
                $p_sql->execute();
                
                $row = $p_sql->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($row) && $row != false) {
                    return self::PopulaPeca($row);
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(OBJ_Peca $obj_peca, array $form_filtro)
        {
            $pesquisa = '';
            
            $pesquisa = self::Criar_String_Pesquisa($pesquisa, $obj_peca, $form_filtro);
            
            if (!empty($pesquisa)) {
                if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                    $pesquisa = "WHERE $pesquisa";
                }
            }
            
            try {
                $sql = "SELECT peca_id FROM vw_peca $pesquisa";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $obj_peca, $form_filtro);
                
                $p_sql->execute();
                $select = $p_sql->fetchAll();
                $cont = count($select);
                
                return ceil($cont / 9);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Pecas(OBJ_Peca $obj_peca, array $form_filtro, int $pg)
        {
            $limite = 9;
            $inicio = ($pg * $limite) - $limite;
            $pesquisa = "";
            
            $pesquisa = self::Criar_String_Pesquisa($pesquisa, $obj_peca, $form_filtro);
            
            if (!empty($pesquisa)) {
                if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                    $pesquisa = "WHERE $pesquisa";
                }
            }
            
            try {
                $sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_std_uso_pec_id, peca_num_visualizado, peca_vip 
                FROM vw_peca $pesquisa LIMIT :inicio, :limite";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $obj_peca, $form_filtro);
                $p_sql->bindValue(':inicio', $inicio, PDO::PARAM_INT);
                $p_sql->bindValue(':limite', $limite, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, OBJ_Peca $obj_peca, array $form_filtro) : string
        {
            if (!empty($obj_peca->get_entidade())) {
                $obj_entidade = $obj_peca->get_entidade();
                
                if (!empty($obj_entidade->get_usuario_id())) {
                    if (!empty($pesquisa)) {
                        $pesquisa .= " AND ";
                    }
                    $pesquisa .= "peca_ent_id = :ent_id";
                }
            }
            
            if (!empty($obj_peca->get_endereco())) {
                $obj_endereco = $obj_peca->get_endereco();
                
                $pesquisa = DAO_Endereco::Criar_String_Pesquisa($pesquisa, $obj_endereco);
            }
            
            if (!empty($obj_peca->get_status())) {
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
            
            if (!empty($obj_peca->get_estado_uso())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_std_uso_pec_id = :std_uso_id";
            }
            
            if (!empty($obj_peca->get_nome())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_nome LIKE '%' :nome '%'";
            }
            
            if (!empty($obj_peca->get_url())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_url = :url";
            }
            
            if (!empty($obj_peca->get_fabricante())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_fabricante LIKE '%' :fabricante '%'";
            }
            
            if (!empty($obj_peca->get_preco())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_preco = :preco";
            }
            
            if (!empty($obj_peca->get_descricao())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_descricao LIKE '%' :descricao '%'";
            }
            
            if (!empty($obj_peca->get_data_anuncio())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_data_anuncio = :data_anuncio";
            }
            
            if (!empty($obj_peca->get_serie())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_numero_serie = :numero_serie";
            }
            
            if (!empty($obj_peca->get_preferencia_entrega())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_prf_ntr_id = :prf_ntr";
            }
            
            if (!empty($obj_peca->get_num_visualizado())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_num_visualizado = :num_visualizado";
            }
            
            if (!empty($obj_peca->get_vip())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "peca_vip = :vip";
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
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, OBJ_Peca $obj_peca, array $form_filtro) : PDOStatement
        {
            if (!empty($obj_peca->get_entidade())) {
                $obj_entidade = $obj_peca->get_entidade();
                
                if (!empty($obj_entidade->get_usuario_id())) {
                    $p_sql->bindValue(":ent_id", $obj_entidade->get_usuario_id(), PDO::PARAM_INT);
                }
            }
            
            if (!empty($obj_peca->get_endereco())) {
                $obj_endereco = $obj_peca->get_endereco();
                
                $p_sql = DAO_Endereco::Bind_String_Pesquisa($p_sql, $obj_endereco);
            }
            
            if (!empty($obj_peca->get_status())) {
                $p_sql->bindValue(":sp_id", $obj_peca->get_status()->get_id(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_peca->get_estado_uso())) {
                $p_sql->bindValue(":std_uso_id", $obj_peca->get_estado_uso()->get_id(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_peca->get_nome())) {
                $p_sql->bindValue(":nome", $obj_peca->get_nome(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_url())) {
                $p_sql->bindValue(":url", $obj_peca->get_url(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_fabricante())) {
                $p_sql->bindValue(":fabricante", $obj_peca->get_fabricante(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_preco())) {
                $p_sql->bindValue(":preco", $obj_peca->get_preco(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_peca->get_descricao())) {
                $p_sql->bindValue(":descricao", $obj_peca->get_descricao(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_data_anuncio())) {
                $p_sql->bindValue(":data", $obj_peca->get_data_anuncio(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_serie())) {
                $p_sql->bindValue(":serie", $obj_peca->get_serie(), PDO::PARAM_STR);
            }
            
            if (!empty($obj_peca->get_preferencia_entrega())) {
                $p_sql->bindValue(":prf_ntr", $obj_peca->get_preferencia_entrega(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_peca->get_num_visualizado())) {
                $p_sql->bindValue(":num_visualizado", $obj_peca->get_num_visualizado(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_peca->get_vip())) {
                $p_sql->bindValue(":vip", $obj_peca->get_vip(), PDO::PARAM_BOOL);
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
        
        public static function PopulaPeca(array $row) : OBJ_Peca
        {
            $obj_peca = new OBJ_Peca();
            
            if (isset($row['peca_id'])) {
                $obj_peca->set_id($row['peca_id']);
                $obj_peca->set_fotos(DAO_Foto_Peca::Buscar_Fotos($row['peca_id']));
            }
            
            if (isset($row['peca_ent_id'])) {
                $obj_peca->set_entidade(DAO_Entidade::BuscarPorCOD($row['peca_ent_id']));
            }
            
            if (isset($row['peca_responsavel_usr_id'])) {
                $obj_peca->set_responsavel(DAO_Usuario::Buscar_Usuario($row['peca_responsavel_usr_id']));
            }
            
            if (isset($row['peca_end_id'])) {
                $obj_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Endereco($row['peca_end_id']));
            }
            
            if (isset($row['peca_sts_pec_id'])) {
                $obj_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sts_pec_id']));
            }
            
            if (isset($row['peca_nome'])) {
                $obj_peca->set_nome($row['peca_nome']);
            }
            
            if (isset($row['peca_url'])) {
                $obj_peca->set_url($row['peca_url']);
            }
            
            if (isset($row['peca_fabricante'])) {
                $obj_peca->set_fabricante($row['peca_fabricante']);
            }
            
            if (isset($row['peca_preco'])) {
                $obj_peca->set_preco($row['peca_preco']);
            }
            
            if (isset($row['peca_descricao'])) {
                $obj_peca->set_descricao($row['peca_descricao']);
            }
            
            if (isset($row['peca_data_anuncio'])) {
                $obj_peca->set_data_anuncio($row['peca_data_anuncio']);
            }
            
            if (isset($row['peca_numero_serie'])) {
                $obj_peca->set_serie($row['peca_numero_serie']);
            }
            
            if (isset($row['peca_prf_ntr_id'])) {
                $obj_peca->set_preferencia_entrega($row['peca_prf_ntr_id']);
            }
            
            if (isset($row['peca_std_uso_pec_id'])) {
                $obj_peca->set_estado_uso(DAO_Estado_Uso_Peca::BuscarPorCOD($row['peca_std_uso_pec_id']));
            }
            
            if (isset($row['peca_num_visualizado'])) {
                $obj_peca->set_num_visualizado($row['peca_num_visualizado']);
            }
            
            if (isset($row['peca_vip'])) {
                $obj_peca->set_vip($row['peca_vip']);
            }
            
            return $obj_peca;
        }
        
        public static function PopulaPecas(array $rows) : array
        {
            $obj_pecas = [];
            
            foreach ($rows as $row) {
                $obj_peca = new OBJ_Peca();
                
                if (isset($row['peca_id'])) {
                    $obj_peca->set_id($row['peca_id']);
                    
                    $fotos = DAO_Foto_Peca::Buscar_Fotos($row['peca_id']);
                    
                    if (!empty($fotos) AND $fotos !== false) {
                        $obj_peca->set_fotos($fotos);
                    }
                }
                
                if (isset($row['peca_ent_id'])) {
                    $obj_peca->set_entidade(DAO_Entidade::BuscarPorCOD($row['peca_ent_id']));
                }
                
                if (isset($row['peca_responsavel_usr_id'])) {
                    $obj_peca->set_responsavel(DAO_Usuario::Buscar_Usuario($row['peca_responsavel_usr_id']));
                }
                
                if (isset($row['peca_end_id'])) {
                    $obj_peca->set_endereco(DAO_Endereco::Buscar_Por_Id_Endereco($row['peca_end_id']));
                }
                
                if (isset($row['peca_sts_pec_id'])) {
                    $obj_peca->set_status(DAO_Status_Peca::BuscarPorCOD($row['peca_sts_pec_id']));
                }
                
                if (isset($row['peca_nome'])) {
                    $obj_peca->set_nome($row['peca_nome']);
                }
                
                if (isset($row['peca_url'])) {
                    $obj_peca->set_url($row['peca_url']);
                }
                
                if (isset($row['peca_fabricante'])) {
                    $obj_peca->set_fabricante($row['peca_fabricante']);
                }
                
                if (isset($row['peca_preco'])) {
                    $obj_peca->set_preco($row['peca_preco']);
                }
                
                if (isset($row['peca_descricao'])) {
                    $obj_peca->set_descricao($row['peca_descricao']);
                }
                
                if (isset($row['peca_data_anuncio'])) {
                    $obj_peca->set_data_anuncio($row['peca_data_anuncio']);
                }
                
                if (isset($row['peca_numero_serie'])) {
                    $obj_peca->set_serie($row['peca_numero_serie']);
                }
                
                if (isset($row['peca_prf_ntr_id'])) {
                    $obj_peca->set_preferencia_entrega($row['peca_prf_ntr_id']);
                }
                
                if (isset($row['peca_std_uso_pec_id'])) {
                    $obj_peca->set_estado_uso(DAO_Estado_Uso_Peca::BuscarPorCOD($row['peca_std_uso_pec_id']));
                }
                
                if (isset($row['peca_num_visualizado'])) {
                    $obj_peca->set_num_visualizado($row['peca_num_visualizado']);
                }
                
                if (isset($row['peca_vip'])) {
                    $obj_peca->set_vip($row['peca_vip']);
                }
                
                $obj_pecas[] = $obj_peca;
            }
            
            return $obj_pecas;
        }
    }
