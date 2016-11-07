<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    require_once RAIZ.'/application/view/src/include_page/menu_usuario.php';
    
    use application\view\src\include_page\Menu_Usuario as View_Menu_Usuario;
    
    class Alterar_Senha {
    	
        function __construct($status) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $alterar_senha_erros;
        private static $alterar_senha_campos;
        private static $alterar_senha_form;
        
        public function set_alterar_senha_erros($alterar_senha_erros) {
        	self::$alterar_senha_erros = $alterar_senha_erros;
        }
        
        public function set_alterar_senha_campos($alterar_senha_campos) {
        	self::$alterar_senha_campos = $alterar_senha_campos;
        }
        
        public function set_alterar_senha_form($alterar_senha_form) {
        	self::$alterar_senha_form = $alterar_senha_form;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/alterar_senha.php';
        }
		
        public static function Incluir_Menu_Usuario() {
        	new View_Menu_Usuario(self::$status_usuario, array('meus-dados', 'alterar-senha'));
        }
        
        public static function Manter_Valor($campo) {
            if (!empty(self::$alterar_senha_form)) {
                if (isset(self::$alterar_senha_form[$campo])) {
                    echo self::$alterar_senha_form[$campo];
                }
            }
        }
        
        public static function Mostrar_Erros() {
            if (!empty(self::$alterar_senha_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$alterar_senha_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                }
                echo "</div></div>";
            }
        }
        
        public function Incluir_Classe_Erros($campo) {
        	if (!empty(self::$alterar_senha_campos)) {
	            switch ($campo) {
	                case "senha_antiga":
	                	if (isset(self::$alterar_senha_campos['erro_senha_antiga'])) {
		                    if (self::$alterar_senha_campos['erro_senha_antiga'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$alterar_senha_campos['erro_senha_antiga'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
						
	                case "senha_nova":
	                	if (isset(self::$alterar_senha_campos['erro_senha_nova'])) {
		                    if (self::$alterar_senha_campos['erro_senha_nova'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$alterar_senha_campos['erro_senha_nova'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
						
	                case "senha_confnova":
	                	if (isset(self::$alterar_senha_campos['erro_senha_confnova'])) {
		                    if (self::$alterar_senha_campos['erro_senha_confnova'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$alterar_senha_campos['erro_senha_confnova'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	            }
            }
        }
    }
?>