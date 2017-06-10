<?php
namespace application\view\src\usuario\meu_perfil\pecas;
    
	require_once RAIZ.'/application/view/src/include_page/menu/pesquisa.php';
	require_once RAIZ.'/application/view/src/include_page/menu/usuario.php';
	require_once RAIZ.'/application/view/src/include_page/menu/filtro.php';
	require_once RAIZ.'/application/view/src/include_page/menu/paginacao.php';
	require_once RAIZ.'/application/view/src/include_page/card_peca.php';
	require_once RAIZ.'/application/controller/usuario/meu_perfil/pecas/visualizar.php';
	
	use application\view\src\include_page\menu\Pesquisa as View_Pesquisa;
	use application\view\src\include_page\menu\Usuario as View_Usuario;
	use application\view\src\include_page\menu\Filtro as View_Filtro;
	use application\view\src\include_page\menu\Paginacao as View_Paginacao;
	use application\view\src\include_page\Card_Peca as View_Card_Peca;
	use application\controller\usuario\meu_perfil\pecas\Visualizar as Controller_Visualizar;
	
    class Visualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $form_pesquisa;
        private static $form_filtro;
        private static $status_usuario;
        private static $pecas;
        private static $pagina;
        private static $paginas;
        
        public function set_pecas($pecas) : void {
        	self::$pecas = $pecas;
        }
        
        public function set_pagina($pagina) : void {
        	self::$pagina = $pagina;
        }
        
        public function set_paginas($paginas) : void {
        	self::$paginas = $paginas;
        }
        
        public function set_form_pesquisa($form_pesquisa) : void {
        	self::$form_pesquisa = $form_pesquisa;
        }
        
        public function set_form_filtro($form_filtro) : void {
        	self::$form_filtro = $form_filtro;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/pecas/visualizar.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Pesquisa(self::$form_pesquisa);
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Usuario(self::$status_usuario, array('pecas', 'visualizar'));
        }
        
        public static function Incluir_Menu_Filtro() {
        	new View_Filtro(self::$form_filtro);
        }
        
        public static function Incluir_Menu_Paginacao() {
        	new View_Paginacao(self::$pagina, self::$paginas);
        }
        
        public static function Mostrar_Cards_Pecas() {
        	if (!empty(self::$pecas)) {
	        	foreach (self::$pecas as $peca) {
	        		$card_peca = new View_Card_Peca();
	        		
	        		$card_peca->Executar($peca);
	        	}
        	} else {
        		echo "<div class=\"container\"><h2><label class=\"lbPanel\">".Controller_Visualizar::Mostrar_Nome().", nenhuma peça foi encontrada.</label></h2></div>";
        		echo "<div class=\"container\"><h3><label class=\"lbPanel\">Você pode Cadastrar suas Peças </label><a href=\"/usuario/meu-perfil/pecas/cadastrar/\"> Clicando Aqui!</a></h3></div>";
        	}
        }
    }
?>