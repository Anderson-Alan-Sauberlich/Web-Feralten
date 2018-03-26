<?php
namespace Module\Application\Controller\Layout\Menu;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Categoria_Pativel as DAO_Categoria_Pativel;
    use Module\Application\Model\DAO\Marca_Pativel as DAO_Marca_Pativel;
    use Module\Application\Model\DAO\Modelo_Pativel as DAO_Modelo_Pativel;
    use Module\Application\Model\DAO\Versao_Pativel as DAO_Versao_Pativel;
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    use Module\Application\Model\OBJ\Categoria_Pativel as OBJ_Categoria_Pativel;
    use Module\Application\Model\OBJ\Marca_Pativel as OBJ_Marca_Pativel;
    use Module\Application\Model\OBJ\Modelo_Pativel as OBJ_Modelo_Pativel;
    use Module\Application\Model\OBJ\Versao_Pativel as OBJ_Versao_Pativel;
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\OBJ\Categoria as OBJ_Categoria;
    use Module\Application\Model\OBJ\Marca as OBJ_Marca;
    use Module\Application\Model\OBJ\Modelo as OBJ_Modelo;
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    use Module\Application\Controller\Layout\Menu\Filtro as Controller_Filtro;
    use \Exception;
    
    class Pesquisa
    {
        function __construct()
        {
            $this->obj_peca = new OBJ_Peca();
            $this->obj_controller_filtro = new Controller_Filtro();
        }
        
        private $pagina = 0;
        private $paginas = 0;
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $ano_de;
        private $ano_ate;
        private $obj_peca;
        private $obj_controller_filtro;
        
        public function set_pagina($pagina) : void
        {
            if (!empty($pagina)) {
                $pagina = trim($pagina);
                
                if (filter_var($pagina, FILTER_VALIDATE_INT) !== false) {
                    $this->pagina = $pagina;
                } else {
                    $this->pagina = 0;
                }
            } else {
                $this->pagina = 0;
            }
        }
        
        public function set_paginas($paginas) : void
        {
            if ($paginas !== false) {
                if (!empty($paginas)) {
                    if (filter_var($paginas, FILTER_VALIDATE_INT) !== false) {
                        $this->paginas = $paginas;
                        
                        if (empty($this->pagina) OR $this->pagina <= 0) {
                            $this->pagina = 1;
                        } else if ($this->pagina > $this->paginas) {
                            $this->pagina = $this->paginas;
                        }
                    } else {
                        $this->pagina = 0;
                    }
                } else {
                    $this->pagina = 0;
                }
            } else {
                $this->pagina = 0;
            }
        }
        
        public function set_categoria($categoria): void
        {
            try {
                $this->categoria = Validador::Categoria()::validar_id($categoria);
            } catch (Exception $e) {
                $this->categoria = Validador::Categoria()::filtrar_id($categoria);
            }
        }
        
        public function set_marca($marca) : void
        {
            try {
                $this->marca = Validador::Marca()::validar_id($marca);
            } catch (Exception $e) {
                $this->marca = Validador::Marca()::filtrar_id($marca);
            }
        }
        
        public function set_modelo($modelo) : void
        {
            try {
                $this->modelo = Validador::Modelo()::validar_id($modelo);
            } catch (Exception $e) {
                $this->modelo = Validador::Modelo()::filtrar_id($modelo);
            }
        }
        
        public function set_versao($versao) : void
        {
            try {
                $this->versao = Validador::Versao()::validar_id($versao);
            } catch (Exception $e) {
                $this->versao = Validador::Versao()::filtrar_id($versao);
            }
        }
        
        public function set_categoria_url($url_categoria) : void
        {
            try {
                $this->set_categoria(DAO_Categoria::Buscar_ID_Por_URL(Validador::Categoria()::validar_url($url_categoria)));
            } catch (Exception $e) {
                $this->categoria = 0;
            }
        }
        
        public function set_marca_url($url_marca) : void
        {
            try {
                $this->set_marca(DAO_Marca::Buscar_ID_Por_URL($this->categoria, Validador::Marca()::validar_url($url_marca)));
            } catch (Exception $e) {
                $this->marca = 0;
            }
        }
        
        public function set_modelo_url($url_modelo) : void
        {
            try {
                $this->set_modelo(DAO_Modelo::Buscar_ID_Por_URL($this->marca, Validador::Modelo()::validar_url($url_modelo)));
            } catch (Exception $e) {
                $this->modelo = 0;
            }
        }
        
        public function set_versao_url($url_versao) : void
        {
            try {
                $this->set_versao(DAO_Versao::Buscar_ID_Por_URL($this->modelo, Validador::Versao()::validar_url($url_versao)));
            } catch (Exception $e) {
                $this->versao = 0;
            }
        }
        
        public function set_ano_de($ano_de) : void
        {
            try {
                $this->ano_de = Validador::Categoria_Pativel()::validar_ano_de($ano_de);
            } catch (Exception $e) {
                $this->ano_de = Validador::Categoria_Pativel()::filtrar_ano_de($ano_de);
            }
        }
        
        public function set_ano_ate($ano_ate) : void
        {
            try {
                $this->ano_ate = Validador::Categoria_Pativel()::validar_ano_ate($ano_ate);
            } catch (Exception $e) {
                $this->ano_ate = Validador::Categoria_Pativel()::filtrar_ano_ate($ano_ate);
            }
        }
        
        public function set_peca_nome($nome_peca) : void
        {
            try {
                $this->obj_peca->set_nome(Validador::Peca()::validar_nome($nome_peca));
            } catch (Exception $e) {
                
            }
        }
        
        public function set_peca_usuario(int $id_usuario = null) : void
        {
            try {
                $entidade = new OBJ_Entidade();
                $entidade->set_usuario_id(Validador::Peca()::validar_responsavel($id_usuario));
                $this->obj_peca->set_entidade($entidade);
            } catch (Exception $e) {
                
            }
        }
        
        public function set_obj_controller_filtro(Controller_Filtro $obj_controller_filtro) : void
        {
            $this->obj_controller_filtro = $obj_controller_filtro;
            
            if (!empty($obj_controller_filtro->get_estado()) OR !empty($obj_controller_filtro->get_cidade())) {
                $obj_endereco = new OBJ_Endereco();
                
                if (!empty($obj_controller_filtro->get_estado())) {
                    $obj_endereco->set_estado($obj_controller_filtro->get_obj_estado());
                }
                
                if (!empty($obj_controller_filtro->get_cidade())) {
                    $obj_endereco->set_cidade($obj_controller_filtro->get_obj_cidade());
                }
                
                $this->obj_peca->set_endereco($obj_endereco);
            }
            
            if (!empty($obj_controller_filtro->get_estado_uso())) {
                $this->obj_peca->set_estado_uso($obj_controller_filtro->get_obj_estado_uso());
            }
            
            if (!empty($obj_controller_filtro->get_preferencia_entrega())) {
                $this->obj_peca->set_preferencia_entrega($obj_controller_filtro->get_preferencia_entrega());
            }
            
            if (!empty($obj_controller_filtro->get_status_peca())) {
                $this->obj_peca->set_status($obj_controller_filtro->get_obj_status_peca());
            }
        }
        
        public function get_pagina() : ?int
        {
            return $this->pagina;
        }
        
        public function get_paginas() : ?int
        {
            return $this->paginas;
        }
        
        public function get_form() : ?array
        {
            $form_pesquisar = array();
            
            $form_pesquisar['categoria'] = $this->categoria;
            $form_pesquisar['marca'] = $this->marca;
            $form_pesquisar['modelo'] = $this->modelo;
            $form_pesquisar['versao'] = $this->versao;
            $form_pesquisar['peca_nome'] = $this->obj_peca->get_nome();
            $form_pesquisar['ano_de'] = $this->ano_de;
            $form_pesquisar['ano_ate'] = $this->ano_ate;
            
            return $form_pesquisar;
        }
        
        public function Retornar_Marcas_Por_Categoria() : void
        {
            View_Pesquisa::Carregar_Marcas($this->categoria);
        }
        
        public function Retornar_Modelos_Por_Marca() : void
        {
            View_Pesquisa::Carregar_Modelos($this->marca);
        }
        
        public function Retornar_Versoes_Por_Modelo() : void
        {
            View_Pesquisa::Carregar_Versoes($this->modelo);
        }
        
        public static function Buscar_Todas_Categorias()
        {
            return DAO_Categoria::BuscarTodos();
        }
        
        public static function Buscar_Marca_Por_Id_Categoria(?int $categoria)
        {
            if (!empty($categoria)) {
                return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
            } else {
                return null;
            }
        }
        
        public static function Buscar_Modelo_Por_Id_Marca(?int $marca)
        {
            if (!empty($marca)) {
                return DAO_Modelo::Buscar_Por_ID_Marca($marca);
            } else {
                return null;
            }
        }
        
        public static function Buscar_Versoes_Por_Id_Modelo(?int $modelo)
        {
            if (!empty($modelo)) {
                return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
            } else {
                return null;
            }
        }
        
        public function Buscar_Pecas() : ?array
        {
            $retorno = null;
             
            if (!empty($this->versao)) {
                $retorno = $this->Buscar_Por_Versao();
            } else if (!empty($this->modelo)) {
                $retorno = $this->Buscar_Por_Modelo();
            }  else if (!empty($this->marca)) {
                $retorno = $this->Buscar_Por_Marca();
            } else if (!empty($this->categoria)) {
                $retorno = $this->Buscar_Por_Categoria();
            } else {
                $retorno = $this->Buscar_Por_Usuario();
            }
            
            if (isset($retorno) AND !empty($retorno) AND $retorno !== false) {
                return $retorno;
            } else {
                return null;
            }
        }
        
        private function Buscar_Por_Usuario()
        {
            $this->set_paginas(DAO_Peca::Buscar_Numero_Paginas($this->obj_peca, $this->obj_controller_filtro->get_form()));
            
            return DAO_Peca::Buscar_Pecas($this->obj_peca, $this->obj_controller_filtro->get_form(), $this->pagina);
        }
        
        private function Buscar_Por_Categoria()
        {
            $obj_categoria_pativel = new OBJ_Categoria_Pativel();
            
            $obj_categoria = new OBJ_Categoria();
            $obj_categoria->set_id($this->categoria);
            
            $obj_categoria_pativel->set_obj_categoria($obj_categoria);
            $obj_categoria_pativel->set_ano_de($this->ano_de);
            $obj_categoria_pativel->set_ano_ate($this->ano_ate);
            
            $this->set_paginas(DAO_Categoria_Pativel::Buscar_Numero_Paginas($obj_categoria_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form()));
            
            return DAO_Categoria_Pativel::Buscar_Pecas($obj_categoria_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form(), $this->pagina);
        }
        
        private function Buscar_Por_Marca()
        {
            $obj_marca_pativel = new OBJ_Marca_Pativel();
            
            $obj_marca = new OBJ_Marca();
            $obj_marca->set_id($this->marca);
            
            $obj_marca_pativel->set_obj_marca($obj_marca);
            $obj_marca_pativel->set_ano_de($this->ano_de);
            $obj_marca_pativel->set_ano_ate($this->ano_ate);
            
            $this->set_paginas(DAO_Marca_Pativel::Buscar_Numero_Paginas($obj_marca_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form()));
             
            return DAO_Marca_Pativel::Buscar_Pecas($obj_marca_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form(), $this->pagina);
        }
        
        private function Buscar_Por_Modelo()
        {
            $obj_modelo_pativel = new OBJ_Modelo_Pativel();
            
            $obj_modelo = new OBJ_Modelo();
            $obj_modelo->get_id($this->modelo);
            
            $obj_modelo_pativel->set_obj_modelo($obj_modelo);
            $obj_modelo_pativel->set_ano_de($this->ano_de);
            $obj_modelo_pativel->set_ano_ate($this->ano_ate);
            
            $this->set_paginas(DAO_Modelo_Pativel::Buscar_Numero_Paginas($obj_modelo_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form()));
            
            return DAO_Modelo_Pativel::Buscar_Pecas($obj_modelo_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form(), $this->pagina);
        }
        
        private function Buscar_Por_Versao()
        {
            $obj_versao_pativel = new OBJ_Versao_Pativel();
            
            $obj_versao = new OBJ_Versao();
            $obj_versao->set_id($this->versao);
            
            $obj_versao_pativel->set_obj_versao($obj_versao);
            $obj_versao_pativel->set_ano_de($this->ano_de);
            $obj_versao_pativel->set_ano_ate($this->ano_ate);
            
            $this->set_paginas(DAO_Versao_Pativel::Buscar_Numero_Paginas($obj_versao_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form()));
             
            return DAO_Versao_Pativel::Buscar_Pecas($obj_versao_pativel, $this->obj_peca, $this->obj_controller_filtro->get_form(), $this->pagina);
        }
    }
