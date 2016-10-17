<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
	require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php';
	require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
	require_once RAIZ.'/application/view/src/include_page/menu_filtro.php';
	
	use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa;
	use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
	use application\view\src\include_page\Menu_Filtro as View_Menu_Filtro;
	
    @session_start();

    class Visualizar {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $pecas;
        
        public function set_pecas($pecas) {
        	self::$pecas = $pecas;
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
        
        public static function Mostrar_Card_Peca() {
        	if (!empty(self::$pecas)) {
	        	foreach (self::$pecas as $peca) {
	        		echo "<div class=\"ui raised card\">";
	        		echo "<div class=\"content\">";
	        		echo "<div class=\"meta\">".$peca->get_nome()."</div>";
	        		echo "</div>";
	        		echo "<div class=\"ui medium bordered image\">";
	        		echo "<img src=\"/application/view/resources/img/imagem_Indisponivel.png\">";
	        		echo "</div>";
	        		echo "<div class=\"content\">";
	        		echo "<div class=\"header\">Molly</div>";
	        		echo "<div class=\"meta\">";
	        		echo "<span class=\"date\">Coworker</span>";
	        		echo "</div>";
	        		echo "<div class=\"description\">";
	        		echo "Molly is a personal assistant living in Paris.";
	        		echo "</div>";
	        		echo "</div>";
	        		echo "<div class=\"extra content\">";
	        		echo "<span class=\"right floated\">Joined in 2011</span>";
	        		echo "<span><i class=\"user icon\"></i>35 Friends</span>";
	        		echo "</div>";
	        		echo "<div class=\"extra content\">";
	        		echo "<div class=\"ui two buttons\">";
	        		echo "<div class=\"ui basic green button\">Atualizar</div>";
	        		echo "<div class=\"ui basic red button\">Excluir</div>";
	        		echo "</div>";
	        		echo "</div>";
	        		echo "</div>";
	        	}
        	}
        }
    }
?>