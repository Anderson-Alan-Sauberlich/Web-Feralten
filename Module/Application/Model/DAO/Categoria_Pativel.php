<?php
namespace Module\Application\Model\DAO;
    
    use Module\Application\Model\OBJ\Categoria_Pativel as OBJ_Categoria_Pativel;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Categoria_Pativel_Ano as DAO_Categoria_Pativel_Ano;
    use Module\Application\Model\Common\Util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
    
    class Categoria_Pativel
    {
        function __construct()
        {
            
        }
        
        public static function Inserir(OBJ_Categoria_Pativel $obj_categoria_pativel) : bool
        {
            try {
                $sql = "INSERT INTO tb_categoria_pativel (categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_id) 
                        VALUES (:pec_id, :ctg_id, :ano_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pec_id', $obj_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ctg_id', $obj_categoria_pativel->get_obj_categoria()->get_id(), PDO::PARAM_INT);
                
                $proximo_id_ano = null;
                
                if (empty($obj_categoria_pativel->get_anos())) {
                    $p_sql->bindValue(':ano_id', null, PDO::PARAM_INT);
                } else {
                    if (empty($obj_categoria_pativel->get_ano_id())) {
                        $proximo_id_ano = self::Pegar_Proximo_Id_Ano();
                    } else {
                        $proximo_id_ano = $obj_categoria_pativel->get_ano_id();
                    }
                    
                    $p_sql->bindValue(':ano_id', $proximo_id_ano, PDO::PARAM_INT);
                }
                
                if ($p_sql->execute()) {
                    $anos = $obj_categoria_pativel->get_anos();
                    
                    if (!empty($anos) AND !empty($proximo_id_ano)) {
                        foreach ($anos as $ano) {
                            $sql = "INSERT INTO tb_categoria_pativel_ano (categoria_pativel_ano_id, categoria_pativel_ano_ano)
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
                } else {
                    return false;
                }
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Atualizar(OBJ_Categoria_Pativel $obj_categoria_pativel) : bool
        {
            try {
                if (empty($obj_categoria_pativel->get_ano_id())) {
                    $obj_categoria_pativel->set_ano_id(self::Pegar_Id_Ano($obj_categoria_pativel->get_peca_id(), 
                                                                             $obj_categoria_pativel->get_obj_categoria()->get_id()));
                }
                
                if (self::Deletar_Por_Objeto($obj_categoria_pativel)) {
                    if (self::Inserir($obj_categoria_pativel)) {
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
        
        public static function Deletar_Por_Objeto(OBJ_Categoria_Pativel $obj_categoria_pativel) : bool
        {
            try {
                if (!empty($obj_categoria_pativel->get_ano_id())) {
                    self::Deletar_Anos($obj_categoria_pativel->get_ano_id());
                }
                
                $sql = 'DELETE FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :pec_id AND categoria_pativel_ctg_id = :ctg_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(':pec_id', $obj_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
                $p_sql->bindValue(':ctg_id', $obj_categoria_pativel->get_obj_categoria()->get_id(), PDO::PARAM_INT);
                
                return $p_sql->execute();
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
                
                $sql = 'DELETE FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :pec_id';
                
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
                $sql = 'DELETE FROM tb_categoria_pativel_ano WHERE categoria_pativel_ano_id = :ano_id';
                
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
        
        public static function Pegar_Id_Ano(int $peca_id, int $categoria_id) : ?int
        {
            try {
                $sql = 'SELECT categoria_pativel_ano_id FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :pec_id AND categoria_pativel_ctg_id = :ctg_id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':pec_id', $peca_id, PDO::PARAM_INT);
                $p_sql->bindValue(':ctg_id', $categoria_id, PDO::PARAM_INT);
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
                $sql = 'SELECT categoria_pativel_ano_id FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :pec_id';
                
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
                $sql = 'SELECT categoria_pativel_pec_id, categoria_pativel_ctg_id, categoria_pativel_ano_id FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Categoria_Pativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Peca(int $id_peca)
        {
            try {
                $sql = 'SELECT categoria_pativel_ctg_id FROM tb_categoria_pativel WHERE categoria_pativel_pec_id = :id';
                
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
                $sql = 'SELECT categoria_pativel_ano_ano FROM tb_categoria_pativel_ano WHERE categoria_pativel_ano_id = :id';
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(':id', $id_ano, PDO::PARAM_INT);
                $p_sql->execute();
                
                return $p_sql->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Numero_Paginas(OBJ_Categoria_Pativel $obj_categoria_pativel, OBJ_Peca $obj_peca, array $form_filtro)
        {
            try {
                $pesquisa = '';
                
                $pesquisa = self::Criar_String_Pesquisa($pesquisa, $obj_categoria_pativel);
                
                $pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $obj_peca, $form_filtro);
                
                if (!empty($pesquisa)) {
                    if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                        $pesquisa = "WHERE $pesquisa";
                    }
                }
                
                $sql = "SELECT peca_id FROM vw_categoria_peca $pesquisa";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $obj_peca, $form_filtro);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $obj_categoria_pativel);
                
                $p_sql->execute();
                $select = $p_sql->fetchAll();
                $cont = count($select);
                
                return ceil($cont / 9);
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Buscar_Pecas(OBJ_Categoria_Pativel $obj_categoria_pativel, OBJ_Peca $obj_peca, array $form_filtro, int $pg)
        {
            $limite = 9;
            $inicio = ($pg * $limite) - $limite;
            $pesquisa = "";
            
            $pesquisa = self::Criar_String_Pesquisa($pesquisa, $obj_categoria_pativel);
            
            $pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $obj_peca, $form_filtro);
            
            if (!empty($pesquisa)) {
                if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
                    $pesquisa = "WHERE $pesquisa";
                }
            }
            
            try {
                $sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_url, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie
                        FROM vw_categoria_peca $pesquisa LIMIT :inicio, :limite";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $obj_peca, $form_filtro);
                
                $p_sql = self::Bind_String_Pesquisa($p_sql, $obj_categoria_pativel);
                
                $p_sql->bindValue(':inicio', $inicio, PDO::PARAM_INT);
                $p_sql->bindValue(':limite', $limite, PDO::PARAM_INT);
                $p_sql->execute();
                
                return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, OBJ_Categoria_Pativel $obj_categoria_pativel) : string
        {
            if (!empty($obj_categoria_pativel->get_peca_id())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "categoria_pativel_pec_id = :pec_id";
            }
            
            if (!empty($obj_categoria_pativel->get_obj_categoria()->get_id())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND ";
                }
                $pesquisa .= "categoria_pativel_ctg_id = :ctg_id";
            }
            
            if (!empty($obj_categoria_pativel->get_ano_de()) OR !empty($obj_categoria_pativel->get_ano_ate())) {
                if (!empty($pesquisa)) {
                    $pesquisa .= " AND (";
                }
                
                $pesquisa_ano = "";
                
                if (!empty($obj_categoria_pativel->get_ano_de())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "categoria_pativel_ano_ano >= :ano_de";
                }
                
                if (!empty($obj_categoria_pativel->get_ano_ate())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "categoria_pativel_ano_ano <= :ano_ate";
                }
                
                $pesquisa .= "categoria_pativel_ano_id IN (SELECT categoria_pativel_ano_id FROM tb_categoria_pativel_ano WHERE $pesquisa_ano)";
                
                if (!empty($pesquisa)) {
                    $pesquisa .= " OR ";
                }
                
                $pesquisa_ano = "";
                
                if (!empty($obj_categoria_pativel->get_ano_de())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "marca_pativel_ano_ano >= :ano_de";
                }
                
                if (!empty($obj_categoria_pativel->get_ano_ate())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "marca_pativel_ano_ano <= :ano_ate";
                }
                
                $pesquisa .= "marca_pativel_ano_id IN (SELECT marca_pativel_ano_id FROM tb_marca_pativel_ano WHERE $pesquisa_ano)";
                
                if (!empty($pesquisa)) {
                    $pesquisa .= " OR ";
                }
                
                $pesquisa_ano = "";
                
                if (!empty($obj_categoria_pativel->get_ano_de())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "modelo_pativel_ano_ano >= :ano_de";
                }
                
                if (!empty($obj_categoria_pativel->get_ano_ate())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "modelo_pativel_ano_ano <= :ano_ate";
                }
                
                $pesquisa .= "modelo_pativel_ano_id IN (SELECT modelo_pativel_ano_id FROM tb_modelo_pativel_ano WHERE $pesquisa_ano)";
                
                if (!empty($pesquisa)) {
                    $pesquisa .= " OR ";
                }
                
                $pesquisa_ano = "";
                
                if (!empty($obj_categoria_pativel->get_ano_de())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "versao_pativel_ano_ano >= :ano_de";
                }
                
                if (!empty($obj_categoria_pativel->get_ano_ate())) {
                    if (!empty($pesquisa_ano)) {
                        $pesquisa_ano .= " AND ";
                    }
                    $pesquisa_ano .= "versao_pativel_ano_ano <= :ano_ate";
                }
                
                $pesquisa .= "versao_pativel_ano_id IN (SELECT versao_pativel_ano_id FROM tb_versao_pativel_ano WHERE $pesquisa_ano))";
            }
            
            return $pesquisa;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, OBJ_Categoria_Pativel $obj_categoria_pativel) : PDOStatement
        {
            if (!empty($obj_categoria_pativel->get_peca_id())) {
                $p_sql->bindValue(':pec_id', $obj_categoria_pativel->get_peca_id(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_categoria_pativel->get_obj_categoria()->get_id())) {
                $p_sql->bindValue(':ctg_id', $obj_categoria_pativel->get_obj_categoria()->get_id(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_categoria_pativel->get_ano_de())) {
                $p_sql->bindValue(':ano_de', $obj_categoria_pativel->get_ano_de(), PDO::PARAM_INT);
            }
            
            if (!empty($obj_categoria_pativel->get_ano_ate())) {
                $p_sql->bindValue(':ano_ate', $obj_categoria_pativel->get_ano_ate(), PDO::PARAM_INT);
            }
            
            return $p_sql;
        }
        
        public static function Popula_Categoria_Pativeis(array $rows) : array
        {
            $pativeis = array();
            
            foreach ($rows as $row) {
                $obj_categoria_pativel = new OBJ_Categoria_Pativel();
                
                if (isset($row['categoria_pativel_pec_id'])) {
                    $obj_categoria_pativel->set_peca_id($row['categoria_pativel_pec_id']);
                }
                
                if (isset($row['categoria_pativel_ctg_id'])) {
                    $obj_categoria_pativel->set_obj_categoria(DAO_Categoria::BuscarPorCOD($row['categoria_pativel_ctg_id']));
                }
                
                if (isset($row['categoria_pativel_ano_id'])) {
                    $obj_categoria_pativel->set_ano_id($row['categoria_pativel_ano_id']);
                    
                    $obj_categoria_pativel->set_anos(DAO_Categoria_Pativel_Ano::Buscar_Ano_Por_Id_Ano($row['categoria_pativel_ano_id']));
                }
                
                $pativeis[] = $obj_categoria_pativel;
            }
            
            return $pativeis;
        }
    }
