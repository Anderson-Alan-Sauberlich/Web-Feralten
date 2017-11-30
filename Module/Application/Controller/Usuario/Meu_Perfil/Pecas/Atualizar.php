<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Pecas;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Gerenciar_Imagens;
    use Module\Application\Controller\Common\Util\Peca as Util_Peca;
    use Module\Application\Model\Object\Peca as Object_Peca;
    use Module\Application\Model\Object\Endereco as Object_Endereco;
    use Module\Application\Model\Object\Status_Peca as Object_Status_Peca;
    use Module\Application\Model\Object\Estado_Uso_Peca as Object_Estado_Uso_Peca;
    use Module\Application\Model\Object\Categoria_Pativel as Object_Categoria_Pativel;
    use Module\Application\Model\Object\Marca_Pativel as Object_Marca_Pativel;
    use Module\Application\Model\Object\Modelo_Pativel as Object_Modelo_Pativel;
    use Module\Application\Model\Object\Versao_Pativel as Object_Versao_Pativel;
    use Module\Application\Model\Object\Foto_Peca as Object_Foto_Peca;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Object\Categoria as Object_Categoria;
    use Module\Application\Model\Object\Marca as Object_Marca;
    use Module\Application\Model\Object\Modelo as Object_Modelo;
    use Module\Application\Model\Object\Versao as Object_Versao;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Model\DAO\Preferencia_Entrega as DAO_Preferencia_Entrega;
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    use Module\Application\Model\DAO\Categoria_Compativel as DAO_Categoria_Compativel;
    use Module\Application\Model\DAO\Marca_Compativel as DAO_Marca_Compativel;
    use Module\Application\Model\DAO\Modelo_Compativel as DAO_Modelo_Compativel;
    use Module\Application\Model\DAO\Versao_Compativel as DAO_Versao_Compativel;
    use Module\Application\Model\DAO\Status_Peca as DAO_Status_Peca;
    use Module\Application\Model\DAO\Estado_Uso_Peca as DAO_Estado_Uso_Peca;
    use Module\Application\Model\DAO\Categoria_Pativel as DAO_Categoria_Pativel;
    use Module\Application\Model\DAO\Marca_Pativel as DAO_Marca_Pativel;
    use Module\Application\Model\DAO\Modelo_Pativel as DAO_Modelo_Pativel;
    use Module\Application\Model\DAO\Versao_Pativel as DAO_Versao_Pativel;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Foto_Peca as DAO_Foto_Peca;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Pecas\Atualizar as View_Atualizar;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use \Exception;
    
    class Atualizar
    {
        
        function __construct()
        {
            
        }
        
        private $peca_id;
        private $peca_url;
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
        private $prioridade;
        private $imagens = array();
        private $atualizar_erros = array();
        private $atualizar_sucesso = array();
        private $atualizar_campos = array();
        private $atualizar_form = array();
        
        public function set_peca_id($peca_id) : void
        {
            try {
                $this->peca_id = Validador::Peca()::validar_id($peca_id);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->peca_id = Validador::Peca()::filtrar_id($peca_id);
            }
        }
        
        public function set_peca_url($peca_url) : void
        {
            try {
                $this->peca_url = Validador::Peca()::validar_url($peca_url);
                
                $this->set_peca_id(DAO_Peca::Retornar_Id_Por_URL($this->peca_url));
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->peca_url = Validador::Peca()::filtrar_url($peca_url);
            }
        }
        
        public function set_categoria($categoria) : void
        {
            try {
                //$this->categoria = Validador::Categoria()::validar_id($categoria);
                $this->categoria = $categoria;
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->categoria = Validador::Categoria()::filtrar_id($categoria);
            }
        }
        
        public function set_marca($marca) : void
        {
            try {
                //$this->marca = Validador::Marca()::validar_id($marca);
                $this->marca = $marca;
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->marca = Validador::Marca()::filtrar_id($marca);
            }
        }
        
        public function set_modelo($modelo) : void
        {
            try {
                //$this->modelo = Validador::Modelo()::validar_id($modelo);
                $this->modelo = $modelo;
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->modelo = Validador::Modelo()::filtrar_id($modelo);
            }
        }
        
        public function set_versao($versao) : void
        {
            try {
                //$this->versao = Validador::Versao()::validar_id($versao);
                $this->versao = $versao;
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->versao = Validador::Versao()::filtrar_id($versao);
            }
        }
        
        public function set_descricao($descricao) : void
        {
            try {
                $this->descricao = Validador::Peca()::validar_descricao($descricao);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_descricao'] = 'erro';
                
                $this->descricao = Validador::Peca()::filtrar_descricao($descricao);
            }
        }
        
        public function set_estado_uso($estado_uso) : void
        {
            try {
                $this->estado_uso = Validador::Peca()::validar_estado_uso($estado_uso);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_estado_uso'] = 'erro';
                
                $this->estado_uso = Validador::Peca()::filtrar_estado_uso($estado_uso);
            }
        }
        
        public function set_preferencia_entrega($preferencia_entrega) : void
        {
            try {
                $this->preferencia_entrega = Validador::Peca()::validar_preferencia_entrega($preferencia_entrega);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->preferencia_entrega = Validador::Peca()::filtrar_preferencia_entrega($preferencia_entrega);
            }
        }
        
        public function set_fabricante($fabricante) : void
        {
            try {
                $this->fabricante = Validador::Peca()::validar_fabricante($fabricante);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_fabricante'] = 'erro';
                
                $this->fabricante = Validador::Peca()::filtrar_fabricante($fabricante);
            }
        }
        
        public function set_peca($peca) : void
        {
            try {
                $this->peca = Validador::Peca()::validar_nome($peca);
                $this->atualizar_campos['erro_peca'] = 'certo';
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_peca'] = 'erro';
                
                $this->peca = Validador::Peca()::filtrar_nome($peca);
            }
        }
        
        public function set_serie($serie) : void
        {
            try {
                $this->serie = Validador::Peca()::validar_serie($serie);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_serie'] = 'erro';
                
                $this->serie = Validador::Peca()::filtrar_serie($serie);
            }
        }
        
        public function set_preco($preco) : void
        {
            try {
                $this->preco = Validador::Peca()::validar_preco($preco);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                $this->atualizar_campos['erro_preco'] = 'erro';
                
                $this->preco = Validador::Peca()::filtrar_preco($preco);
            }
        }
        
        public function set_prioridade($prioridade) : void
        {
            try {
                $this->prioridade = Validador::Peca()::validar_prioridade($prioridade);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
                
                $this->prioridade = Validador::Peca()::filtrar_prioridade($prioridade);
            }
        }
        
        public function set_imagem($imagem, $numero) : void
        {
            try {
                $this->imagens[$numero] = Validador::Foto_Peca()::validar_imagem($imagem, $numero);
            } catch (Exception $e) {
                $this->atualizar_erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (!empty($this->peca_id) AND $this->Verificar_Dono_Peca($this->peca_id)) {
                        if (empty($this->atualizar_form)) {
                            unset($_SESSION['compatibilidade']);
                            $this->Deletar_Imagem(123);
                            
                            $object_peca = DAO_Peca::BuscarPorCOD($this->peca_id);
                            
                            if (!empty($object_peca) AND $object_peca !== false) {
                                $this->set_form($object_peca);
                                
                                $categorias = DAO_Categoria_Pativel::Buscar_Id_Por_Id_Peca($this->peca_id);
                                $marcas = DAO_Marca_Pativel::BuscarPorCOD($this->peca_id);
                                $modelos = DAO_Modelo_Pativel::BuscarPorCOD($this->peca_id);
                                $versoes = DAO_Versao_Pativel::BuscarPorCOD($this->peca_id);
                                
                                foreach ($categorias as $categoria) {
                                    $_SESSION['compatibilidade']['categoria'][$categoria] = $categoria;
                                }
                                
                                foreach ($marcas as $marca) {
                                    $_SESSION['compatibilidade']['marca'][$marca->get_object_marca()->get_id()] = $marca->get_object_marca()->get_id();
                                    
                                    if (!empty($marca->get_ano_id())) {
                                        $_SESSION['compatibilidade']['ano']['ano_mrc_'.$marca->get_object_marca()->get_id()] = DAO_Marca_Pativel::Buscar_Ano_Por_Id_Ano($marca->get_ano_id());
                                    }
                                }
                                
                                foreach ($modelos as $modelo) {
                                    $_SESSION['compatibilidade']['modelo'][$modelo->get_object_modelo()->get_id()] = $modelo->get_object_modelo()->get_id();
                                    
                                    if (!empty($modelo->get_ano_id())) {
                                        $_SESSION['compatibilidade']['ano']['ano_mdl_'.$modelo->get_object_modelo()->get_id()] = DAO_Modelo_Pativel::Buscar_Ano_Por_Id_Ano($modelo->get_ano_id());
                                    }
                                }
                                
                                foreach ($versoes as $versao) {
                                    $_SESSION['compatibilidade']['versao'][$versao->get_object_versao()->get_id()] = $versao->get_object_versao()->get_id();
                                    
                                    if (!empty($versao->get_ano_id())) {
                                        $_SESSION['compatibilidade']['ano']['ano_vrs_'.$versao->get_object_versao()->get_id()] = DAO_Versao_Pativel::Buscar_Ano_Por_Id_Ano($versao->get_ano_id());
                                    }
                                }
                            } else {
                                return 'erro';
                            }
                        }
                        
                        if (!isset($_SESSION['imagens_cnst']) OR empty($_SESSION['imagens_cnst'])) {
                            $fotos = DAO_Foto_Peca::Buscar_Fotos($this->peca_id);
                            
                            if (!empty($fotos)) {
                                foreach ($fotos as $foto) {
                                    $_SESSION['imagens_cnst'][$foto->get_numero()] = $foto->get_nome();
                                }
                            }
                        }
                        
                        $view = new View_Atualizar($status);
                        
                        $view->set_atualizar_campos($this->atualizar_campos);
                        $view->set_atualizar_erros($this->atualizar_erros);
                        $view->set_atualizar_form($this->atualizar_form);
                        $view->set_atualizar_sucesso($this->atualizar_sucesso);
                        
                        $view->Executar();
                    } else {
                        return 'erro';
                    }
                } else {
                    return 1;
                }
            } else {
                return false;
            }
        }
        
        private function Verificar_Dono_Peca($peca) : bool
        {
            if (DAO_Peca::Retornar_Dono_Peca($peca) == Login_Session::get_usuario_id()) {
                return true;
            } else {
                return false;
            }
        }
        
        public function Verificar_Evento()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (!empty($this->peca_id)) {
                        if (isset($_POST['salvar'])) {
                            $this->Atualizar_Peca();
                        } else if (isset($_POST['restaurar'])) {
                            unset($_SESSION['compatibilidade']);
                            $this->Deletar_Imagem(123);
                            $this->Carregar_Pagina();
                        }
                    } else {
                        return 'erro';
                    }
                } else {
                    return 1;
                }
            } else {
                return false;
            }
        }
        
        public function Carregar_Compatibilidade() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->categoria)) {
                    if ($this->categoria == "verificar") {
                        View_Atualizar::Carregar_Marcas();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Atualizar::Carregar_Categorias();
                    }
                }
                
                if (!empty($this->marca)) {
                    if ($this->marca == "verificar") {
                        View_Atualizar::Carregar_Modelos();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Atualizar::Carregar_Marcas();
                    }
                }
                
                if (!empty($this->modelo)) {
                    if ($this->modelo == "verificar") {
                        View_Atualizar::Carregar_Versoes();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Atualizar::Carregar_Modelos();
                    }
                }
                
                if (!empty($this->versao)) {
                    if ($this->versao == "verificar") {
                        View_Atualizar::Carregar_Anos();
                    } else {
                        $this->Salvar_Session_Compatibilidade();
                        View_Atualizar::Carregar_Versoes();
                    }
                }
            }
        }
        
        private function Salvar_Session_Compatibilidade() : void
        {
            $compatibilidade = array();
            
            $compatibilidade['categoria'] = array();
            $compatibilidade['marca'] = array();
            $compatibilidade['modelo'] = array();
            $compatibilidade['versao'] = array();
            $compatibilidade['ano'] = array();
            
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
        
        private function Atualizar_Peca() : void
        {
            $categorias_compativeis = null;
            $marcas_compativeis = null;
            $modelos_compativeis = null;
            $versoes_compativeis = null;
            
            $categorias_pativeis = array();
            $marcas_pativeis = array();
            $modelos_pativeis = array();
            $versoes_pativeis = array();
            
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
                        $categoria_pativel = new Object_Categoria_Pativel();
                        $object_categoria = new Object_Categoria();
                        $object_categoria->set_id($categoria_selecionada);
                        $categoria_pativel->set_object_categoria($object_categoria);
                        
                        $categorias_pativeis[] = $categoria_pativel;
                        
                        if (!empty($this->marca)) {
                            foreach ($this->marca as $marca_selecionada) {
                                if (in_array($marca_selecionada, $marcas_compativeis)) {
                                    if (self::Buscar_Categoria_Id_Por_Marca($marca_selecionada) == $categoria_selecionada) {
                                        $marca_pativel = new Object_Marca_Pativel();
                                        $object_marca = new Object_Marca();
                                        $object_marca->set_id($marca_selecionada);
                                        $marca_pativel->set_object_marca($object_marca);
                                        
                                        if (isset($_POST['ano_mrc_'.$marca_selecionada]) AND !empty($_POST['ano_mrc_'.$marca_selecionada])) {
                                            $marca_pativel->set_anos($_POST['ano_mrc_'.$marca_selecionada]);
                                        }
                                        
                                        $marcas_pativeis[] = $marca_pativel;
                                        
                                        if (!empty($this->modelo)) {
                                            foreach ($this->modelo as $modelo_selecionado) {
                                                if (in_array($modelo_selecionado, $modelos_compativeis)) {
                                                    if (self::Buscar_Marca_Id_Por_Modelo($modelo_selecionado) == $marca_selecionada) {
                                                        $modelo_pativel = new Object_Modelo_Pativel();
                                                        $object_modelo = new Object_Modelo();
                                                        $object_modelo->set_id($modelo_selecionado);
                                                        $modelo_pativel->set_object_modelo($object_modelo);
                                                        
                                                        if (isset($_POST['ano_mdl_'.$modelo_selecionado]) AND !empty($_POST['ano_mdl_'.$modelo_selecionado])) {
                                                            $modelo_pativel->set_anos($_POST['ano_mdl_'.$modelo_selecionado]);
                                                        }
                                                        
                                                        $modelos_pativeis[] = $modelo_pativel;
                                                        
                                                        if (!empty($this->versao)) {
                                                            foreach ($this->versao as $versao_selecionada) {
                                                                if (in_array($versao_selecionada, $versoes_compativeis)) {
                                                                    if (self::Buscar_Modelo_Id_Por_Versao($versao_selecionada) == $modelo_selecionado) {
                                                                        $versao_pativel = new Object_Versao_Pativel();
                                                                        $object_versao = new Object_Versao();
                                                                        $object_versao->set_id($versao_selecionada);
                                                                        $versao_pativel->set_object_versao($object_versao);
                                                                        
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
            
            if (empty($this->atualizar_erros)) {
                $object_peca = new Object_Peca();
                $object_estado_uso = new Object_Estado_Uso_Peca();
                $object_status = new Object_Status_Peca();
                $entidade = new Object_Entidade();
                $peca_url = Util_Peca::Gerar_URL_Peca($this->peca);
                
                if ($this->estado_uso > 0) {
                    $object_estado_uso->set_id($this->estado_uso);
                }
                
                $object_status->set_id(1);
                
                $object_peca->set_num_visualizado(0);
                $object_peca->set_id($this->peca_id);
                $object_peca->set_url($peca_url.'_'.$this->peca_id);
                $object_peca->set_estado_uso($object_estado_uso);
                $object_peca->set_status($object_status);
                $object_peca->set_descricao($this->descricao);
                $object_peca->set_preferencia_entrega($this->preferencia_entrega);
                $object_peca->set_fabricante($this->fabricante);
                $object_peca->set_nome($this->peca);
                $object_peca->set_serie($this->serie);
                $object_peca->set_preco($this->preco);
                $object_peca->set_prioridade($this->prioridade);
                
                $entidade->set_id(Login_Session::get_entidade_id());
                $entidade->set_usuario_id(Login_Session::get_usuario_id());
                
                $object_peca->set_entidade($entidade);
                $object_peca->set_data_anuncio(date('Y-m-d H:i:s'));
                
                $id_endereco = DAO_Endereco::Buscar_Id_Por_Id_Entidade(Login_Session::get_entidade_id());
                
                if ($id_endereco === false) {
                    $this->atualizar_erros[] = "Erro ao tentar adicionar o Endereço do Usuario para a Peça";
                    $this->atualizar_campos['erro_peca'] = "";
                } else {
                    $endereco = new Object_Endereco();
                    
                    $endereco->set_id($id_endereco);
                    
                    $object_peca->set_endereco($endereco);
                    
                    $usuario_responsavel = new Object_Usuario();
                    
                    $usuario_responsavel->set_id(Login_Session::get_usuario_id());
                    
                    $object_peca->set_responsavel($usuario_responsavel);
                }
                
                if (DAO_Peca::Atualizar($object_peca)) {
                    $retorno = null;
                    
                    if (!empty($categorias_pativeis)) {
                        DAO_Categoria_Pativel::Deletar($this->peca_id);
                        
                        foreach ($categorias_pativeis as $pativel) {
                            $pativel->set_peca_id($this->peca_id);
                            
                            if (DAO_Categoria_Pativel::Inserir($pativel) === false) {
                                $retorno = false;
                            }
                        }
                    } else {
                        DAO_Categoria_Pativel::Deletar($this->peca_id);
                    }
                    
                    if (!empty($marcas_pativeis)) {
                        DAO_Marca_Pativel::Deletar($this->peca_id);
                        
                        foreach ($marcas_pativeis as $pativel) {
                            $pativel->set_peca_id($this->peca_id);
                            
                            if (DAO_Marca_Pativel::Inserir($pativel) === false) {
                                $retorno = false;
                            }
                        }
                    } else {
                        DAO_Marca_Pativel::Deletar($this->peca_id);
                    }
                    
                    if (!empty($modelos_pativeis)) {
                        DAO_Modelo_Pativel::Deletar($this->peca_id);
                        
                        foreach ($modelos_pativeis as $pativel) {
                            $pativel->set_peca_id($this->peca_id);
                            
                            if (DAO_Modelo_Pativel::Inserir($pativel) === false) {
                                $retorno = false;
                            }
                        }
                    } else {
                        DAO_Modelo_Pativel::Deletar($this->peca_id);
                    }
                    
                    if (!empty($versoes_pativeis)) {
                        DAO_Versao_Pativel::Deletar($this->peca_id);
                        
                        foreach ($versoes_pativeis as $pativel) {
                            $pativel->set_peca_id($this->peca_id);
                            
                            if (DAO_Versao_Pativel::Inserir($pativel) === false) {
                                $retorno = false;
                            }
                        }
                    } else {
                        DAO_Versao_Pativel::Deletar($this->peca_id);
                    }
                    
                    if ($retorno === false) {
                        $this->atualizar_erros[] = "Erro ao tentar adicionar a Lista Compativel para a Peça";
                        $this->atualizar_campos['erro_peca'] = "";
                    }
                    
                    $gerenciar_imagens = new Gerenciar_Imagens();
                    
                    if (isset($_SESSION['imagens_cnst'])) {
                        $imagens = DAO_Foto_Peca::Buscar_Fotos($this->peca_id);
                        
                        foreach ($imagens as $imagem) {
                            if (in_array($imagem->get_nome(), $_SESSION['imagens_cnst'])) {
                                $novo_numero = array_search($imagem->get_nome(), $_SESSION['imagens_cnst']);
                                
                                if (!DAO_Foto_Peca::Atualizar_Por_Num($novo_numero, $imagem)) {
                                    $this->atualizar_erros[] = "Erro ao tentar Atualizar Foto para a Peça";
                                    $this->atualizar_campos['erro_peca'] = "";
                                }
                            } else {
                                if ($gerenciar_imagens->Deletar_Imagem_Peca($imagem->get_endereco())) {
                                    if (!DAO_Foto_Peca::Deletar_Foto($imagem->get_peca_id(), $imagem->get_numero())) {
                                        $this->atualizar_erros[] = "Erro ao tentar Atualizar Foto para a Peça";
                                        $this->atualizar_campos['erro_peca'] = "";
                                    }
                                }
                            }
                        }
                        
                        unset($_SESSION['imagens_cnst']);
                    }
                    
                    if (isset($_SESSION['imagens_tmp']) AND !empty($_SESSION['imagens_tmp'])) {
                        $diretorios_imagens = $gerenciar_imagens->Atualizar_Imagem_Peca($_SESSION['imagens_tmp'], $this->peca_id);
                        
                        if (!empty($diretorios_imagens)) {
                            foreach ($diretorios_imagens as $key => $diretorio) {
                                $foto_peca = new Object_Foto_Peca();
                                
                                $foto_peca->set_peca_id($this->peca_id);
                                $foto_peca->set_endereco($diretorio);
                                $foto_peca->set_numero($key);
                                $foto_peca->set_nome($_SESSION['imagens_tmp'][$key]);
                                
                                $del_foto = DAO_Foto_Peca::Buscar_Foto($this->peca_id, $key);
                                
                                if (!empty($del_foto) AND $del_foto !== false) {
                                    if ($gerenciar_imagens->Deletar_Imagem_Peca($del_foto->get_endereco())) {
                                        if (DAO_Foto_Peca::Atualizar($foto_peca) === false) {
                                            $this->atualizar_erros[] = "Erro ao tentar Atualizar Foto $key para a Peça";
                                            $this->atualizar_campos['erro_peca'] = "";
                                        }
                                    } else {
                                        $this->atualizar_erros[] = "Erro ao tentar Deletar Foto $key";
                                        $this->atualizar_campos['erro_peca'] = "";
                                    }
                                } else {
                                    if (DAO_Foto_Peca::Inserir($foto_peca) === false) {
                                        $this->atualizar_erros[] = "Erro ao tentar Adicionar Foto $key para a Peça";
                                        $this->atualizar_campos['erro_peca'] = "";
                                    }
                                }
                            }
                            
                            unset($_SESSION['imagens_tmp']);
                        } else {
                            $this->atualizar_erros[] = "Erro ao tentar Atualizar Fotos da Peça";
                            $this->atualizar_campos['erro_peca'] = "";
                        }
                    }
                    
                    $imagens = DAO_Foto_Peca::Buscar_Fotos($this->peca_id);
                    
                    $gerenciar_imagens->Atualizar_Nome_Imagem_Peca($this->peca_id, $peca_url);
                    
                    foreach ($imagens as $imagem) {
                        $imagem->set_nome(preg_replace('/_(.*?)_/', '_'.$peca_url.'_', $imagem->get_nome()));
                        $imagem->set_endereco(preg_replace('/_(.*?)_/', '_'.$peca_url.'_', $imagem->get_endereco()));
                        
                        DAO_Foto_Peca::Atualizar($imagem);
                    }
                    
                } else {
                    $this->atualizar_erros[] = "Erro ao tentar Atualizar Peça";
                    $this->atualizar_campos['erro_peca'] = "";
                }
            }
            
            $this->set_form($object_peca);
            
            $anos = array();
            
            if (!empty($this->marca)) {
                foreach ($this->marca as $marca) {
                    if (isset($_POST['ano_mrc_'.$marca])) {
                        $anos['ano_mrc_'.$marca] = $_POST['ano_mrc_'.$marca];
                    }
                }
            }
            
            if (!empty($this->modelo)) {
                foreach ($this->modelo as $modelo) {
                    if (isset($_POST['ano_mdl_'.$modelo])) {
                        $anos['ano_mdl_'.$modelo] = $_POST['ano_mdl_'.$modelo];
                    }
                }
            }
            
            if (!empty($this->versao)) {
                foreach ($this->versao as $versao) {
                    if (isset($_POST['ano_vrs_'.$versao])) {
                        $anos['ano_vrs_'.$versao] = $_POST['ano_vrs_'.$versao];
                    }
                }
            }
            
            $_SESSION['compatibilidade']['ano'] = $anos;
            
            if (empty($this->atualizar_erros)) {
                $this->atualizar_sucesso[] = "Peça Atualizada Com Sucesso";
                $this->atualizar_campos['erro_peca'] = "";
            }
            
            $this->Carregar_Pagina();
        }
        
        public function get_form() : ?array
        {
            $this->atualizar_form['peca_id'] = $this->peca_id;
            $this->atualizar_form['peca_url'] = $this->peca_url;
            $this->atualizar_form['peca'] = $this->peca;
            $this->atualizar_form['fabricante'] = $this->fabricante;
            $this->atualizar_form['serie'] = $this->serie;
            $this->atualizar_form['preco'] = $this->preco;
            $this->atualizar_form['estado_uso'] = $this->estado_uso;
            $this->atualizar_form['descricao'] = $this->descricao;
            $this->atualizar_form['prioridade'] = $this->prioridade;
            $this->atualizar_form['preferencia_entrega'] = Object_Peca::get_preferencias_entrega($this->preferencia_entrega);
            
            return $this->atualizar_form;
        }
        
        public function set_form(Object_Peca $object_peca) : ?array
        {
            $this->peca = $object_peca->get_nome();
            $this->peca_url = $object_peca->get_url();
            $this->fabricante = $object_peca->get_fabricante();
            $this->serie = $object_peca->get_serie();
            $this->preco = $object_peca->get_preco();
            $this->descricao = $object_peca->get_descricao();
            $this->prioridade = $object_peca->get_prioridade();
            $this->preferencia_entrega = $object_peca->get_preferencia_entrega();
            
            if (!empty($object_peca->get_estado_uso())) {
                $this->estado_uso = $object_peca->get_estado_uso()->get_id();
            }
            
            return $this->get_form();
        }
        
        public function Salvar_Imagem_TMP() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->imagens)) {
                    $imagens = new Gerenciar_Imagens();
                    
                    foreach ($this->imagens as $key => $imagem) {
                        $imagens->Armazenar_Imagem_Temporaria($imagem);
                        
                        if (!isset($_SESSION['imagens_tmp'][$key])) {
                            $_SESSION['imagens_tmp'][$key] = $imagens->get_nome();
                        }
                        
                        echo Gerenciar_Imagens::Gerar_Data_URL($imagens->get_caminho().'-400x300.'.$imagens->get_extensao());
                    }
                }  else {
                    echo '/resources/img/imagem_indisponivel.png';
                }
            }
        }
        
        public function Deletar_Imagem(int $num_img) : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (isset($_SESSION['imagens_tmp'])) {
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
                        if (isset($_SESSION['imagens_tmp'][1])) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][1]);
                        }
                        
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
                        if (isset($_SESSION['imagens_tmp'][2])) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][2]);
                        }
                        
                        if (isset($_SESSION['imagens_tmp'][3])) {
                            $_SESSION['imagens_tmp'][2] = $_SESSION['imagens_tmp'][3];
                            unset($_SESSION['imagens_tmp'][3]);
                        } else {
                            unset($_SESSION['imagens_tmp'][2]);
                        }
                    } else if ($num_img === 3) {
                        if (isset($_SESSION['imagens_tmp'][3])) {
                            $imagens->Deletar_Imagem_Temporaria($_SESSION['imagens_tmp'][3]);
                        }
                        
                        unset($_SESSION['imagens_tmp'][3]);
                    }
                    
                    if (isset($_SESSION['imagens_tmp'])) {
                        if (empty($_SESSION['imagens_tmp'])) {
                            unset($_SESSION['imagens_tmp']);
                        }
                    }
                }
                
                if (isset($_SESSION['imagens_cnst'])) {
                    if (isset($_SESSION['imagens_cnst'][$num_img]) OR $num_img === 123) {
                        if ($num_img === 123) {
                            unset($_SESSION['imagens_cnst'][1]);
                            unset($_SESSION['imagens_cnst'][2]);
                            unset($_SESSION['imagens_cnst'][3]);
                        } else if ($num_img === 1) {
                            if (isset($_SESSION['imagens_cnst'][2])) {
                                $_SESSION['imagens_cnst'][1] = $_SESSION['imagens_cnst'][2];
                                
                                if (isset($_SESSION['imagens_cnst'][3])) {
                                    $_SESSION['imagens_cnst'][2] = $_SESSION['imagens_cnst'][3];
                                    unset($_SESSION['imagens_cnst'][3]);
                                } else {
                                    unset($_SESSION['imagens_cnst'][2]);
                                }
                            } else {
                                unset($_SESSION['imagens_cnst'][1]);
                            }
                        } else if ($num_img === 2) {
                            if (isset($_SESSION['imagens_cnst'][3])) {
                                $_SESSION['imagens_cnst'][2] = $_SESSION['imagens_cnst'][3];
                                unset($_SESSION['imagens_cnst'][3]);
                            } else {
                                unset($_SESSION['imagens_cnst'][2]);
                            }
                        } else if ($num_img === 3) {
                            unset($_SESSION['imagens_cnst'][3]);
                        }
                    }
                }
            }
        }
        
        public static function Pegar_Imagem_TMP_URL(string $nome_imagem) : string
        {
            $imagens = new Gerenciar_Imagens();
            
            $caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem_TMP($nome_imagem."-400x300");
            
            if (!empty($caminho_imagem)) {
                return Gerenciar_Imagens::Gerar_Data_URL($caminho_imagem);
            } else {
                return "/resources/img/imagem_indisponivel.png";
            }
        }
        
        public static function Pegar_Imagem_CNST_URL(string $nome_imagem, int $peca) : string
        {
            $imagens = new Gerenciar_Imagens();
            
            $caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem_CNST($nome_imagem.'-400x300', $peca);
            
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
        
        public static function Buscar_Versoes_Por_Modelo(int $id_modelo)
        {
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
