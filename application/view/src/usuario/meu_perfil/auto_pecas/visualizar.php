<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	require_once RAIZ.'/application/view/src/include_page/menu_filtro.php';
	require_once RAIZ.'/application/view/src/include_page/menu_paginacao.php';
	
	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro;
	use application\view\src\include_page\Menu_Paginacao as View_Menu_Paginacao;
	
    @session_start();

    class Visualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $pecas;
        private static $status_pecas;
        private static $fotos_pecas;
        private static $pagina;
        private static $paginas;
        
        public function set_pecas($pecas) {
        	self::$pecas = $pecas;
        }
        
        public function set_fotos_pecas($fotos_pecas) {
        	self::$fotos_pecas = $fotos_pecas;
        }
        
        public function set_status_pecas($status_pecas) {
        	self::$status_pecas = $status_pecas;
        }
        
        public function set_pagina($pagina) {
        	self::$pagina = $pagina;
        }
        
        public function set_paginas($paginas) {
        	self::$paginas = $paginas;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/auto_pecas/visualizar.php';
        }
        
        public static function Incluir_Menu_Pesquisa() {
        	new View_Menu_Pesquisa();
        }
        
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('auto-pecas', 'visualizar'));
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
	        		echo "<div class=\"ui raised card\">";
	        		echo "<div class=\"content\">";
	        		echo "<div class=\"meta\">".$peca->get_nome()."</div>";
	        		echo "</div>";
	        		echo "<div class=\"ui medium bordered image\">";
	        		if (!empty(self::$fotos_pecas)) {
	        			if (!empty(self::$fotos_pecas[$peca->get_id()])) {
	        				echo "<img src=\"".str_replace("@", "200x150", self::$fotos_pecas[$peca->get_id()])."\">";
	        			} else {
	        				echo "<img src=\"/application/view/resources/img/imagem_Indisponivel.png\">";
	        			}
	        		}
	        		echo "</div>";
	        		echo "<div class=\"content\">";
	        		if (!empty($peca->get_preco()) AND !empty($peca->get_status_id())) {
	        			echo "<div class=\"right floated header\">R$: ".$peca->get_preco()."</div>";
	        			echo "<div class=\"meta\">";
	        			echo "<span class=\"date\">".self::$status_pecas[$peca->get_status_id()]."</span>";
	        			echo "</div>";//meta
	        		} else if (!empty($peca->get_preco()) AND empty($peca->get_status_id())) {
	        			echo "<div class=\"header\">R$: ".$peca->get_preco()."</div>";
	        		} else if (empty($peca->get_preco()) AND !empty($peca->get_status_id())) {
	        			echo "<div class=\"header\">R$: A Negociar</div>";
	        			echo "<div class=\"meta\">";
	        			echo "<span class=\"date\">".self::$status_pecas[$peca->get_status_id()]."</span>";
	        			echo "</div>";//meta
	        		} else if (empty($peca->get_preco())) {
	        			echo "<div class=\"header\">R$: A Negociar</div>";
	        		}
	        		if (!empty($peca->get_fabricante())) {
	        			echo "<div class=\"description\">".$peca->get_fabricante()."</div>";
	        		}
	        		echo "</div>";//content
	        		echo "<div class=\"extra content\">";
	        		echo "<span class=\"right floated\">".$peca->get_data_anuncio()."</span>";
	        		echo "<span><i class=\"user icon\"></i>livre</span>";
	        		echo "</div>";//extra content
	        		echo "<div class=\"extra content\">";
	        		echo "<div class=\"ui two buttons\">";
	        		echo "<button class=\"ui inverted green button\">Atualizar</button>";
	        		echo "<button class=\"ui inverted red button\">Excluir</button>";
	        		echo "</div>";//ui two buttons
	        		echo "</div>";//extra content
	        		echo "</div>";
	        	}
        	} else {
        		echo "<div class=\"container\"><h2><label class=\"lbPanel\">".unserialize($_SESSION['usuario'])->get_nome().", nenhuma peça foi encontrada.</label></h2></div>";
        		echo "<div class=\"container\"><h3><label class=\"lbPanel\">Você pode Cadastrar suas Peças </label><a href=\"/usuario/meu-perfil/auto-pecas/cadastrar/\"> Clicando Aqui!</a></h3></div>";
        	}
        }
    }
?>