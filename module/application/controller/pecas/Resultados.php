<?php
namespace module\application\controller\pecas;
	
	use module\application\view\src\pecas\Resultados as View_Resultados;
	use module\application\controller\layout\menu\Pesquisa as Controller_Pesquisa;
	use module\application\controller\layout\menu\Filtro as Controller_Filtro;
	
    class Resultados
    {

        function __construct()
        {
        	$this->controller_pesquisa = new Controller_Pesquisa();
        	$this->controller_filtro = new Controller_Filtro();
        }
        
        private $controller_pesquisa;
        private $controller_filtro;
        
        public function set_pagina($pagina) : void
        {
        	$this->controller_pesquisa->set_pagina($pagina);
        }
        
        public function set_estado_uf($estado_uf) : void
        {
        	$this->controller_filtro->set_estado_uf($estado_uf);
        }
        
        public function set_cidade_url($cidade_url) : void
        {
        	$this->controller_filtro->set_cidade_url($cidade_url);
        }
        
        public function set_categoria_url($url_categoria) : void
        {
        	$this->controller_pesquisa->set_categoria_url($url_categoria);
        }
        
        public function set_marca_url($url_marca) : void
        {
        	$this->controller_pesquisa->set_marca_url($url_marca);
        }
        
        public function set_modelo_url($url_modelo) : void
        {
        	$this->controller_pesquisa->set_modelo_url($url_modelo);
        }
        
        public function set_versao_url($url_versao) : void
        {
        	$this->controller_pesquisa->set_versao_url($url_versao);
        }
        
        public function set_ano_de($ano_de) : void
        {
        	$this->controller_pesquisa->set_ano_de($ano_de);
        }
        
        public function set_ano_ate($ano_ate) : void
        {
        	$this->controller_pesquisa->set_ano_ate($ano_ate);
        }
        
        public function set_peca_nome($nome_peca) : void
        {
        	$this->controller_pesquisa->set_peca_nome($nome_peca);
        }
        
        public function set_ordem_preco($ordem_preco) : void
        {
        	$this->controller_filtro->set_ordem_preco($ordem_preco);
        }
        
        public function set_ordem_data($ordem_data) : void
        {
        	$this->controller_filtro->set_ordem_data($ordem_data);
        }
        
        public function set_estado_uso_url($estado_uso) : void
        {
        	$this->controller_filtro->set_estado_uso_url($estado_uso);
        }
        
        public function set_preferencia_entrega_url($preferencia_entrega) : void
        {
        	$this->controller_filtro->set_preferencia_entrega_url($preferencia_entrega);
        }
        
        public function set_status_peca_url($status_peca) : void
        {
            $this->controller_filtro->set_status_peca_url($status_peca);
        }
        
        public function Carregar_Pagina()
        {
        	$this->controller_pesquisa->set_object_controller_filtro($this->controller_filtro);
        	
        	$view = new View_Resultados();
        	
        	$view->set_pecas($this->controller_pesquisa->Buscar_Pecas());
        	$view->set_pagina($this->controller_pesquisa->get_pagina());
        	$view->set_paginas($this->controller_pesquisa->get_paginas());
        	$view->set_form_pesquisa($this->controller_pesquisa->get_form());
        	$view->set_form_filtro($this->controller_filtro->get_form());
        	
        	$view->Executar();
        }
    }
