<?php
namespace application\view\src\usuario\meu_perfil\meus_dados;
    
    use application\view\src\layout\menu\Usuario as View_Usuario;
    
    class Alterar_Senha {
    	
        function __construct(?int $status = null) {
        	self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $alterar_senha_erros;
        private static $alterar_senha_campos;
        private static $alterar_senha_form;
        
        public function set_alterar_senha_erros(?array $alterar_senha_erros = null) : void {
        	self::$alterar_senha_erros = $alterar_senha_erros;
        }
        
        public function set_alterar_senha_campos(?array $alterar_senha_campos = null) : void {
        	self::$alterar_senha_campos = $alterar_senha_campos;
        }
        
        public function set_alterar_senha_form(?array $alterar_senha_form = null) : void {
        	self::$alterar_senha_form = $alterar_senha_form;
        }
        
        public function Executar() : void {
        	require_once RAIZ.'/application/view/html/usuario/meu_perfil/meus_dados/Alterar_Senha.php';
        }
		
        public static function Incluir_Menu_Usuario() : void {
        	new View_Usuario(self::$status_usuario, array('meus-dados', 'alterar-senha'));
        }
        
        public static function Manter_Valor(string $campo) : void {
            if (!empty(self::$alterar_senha_form)) {
                if (isset(self::$alterar_senha_form[$campo])) {
                    echo self::$alterar_senha_form[$campo];
                }
            }
        }
        
        public static function Mostrar_Erros() : void {
            if (!empty(self::$alterar_senha_erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$alterar_senha_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                }
                echo "</div></div>";
            }
        }
        
        public function Incluir_Classe_Erros(string $campo) : void {
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