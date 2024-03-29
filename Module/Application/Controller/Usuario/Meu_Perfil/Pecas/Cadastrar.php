<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Pecas;
    
    use Module\Email\Controller\Common\Util\Email;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Gerenciar_Imagens;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Controller\Common\Util\Peca as Util_Peca;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\OBJ\Status_Peca as OBJ_Status_Peca;
    use Module\Application\Model\OBJ\Estado_Uso_Peca as OBJ_Estado_Uso_Peca;
    use Module\Application\Model\OBJ\Categoria_Pativel as OBJ_Categoria_Pativel;
    use Module\Application\Model\OBJ\Marca_Pativel as OBJ_Marca_Pativel;
    use Module\Application\Model\OBJ\Modelo_Pativel as OBJ_Modelo_Pativel;
    use Module\Application\Model\OBJ\Versao_Pativel as OBJ_Versao_Pativel;
    use Module\Application\Model\OBJ\Foto_Peca as OBJ_Foto_Peca;
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\OBJ\Categoria as OBJ_Categoria;
    use Module\Application\Model\OBJ\Marca as OBJ_Marca;
    use Module\Application\Model\OBJ\Modelo as OBJ_Modelo;
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\OBJ\Orcamento as OBJ_Orcamento;
    use Module\Application\Model\OBJ\Orcamento_Peca as OBJ_Orcamento_Peca;
    use Module\Application\Model\DAO\Preferencia_Entrega as DAO_Preferencia_Entrega;
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    use Module\Application\Model\DAO\Categoria_Compativel as DAO_Categoria_Compativel;
    use Module\Application\Model\DAO\Marca_Compativel as DAO_Marca_Compativel;
    use Module\Application\Model\DAO\Modelo_Compativel as DAO_Modelo_Compativel;
    use Module\Application\Model\DAO\Versao_Compativel as DAO_Versao_Compativel;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Estado_Uso_Peca as DAO_Estado_Uso_Peca;
    use Module\Application\Model\DAO\Categoria_Pativel as DAO_Categoria_Pativel;
    use Module\Application\Model\DAO\Marca_Pativel as DAO_Marca_Pativel;
    use Module\Application\Model\DAO\Modelo_Pativel as DAO_Modelo_Pativel;
    use Module\Application\Model\DAO\Versao_Pativel as DAO_Versao_Pativel;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Foto_Peca as DAO_Foto_Peca;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\DAO\Orcamento_Peca as DAO_Orcamento_Peca;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Pecas\Cadastrar as View_Cadastrar;
    use Module\Application\Model\DAO\Adicionado as DAO_Adicionado;
    use Module\Application\Model\OBJ\Adicionado as OBJ_Adicionado;
    use \Exception;
    
    class Cadastrar
    {
        function __construct()
        {
            
        }
        
        private $orcamento;
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $descricao;
        private $estado_uso;
        private $preferencia_entrega;
        private $fabricante;
        private $peca;
        private $serie;
        private $preco;
        private $vip;
        private $imagens = [];
        private $erros = [];
        private $sucesso = [];
        private $campos = [];
        private $form = [];
        
        public function set_orcamento_id($orcamento_id) : void
        {
            try {
                $this->orcamento = DAO_Orcamento::BuscarPorCOD(Validador::Orcamento()::validar_id($orcamento_id));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_categoria($categoria) : void
        {
            try {
                //$this->categoria = Validador::Categoria()::validar_id($categoria);
                $this->categoria = $categoria;
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->categoria = Validador::Categoria()::filtrar_id($categoria);
            }
        }
        
        public function set_marca($marca) : void
        {
            try {
                //$this->marca = Validador::Marca()::validar_id($marca);
                $this->marca = $marca;
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->marca = Validador::Marca()::filtrar_id($marca);
            }
        }
        
        public function set_modelo($modelo) : void
        {
            try {
                //$this->modelo = Validador::Modelo()::validar_id($modelo);
                $this->modelo = $modelo;
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->modelo = Validador::Modelo()::filtrar_id($modelo);
            }
        }
        
        public function set_versao($versao) : void
        {
            try {
                //$this->versao = Validador::Versao()::validar_id($versao);
                $this->versao = $versao;
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->versao = Validador::Versao()::filtrar_id($versao);
            }
        }
        
        public function set_descricao($descricao) : void
        {
            try {
                $this->descricao = Validador::Peca()::validar_descricao($descricao);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_descricao'] = 'erro';
                
                $this->descricao = Validador::Peca()::filtrar_descricao($descricao);
            }
        }
        
        public function set_estado_uso($estado_uso) : void
        {
            try {
                $this->estado_uso = Validador::Peca()::validar_estado_uso($estado_uso);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_estado_uso'] = 'erro';
                
                $this->estado_uso = Validador::Peca()::filtrar_estado_uso($estado_uso);
            }
        }
        
        public function set_preferencia_entrega($preferencia_entrega) : void
        {
            try {
                $this->preferencia_entrega = Validador::Peca()::validar_preferencia_entrega($preferencia_entrega);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->preferencia_entrega = Validador::Peca()::filtrar_preferencia_entrega($preferencia_entrega);
            }
        }
        
        public function set_fabricante($fabricante) : void
        {
            try {
                $this->fabricante = Validador::Peca()::validar_fabricante($fabricante);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_fabricante'] = 'erro';
                
                $this->fabricante = Validador::Peca()::filtrar_fabricante($fabricante);
            }
        }
        
        public function set_peca($peca) : void
        {
            try {
                $this->peca = Validador::Peca()::validar_nome($peca);
                $this->campos['erro_peca'] = 'certo';
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_peca'] = 'erro';
                
                $this->peca = Validador::Peca()::filtrar_nome($peca);
            }
        }
        
        public function set_serie($serie) : void
        {
            try {
                $this->serie = Validador::Peca()::validar_serie($serie);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_serie'] = 'erro';
                
                $this->serie = Validador::Peca()::filtrar_serie($serie);
            }
        }
        
        public function set_preco($preco) : void
        {
            try {
                $this->preco = Validador::Peca()::validar_preco($preco);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_preco'] = 'erro';
                
                $this->preco = Validador::Peca()::filtrar_preco($preco);
            }
        }
        
        public function set_vip($vip) : void
        {
            try {
                $this->vip = Validador::Peca()::validar_vip($vip);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_vip'] = 'erro';
                
                $this->vip = Validador::Peca()::filtrar_vip($vip);
            }
        }
        
        public function set_imagem($imagem, $numero) : void
        {
            try {
                $this->imagens[$numero] = Validador::Foto_Peca()::validar_imagem($imagem, $numero);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (empty($this->form)) {
                        unset($_SESSION['compatibilidade']);
                        $this->Deletar_Imagem(123);
                        $this->SetarDadosDoOrcamento();
                    }
                    
                    $view = new View_Cadastrar($status);
                    
                    $view->set_orcamento($this->orcamento);
                    $view->set_campos($this->campos);
                    $view->set_erros($this->erros);
                    $view->set_form($this->form);
                    $view->set_sucesso($this->sucesso);
                     
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        private function SetarDadosDoOrcamento() : void
        {
            if ($this->orcamento instanceof OBJ_Orcamento) {
                if (!empty($this->orcamento->get_categoria_id())) {
                    $_SESSION['compatibilidade']['categoria'][$this->orcamento->get_categoria_id()] = $this->orcamento->get_categoria_id();
                    
                    if (!empty($this->orcamento->get_marca_id())) {
                        $_SESSION['compatibilidade']['marca'][$this->orcamento->get_marca_id()] = $this->orcamento->get_marca_id();
                        
                        if (!empty($this->orcamento->get_modelo_id())) {
                            $_SESSION['compatibilidade']['modelo'][$this->orcamento->get_modelo_id()] = $this->orcamento->get_modelo_id();
                            
                            if (!empty($this->orcamento->get_versao_id())) {
                                $_SESSION['compatibilidade']['versao'][$this->orcamento->get_versao_id()] = $this->orcamento->get_versao_id();
                            }
                        }
                    }
                }
                
                $this->form['peca'] = $this->orcamento->get_peca_nome();;
                $this->form['serie'] = $this->orcamento->get_numero_serie();
                $this->form['estado_uso'] = $this->orcamento->get_estado_uso_id();
                $this->form['preferencia_entrega'] = OBJ_Peca::get_preferencias_entrega($this->orcamento->get_preferencia_entrega_id());
            }
        }
        
        /**
         * Function chamada por ajax para carregar os checkbox das compatibilidades
         */
        public function Carregar_Compatibilidade() : void
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->categoria)) {
                    if ($this->categoria == "verificar") {
                        View_Cadastrar::Carregar_Marcas();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Cadastrar::Carregar_Categorias();
                    }
                }
                    
                if (!empty($this->marca)) {
                    if ($this->marca == "verificar") {
                        View_Cadastrar::Carregar_Modelos();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Cadastrar::Carregar_Marcas();
                    }
                }
                    
                if (!empty($this->modelo)) {
                    if ($this->modelo == "verificar") {
                        View_Cadastrar::Carregar_Versoes();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Cadastrar::Carregar_Modelos();
                    }
                }
                    
                if (!empty($this->versao)) {
                    if ($this->versao == "verificar") {
                        View_Cadastrar::Carregar_Anos();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Cadastrar::Carregar_Versoes();
                    }
                }
            }
        }
        
        /**
         * Function chamada em Carregar_Compatibilidade() para ordenar de forma correta os dados CMMS 
         * conforme os selecionados pelo usuario.
         */
        private function Salvar_Session_Compatibilidade() : void
        {
            $compatibilidade = [];
            
            $compatibilidade['categoria'] = [];
            $compatibilidade['marca'] = [];
            $compatibilidade['modelo'] = [];
            $compatibilidade['versao'] = [];
            $compatibilidade['ano'] = [];
            
            if (isset($_SESSION['compatibilidade'])) {
                $compatibilidade = $_SESSION['compatibilidade'];
            }
            
            if (!empty($this->categoria)) {
                if (isset($compatibilidade['categoria'])) {
                    if (isset($compatibilidade['categoria'][$this->categoria])) {
                        unset($compatibilidade['categoria'][$this->categoria]);
                        
                        if (isset($compatibilidade['marca'])) {
                            $id_marcas = self::Buscar_Id_Marcas_Por_Id_Categoria($this->categoria);
                            
                            foreach ($id_marcas as $id_marca) {
                                if (isset($compatibilidade['marca'][$id_marca])) {
                                    unset($compatibilidade['marca'][$id_marca]);
                                    
                                    if (isset($compatibilidade['modelo'])) {
                                        $id_modelos = self::Buscar_Id_Modelos_Por_Id_Marca($id_marca);
                                        
                                        foreach ($id_modelos as $id_modelo) {
                                            if (isset($compatibilidade['modelo'][$id_modelo])) {
                                                unset($compatibilidade['modelo'][$id_modelo]);
                                                
                                                if (isset($compatibilidade['versao'])) {
                                                    $id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($id_modelo);
                                                    
                                                    foreach ($id_versoes as $id_versao) {
                                                        if (isset($compatibilidade['versao'][$id_versao])) {
                                                            unset($compatibilidade['versao'][$id_versao]);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $compatibilidade['categoria'][$this->categoria] = $this->categoria;
                    }
                } else {
                    $compatibilidade['categoria'][$this->categoria] = $this->categoria;
                }
            }
            
            if (!empty($this->marca)) {
                if (isset($compatibilidade['marca'])) {
                    if (isset($compatibilidade['marca'][$this->marca])) {
                        unset($compatibilidade['marca'][$this->marca]);
                        
                        if (isset($compatibilidade['modelo'])) {
                            $id_modelos = self::Buscar_Id_Modelos_Por_Id_Marca($this->marca);
                            
                            foreach ($id_modelos as $id_modelo) {
                                if (isset($compatibilidade['modelo'][$id_modelo])) {
                                    unset($compatibilidade['modelo'][$id_modelo]);
                                    
                                    if (isset($compatibilidade['versao'])) {
                                        $id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($id_modelo);
                                        
                                        foreach ($id_versoes as $id_versao) {
                                            if (isset($compatibilidade['versao'][$id_versao])) {
                                                unset($compatibilidade['versao'][$id_versao]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $compatibilidade['marca'][$this->marca] = $this->marca;
                    }
                } else {
                    $compatibilidade['marca'][$this->marca] = $this->marca;
                }
            }
            
            if (!empty($this->modelo)) {
                if (isset($compatibilidade['modelo'])) {
                    if (isset($compatibilidade['modelo'][$this->modelo])) {
                        unset($compatibilidade['modelo'][$this->modelo]);
                        
                        if (isset($compatibilidade['versao'])) {
                            $id_versoes = self::Buscar_Id_Versoes_Por_Id_Modelo($this->modelo);
                            
                            foreach ($id_versoes as $id_versao) {
                                if (isset($compatibilidade['versao'][$id_versao])) {
                                    unset($compatibilidade['versao'][$id_versao]);
                                }
                            }
                        }
                    } else {
                        $compatibilidade['modelo'][$this->modelo] = $this->modelo;
                    }
                } else {
                    $compatibilidade['modelo'][$this->modelo] = $this->modelo;
                }
            }
            
            if (!empty($this->versao)) {
                if (isset($compatibilidade['versao'])) {
                    if (isset($compatibilidade['versao'][$this->versao])) {
                        unset($compatibilidade['versao'][$this->versao]);
                    } else {
                        $compatibilidade['versao'][$this->versao] = $this->versao;
                    }
                } else {
                    $compatibilidade['versao'][$this->versao] = $this->versao;
                }
            }
            
            $_SESSION['compatibilidade'] = $compatibilidade;
        }
        
        public function Cadastrar_Peca()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $count_limite = DAO_Plano::BuscarLimitePecasPorId(Login_session::get_entidade_plano());
                    $count_pecas = DAO_Peca::Buscar_Quantidade_Pecas_Por_Entidade(Login_session::get_entidade_id());
                    
                    if ($count_pecas >= $count_limite) {
                        $this->erros[] = "Erro: Você atingiu o limite de peças para o seu plano";
                    }
                    
                    if (empty($this->erros)) {
                        $categorias_compativeis = [];
                        $marcas_compativeis = [];
                        $modelos_compativeis = [];
                        $versoes_compativeis = [];
                        
                        $categorias_pativeis = [];
                        $marcas_pativeis = [];
                        $modelos_pativeis = [];
                        $versoes_pativeis = [];
                        
                        if (!empty($this->categoria)) {
                            $categorias_compativeis = self::Buscar_Categorias_Compativeis(current($this->categoria));
                            
                            if (!empty($this->marca)) {
                                $marcas_compativeis = self::Buscar_Marcas_Compativeis(current($this->marca));
                                
                                if (!empty($this->modelo)) {
                                    $modelos_compativeis = self::Buscar_Modelos_Compativeis(current($this->modelo));
                                    
                                    if (!empty($this->versao)) {
                                        $versoes_compativeis = self::Buscar_Versoes_Compativeis(current($this->versao));
                                    }
                                }
                            }
                        }
                        
                        if (!empty($this->categoria)) {
                            foreach ($this->categoria as $categoria_selecionada) {
                                if (in_array($categoria_selecionada, $categorias_compativeis)) {
                                    $categoria_pativel = new OBJ_Categoria_Pativel();
                                    $obj_categoria = new obj_Categoria();
                                    $obj_categoria->set_id($categoria_selecionada);
                                    $categoria_pativel->set_obj_categoria($obj_categoria);
                                    
                                    $categorias_pativeis[] = $categoria_pativel;
                                    
                                    if (!empty($this->marca)) {
                                        foreach ($this->marca as $marca_selecionada) {
                                            if (in_array($marca_selecionada, $marcas_compativeis)) {
                                                if (self::Buscar_Categoria_Id_Por_Marca($marca_selecionada) == $categoria_selecionada) {
                                                    $marca_pativel = new OBJ_Marca_Pativel();
                                                    $obj_marca = new OBJ_Marca();
                                                    $obj_marca->set_id($marca_selecionada);
                                                    $marca_pativel->set_obj_marca($obj_marca);
                                                    
                                                    if (isset($_POST['ano_mrc_'.$marca_selecionada]) AND !empty($_POST['ano_mrc_'.$marca_selecionada])) {
                                                        $marca_pativel->set_anos($_POST['ano_mrc_'.$marca_selecionada]);
                                                    }
                                                    
                                                    $marcas_pativeis[] = $marca_pativel;
                                                    
                                                    if (!empty($this->modelo)) {
                                                        foreach ($this->modelo as $modelo_selecionado) {
                                                            if (in_array($modelo_selecionado, $modelos_compativeis)) {
                                                                if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
                                                                    $modelo_pativel = new OBJ_Modelo_Pativel();
                                                                    $obj_modelo = new OBJ_Modelo();
                                                                    $obj_modelo->set_id($modelo_selecionado);
                                                                    $modelo_pativel->set_obj_modelo($obj_modelo);
                                                                    
                                                                    if (isset($_POST['ano_mdl_'.$modelo_selecionado]) AND !empty($_POST['ano_mdl_'.$modelo_selecionado])) {
                                                                        $modelo_pativel->set_anos($_POST['ano_mdl_'.$modelo_selecionado]);
                                                                    }
                                                                    
                                                                    $modelos_pativeis[] = $modelo_pativel;
                                                                    
                                                                    if (!empty($this->versao)) {
                                                                        foreach ($this->versao as $versao_selecionada) {
                                                                            if (in_array($versao_selecionada, $versoes_compativeis)) {
                                                                                if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
                                                                                    $versao_pativel = new OBJ_Versao_Pativel();
                                                                                    $obj_versao = new OBJ_versao();
                                                                                    $obj_versao->set_id($versao_selecionada);
                                                                                    $versao_pativel->set_obj_versao($obj_versao);
                                                                                    
                                                                                    if (isset($_POST['ano_vrs_'.$versao_selecionada]) AND !empty($_POST['ano_vrs_'.$versao_selecionada])) {
                                                                                        $versao_pativel->set_anos($_POST['ano_vrs_'.$versao_selecionada]);
                                                                                    }
                                                                                    
                                                                                    $versoes_pativeis[] = $versao_pativel;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                        $obj_peca = new OBJ_Peca();
                        $obj_estado_uso = new OBJ_Estado_Uso_Peca();
                        $obj_status = new OBJ_Status_Peca();
                        $entidade = new OBJ_Entidade();
                        $peca_url = Util_Peca::Gerar_URL_Peca($this->peca);
                        $id_peca_tmp = DAO_Peca::Achar_ID_Livre();
                        
                        if ($this->estado_uso > 0) {
                            $obj_estado_uso->set_id($this->estado_uso);
                        }
                        
                        $obj_status->set_id(1);
                        
                        $obj_peca->set_num_visualizado(0);
                        $obj_peca->set_estado_uso($obj_estado_uso);
                        $obj_peca->set_status($obj_status);
                        $obj_peca->set_descricao($this->descricao);
                        $obj_peca->set_preferencia_entrega($this->preferencia_entrega);
                        $obj_peca->set_fabricante($this->fabricante);
                        $obj_peca->set_nome($this->peca);
                        $obj_peca->set_serie($this->serie);
                        $obj_peca->set_preco($this->preco);
                        $obj_peca->set_vip($this->vip);
                        
                        $entidade->set_id(Login_Session::get_entidade_id());
                        $entidade->set_usuario_id(Login_Session::get_usuario_id());
                        
                        $obj_peca->set_entidade($entidade);
                        $obj_peca->set_data_anuncio(date('Y-m-d H:i:s'));
                        
                        $id_endereco = DAO_Endereco::Buscar_Id_Por_Id_Entidade(Login_Session::get_entidade_id());
                        
                        if ($id_endereco === false) {
                            $this->erros[] = "Erro ao tentar adicionar o Endereço do Usuario para a Peça";
                            $this->campos['erro_peca'] = "";
                        } else {
                            $endereco = new OBJ_Endereco();
                            
                            $endereco->set_id($id_endereco);
                            
                            $obj_peca->set_endereco($endereco);
                            
                            if (empty($id_peca_tmp)) {
                                $obj_peca->set_id(0);
                                $obj_peca->set_url($peca_url.'_'.Login_Session::get_usuario_id().rand(100, 999));
                            } else {
                                $obj_peca->set_url($peca_url.'_'.$id_peca_tmp);
                                $obj_peca->set_id($id_peca_tmp);
                            }
                            
                            $usuario_responsavel = new OBJ_Usuario();
                            
                            $usuario_responsavel->set_id(Login_Session::get_usuario_id());
                            
                            $obj_peca->set_responsavel($usuario_responsavel);
                        }
                        
                        $id_peca = DAO_Peca::Inserir($obj_peca);
                        
                        if (!empty($id_peca) AND $id_peca !== false) {
                            if (empty($id_peca_tmp)) {
                                DAO_Peca::Atualizar_URL($id_peca, $peca_url.'_'.$id_peca);
                                $obj_peca->set_url($peca_url.'_'.$id_peca);
                            }
                            
                            if ($this->orcamento instanceof OBJ_Orcamento) {
                                $obj_orcamento_peca = new OBJ_Orcamento_Peca();
                                
                                $obj_orcamento_peca->set_orcamento($this->orcamento);
                                $obj_orcamento_peca->set_peca($obj_peca);
                                
                                if (DAO_Orcamento_Peca::Inserir($obj_orcamento_peca)) {
                                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                                    
                                    $obj_entidade_bd->SetarStatusOrcamento($this->orcamento->get_id(), Entidade_BD::RESPONDIDO);
                                    
                                    Email::Enviar_Orcamento_Peca($obj_orcamento_peca);
                                }
                            }
                            
                            $retorno = null;
                            
                            foreach ($categorias_pativeis as $pativel) {
                                $pativel->set_peca_id($id_peca);
                                
                                if (DAO_Categoria_Pativel::Inserir($pativel) === false) {
                                    $retorno = false;
                                }
                            }
                            
                            foreach ($marcas_pativeis as $pativel) {
                                $pativel->set_peca_id($id_peca);
                                
                                if (DAO_Marca_Pativel::Inserir($pativel) === false) {
                                    $retorno = false;
                                }
                            }
                            
                            foreach ($modelos_pativeis as $pativel) {
                                $pativel->set_peca_id($id_peca);
                                
                                if (DAO_Modelo_Pativel::Inserir($pativel) === false) {
                                    $retorno = false;
                                }
                            }
                            
                            foreach ($versoes_pativeis as $pativel) {
                                $pativel->set_peca_id($id_peca);
                                
                                if (DAO_Versao_Pativel::Inserir($pativel) === false) {
                                    $retorno = false;
                                }
                            }
                            
                            if ($retorno === false) {
                                $this->erros[] = "Erro ao tentar adicionar a Lista Compativel para a Peça";
                                $this->campos['erro_peca'] = "";
                            }
                            
                            if (isset($_SESSION['imagens_tmp']) AND !empty($_SESSION['imagens_tmp'])) {
                                $imagens = new Gerenciar_Imagens();
                                
                                $diretorios_imagens = $imagens->Arquivar_Imagem_Peca($_SESSION['imagens_tmp'], $id_peca, $peca_url);
                                
                                if (!empty($diretorios_imagens)) {
                                    foreach ($diretorios_imagens as $key => $diretorio) {
                                        $foto_peca = new OBJ_Foto_Peca();
                                        
                                        $foto_peca->set_peca_id($id_peca);
                                        $foto_peca->set_endereco($diretorio);
                                        $foto_peca->set_numero($key);
                                        $foto_peca->set_nome(str_replace('img_tmp_', 'img_'.$peca_url.'_', $_SESSION['imagens_tmp'][$key]));
                                        
                                        if (DAO_Foto_Peca::Inserir($foto_peca) === false) {
                                            $this->erros[] = "Erro ao tentar adicionar Foto $key para a Peça";
                                            $this->campos['erro_peca'] = "";
                                        }
                                    }
                                    
                                    unset($_SESSION['imagens_tmp']);
                                } else {
                                    $this->atualizar_erros[] = "Erro ao tentar Cadastrar Fotos da Peça";
                                    $this->atualizar_campos['erro_peca'] = "";
                                }
                            }
                        } else {
                            $this->erros[] = "Erro ao tentar Cadastrar Peça";
                            $this->campos['erro_peca'] = "";
                        }
                    }
                    
                    if (empty($this->erros)) {
                        $entidade = new OBJ_Entidade();
                        $entidade->set_id(Login_Session::get_entidade_id());
                        
                        $usuario_responsavel = new OBJ_Usuario();
                        $usuario_responsavel->set_id(Login_Session::get_usuario_id());
                        
                        $obj_adicionado = new OBJ_Adicionado();
                        $obj_adicionado->set_obj_entidade($entidade);
                        $obj_adicionado->set_obj_usuario($usuario_responsavel);
                        $obj_adicionado->set_datahora(date('Y-m-d H:i:s'));
                        
                        DAO_Adicionado::Inserir($obj_adicionado);
                        
                        $this->sucesso[] = 'Peça Cadastrada Com Sucesso - <a href="/usuario/meu-perfil/pecas/visualizar/">Visualizar Peças</a>';
                        $this->campos['erro_peca'] = '';
                    } else {
                        $this->form['peca'] = $this->peca;
                        $this->form['fabricante'] = $this->fabricante;
                        $this->form['serie'] = $this->serie;
                        $this->form['preco'] = $this->preco;
                        $this->form['estado_uso'] = $this->estado_uso;
                        $this->form['descricao'] = $this->descricao;
                        $this->form['vip'] = $this->vip;
                        $this->form['preferencia_entrega'] = OBJ_Peca::get_preferencias_entrega($this->preferencia_entrega);
                        
                        $marcas = null;
                        $modelos = null;
                        $versoes = null;
                        $anos = [];
                        
                        if (!empty($_SESSION['compatibilidade']['marca'])) {
                            $marcas = $_SESSION['compatibilidade']['marca'];
                        }
                        if (!empty($_SESSION['compatibilidade']['modelo'])) {
                            $modelos = $_SESSION['compatibilidade']['modelo'];
                        }
                        if (!empty($_SESSION['compatibilidade']['versao'])) {
                            $versoes = $_SESSION['compatibilidade']['versao'];
                        }
                        
                        if (!empty($marcas)) {
                            foreach ($marcas as $marca) {
                                if (!empty($_POST['ano_mrc_'.$marca])) {
                                    $anos['ano_mrc_'.$marca] = $_POST['ano_mrc_'.$marca];
                                }
                            }
                        }
                        
                        if (!empty($modelos)) {
                            foreach ($modelos as $modelo) {
                                if (!empty($_POST['ano_mdl_'.$modelo])) {
                                    $anos['ano_mdl_'.$modelo] = $_POST['ano_mdl_'.$modelo];
                                }
                            }
                        }
                        
                        if (!empty($versoes)) {
                            foreach ($versoes as $versao) {
                                if (!empty($_POST['ano_vrs_'.$versao])) {
                                    $anos['ano_vrs_'.$versao] = $_POST['ano_vrs_'.$versao];
                                }
                            }
                        }
                        
                        $_SESSION['compatibilidade']['ano'] = $anos;
                    }
                    
                    $this->Carregar_Pagina();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Function chamado por ajax para salvar as imagens carregadas pelo usuario antes de finalizar o cadastro.
         */
        public function Salvar_Imagem_TMP() : void
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->imagens)) {
                    $imagens = new Gerenciar_Imagens();
                    
                    foreach ($this->imagens as $key => $imagem) {
                        $imagens->Armazenar_Imagem_Temporaria($imagem);
                        
                        if (!isset($_SESSION['imagens_tmp'][$key])) {
                            $_SESSION['imagens_tmp'][$key] = $imagens->get_nome();
                        }
                        
                        echo Gerenciar_Imagens::Gerar_Data_URL($imagens->get_caminho()."-320x240.".$imagens->get_extensao());
                    }
                }  else {
                    echo "/resources/img/imagem_indisponivel.png";
                }
            }
        }
        
        /**
         * Functino para Deletar as ou a imagem temporaria que o usuario carregou antes do cadastro.
         * 
         * @param int $num_img
         */
        public function Deletar_Imagem(int $num_img) : void
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (isset($_SESSION['imagens_tmp'])) {
                    if (isset($_SESSION['imagens_tmp'][$num_img]) OR $num_img == 123) {
                        $imagens = new Gerenciar_Imagens();
                        
                        if ($num_img === 123) {
                            if (isset($_SESSION['imagens_tmp'][1])) {
                                $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][1]);
                            }
                            if (isset($_SESSION['imagens_tmp'][2])) {
                                $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][2]);
                            }
                            if (isset($_SESSION['imagens_tmp'][3])) {
                                $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][3]);
                            }
                            
                            unset($_SESSION['imagens_tmp']);
                        } else if ($num_img === 1) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][1]);
                            
                            if (isset($_SESSION['imagens_tmp'][2])) {
                                $_SESSION['imagens_tmp'][1] = $_SESSION['imagens_tmp'][2];
                                
                                if (isset($_SESSION['imagens_tmp'][3])) {
                                    $_SESSION['imagens_tmp'][2] = $_SESSION['imagens_tmp'][3];
                                    unset($_SESSION['imagens_tmp'][3]);
                                } else {
                                    unset($_SESSION['imagens_tmp'][2]);
                                }
                            } else {
                                unset($_SESSION['imagens_tmp'][1]);
                            }
                        } else if ($num_img === 2) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][2]);
                            
                            if (isset($_SESSION['imagens_tmp'][3])) {
                                $_SESSION['imagens_tmp'][2] = $_SESSION['imagens_tmp'][3];
                                unset($_SESSION['imagens_tmp'][3]);
                            } else {
                                unset($_SESSION['imagens_tmp'][2]);
                            }
                        } else if ($num_img === 3) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][3]);
                            
                            unset($_SESSION['imagens_tmp'][3]);
                        }
                        
                        if (isset($_SESSION['imagens_tmp'])) {
                            if (empty($_SESSION['imagens_tmp'])) {
                                unset($_SESSION['imagens_tmp']);
                            }
                        }
                    }
                }
            }
        }
        
        /**
         * Function para verificar com JS se o usuario já atingiu o limite de peças.
         */
        public function Retornar_Dados_Plano() : void
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (Controller_Header_Usuario::Verificar_Status_Usuario() == 1) {
                    $retorno = [];
                    
                    $retorno['limite'] = DAO_Plano::BuscarLimitePecasPorId(Login_session::get_entidade_plano());
                    $retorno['pecas'] = DAO_Peca::Buscar_Quantidade_Pecas_Por_Entidade(Login_session::get_entidade_id());
                    
                    echo json_encode($retorno);
                }
            }
        }
        
        /**
         * Function chamada na 'View_Cadastrar' - 'Manter_Imagens()' para manter as imagens 
         * apos recarregar a pagina em um erro.
         * 
         * @param string $nome_imagem
         * @return string
         */
        public static function Pegar_Imagem_URL(string $nome_imagem) : string
        {
            $imagens = new Gerenciar_Imagens();
            
            $caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem_TMP($nome_imagem."-320x240");
            
            if (!empty($caminho_imagem)) {
                return Gerenciar_Imagens::Gerar_Data_URL($caminho_imagem);
            } else {
                return "/resources/img/imagem_indisponivel.png";
            }
        }
        
        public static function Buscar_Categorias()
        {
            return DAO_Categoria::BuscarTodos();
        }
        
        public static function Buscar_Id_Marcas_Por_Id_Categoria(int $id_categoria)
        {
            return DAO_Marca::Buscar_Id_Por_Id_Categorai($id_categoria);
        }
        
        public static function Buscar_Id_Modelos_Por_Id_Marca(int $id_marca)
        {
            return DAO_Modelo::Buscar_Id_Por_Id_Marca($id_marca);
        }
        
        public static function Buscar_Id_Versoes_Por_Id_Modelo(int $id_modelo)
        {
            return DAO_Versao::Buscar_Id_Por_Id_Modelo($id_modelo);
        }
        
        public static function Buscar_Marcas_Por_Categoria(int $id_categoria)
        {
            return DAO_Marca::Buscar_Por_Id_Categorai($id_categoria);
        }
        
        public static function Buscar_Modelos_Por_Marca(int $id_marca)
        {
            return DAO_Modelo::Buscar_Por_Id_Marca($id_marca);
        }
        
        public static function Buscar_Versoes_Por_Modelo(int $id_modelo) {
            return DAO_Versao::Buscar_Por_Id_Modelo($id_modelo);
        }
        
        public static function Buscar_Categoria_Por_Id(int $id_categoria)
        {
            return DAO_Categoria::BuscarPorCOD($id_categoria);
        }
        
        public static function Buscar_Marca_Por_Id(int $id_marca)
        {
            return DAO_Marca::BuscarPorCOD($id_marca);
        }
        
        public static function Buscar_Modelo_Por_Id(int $id_modelo)
        {
            return DAO_Modelo::BuscarPorCOD($id_modelo);
        }
        
        public static function Buscar_Versao_Por_Id(int $id_versao)
        {
            return DAO_Versao::BuscarPorCOD($id_versao);
        }
        
        public static function Buscar_Estado_Uso_Pecas()
        {
            return DAO_Estado_Uso_Peca::BuscarTodos();
        }
        
        public static function Buscar_Categoria_Id_Por_Marca(int $id_marca)
        {
            return DAO_Marca::Buscar_Categoria_Id($id_marca);
        }
        
        public static function Buscar_Marca_Id_Por_Modelo(int $id_modelo)
        {
            return DAO_Modelo::Buscar_Marca_Id($id_modelo);
        }
        
        public static function Buscar_Modelo_Id_Por_Versao(int $id_versao)
        {
            return DAO_Versao::Buscar_Modelo_Id($id_versao);
        }
        
        public static function Buscar_Categorias_Compativeis(int $id_categoria)
        {
            return DAO_Categoria_Compativel::BuscarPorCOD($id_categoria);
        }
        
        public static function Buscar_Marcas_Compativeis(int $id_marca)
        {
            return DAO_Marca_Compativel::BuscarPorCOD($id_marca);
        }
        
        public static function Buscar_Modelos_Compativeis(int $id_modelo)
        {
            return DAO_Modelo_Compativel::BuscarPorCOD($id_modelo);
        }
        
        public static function Buscar_Versoes_Compativeis(int $id_versao)
        {
            return DAO_Versao_Compativel::BuscarPorCOD($id_versao);
        }
        
        public static function Buscar_Preferencia_Entrega()
        {
            return DAO_Preferencia_Entrega::Buscar_Todos_Masivos();
        }
    }
