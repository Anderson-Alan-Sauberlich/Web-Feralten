<?php
namespace application\view\src\usuario\meu_perfil\pecas;
    
	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	require_once RAIZ.'/application/view/src/include_page/menu_filtro.php';
	require_once RAIZ.'/application/view/src/include_page/menu_paginacao.php';
	require_once RAIZ.'/application/view/src/include_page/card_peca.php';
	
	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro;
	use application\view\src\include_page\Menu_Paginacao as View_Menu_Paginacao;
	use application\view\src\include_page\Card_Peca as View_Card_Peca;
	
    class Visualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $pecas;
        private static $pagina;
        private static $paginas;
        
        public function set_pecas($pecas) {
        	self::$pecas = $pecas;
        }
        
        public function set_pagina($pagina) {
        	self::$pagina = $pagina;
        }
        
        public function set_paginas($paginas) {
        	self::$paginas = $paginas;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/pecas/visualizar.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Menu_Pesquisa('/usuario/meu-perfil/pecas/visualizar/');
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('pecas', 'visualizar'));
        }
        
        public static function Incluir_Menu_Filtro() {
        	new View_Menu_Filtro();
        }
        
        public static function Incluir_Menu_Paginacao() {
        	new View_Menu_Paginacao(self::$pagina, self::$paginas);
        }
        
        public static function Mostrar_Cards_Pecas() {
        	if (!empty(self::$pecas)) {
	        	foreach (self::$pecas as $peca) {
	        		$card_peca = new View_Card_Peca();
	        		
	        		$card_peca->Executar($peca);
	        	}
        	} else {
        		echo "<div class=\"container\"><h2><label class=\"lbPanel\">".unserialize($_SESSION['usuario'])->get_nome().", nenhuma peça foi encontrada.</label></h2></div>";
        		echo "<div class=\"container\"><h3><label class=\"lbPanel\">Você pode Cadastrar suas Peças </label><a href=\"/usuario/meu-perfil/pecas/cadastrar/\"> Clicando Aqui!</a></h3></div>";
        	}
        }
    }
?>