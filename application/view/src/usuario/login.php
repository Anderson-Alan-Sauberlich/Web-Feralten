<?php
namespace application\view\src\usuario;

    @session_start();

    class Login {

        function __construct() {
        	
        }
        
        private static $login_erros;
        private static $login_campos;
        private static $login_form;
        
        public function set_login_erros($login_erros) {
        	self::$login_erros = $login_erros;
        }
        
        public function set_login_campos($login_campos) {
        	self::$login_campos = $login_campos;
        }
        
        public function set_login_form($login_form) {
        	self::$login_form = $login_form;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/login.php';
        }
        
        public static function Manter_Valor($campo) {
            if (!empty(self::$login_form)) {
                if (isset(self::$login_form[$campo])) {
                    echo self::$login_form[$campo];
				}
            }
        }
        
        public static function Mostrar_Erros() {
            if (!empty(self::$login_erros)) {
                foreach (self::$login_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
            }
        }
        
        public static function Mostrar_Sucesso() {
            if (isset($_SESSION['login_success'])) {
                $login_success = $_SESSION['login_success'];
                
				if (isset($login_success)) {
                	foreach ($login_success as $value) {
                		echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
					}
				}
				
                unset($_SESSION['login_success']);
            }
        }

        public static function Incluir_Classe_Erros($campo) {
        	if (!empty(self::$login_campos)) {
	            switch ($campo) {
	                case "email":
	                	if (isset(self::$login_campos['erro_email'])) {
		                    if (self::$login_campos['erro_email'] == "erro") {
		                        echo "has-error has-feedback";
		                    } else if (self::$login_campos['erro_email'] == "certo") {
		                        echo "has-success has-feedback";
		                    }
	                	}
	                    break;
	                    
	                case "senha":
	                	if (isset(self::$login_campos['erro_senha'])) {
		                    if (self::$login_campos['erro_senha'] == "erro") {
		                        echo "has-error has-feedback";
		                    }
	                	}
	                    break;
	           }
			}
		}
    }
?>