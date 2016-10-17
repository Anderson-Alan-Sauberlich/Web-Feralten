<?php
namespace application\view\src\usuario;

    @session_start();

    class Login {

        function __construct() {
        	
        }
        
        private static $login_erros;
        private static $login_sucesso;
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
        
        public function set_login_sucesso($login_sucesso) {
        	self::$login_sucesso = $login_sucesso;
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
        	$login_erros = null;
        	
        	if (!empty(self::$login_erros)) {
        		$login_erros = self::$login_erros;
        	} else if (!empty($_SESSION['login_erros'])) {
        		$login_erros = $_SESSION['login_erros'];
        		unset($_SESSION['login_erros']);
        	}
        	
            if (!empty($login_erros)) {
                foreach ($login_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
            }
        }
        
        public static function Mostrar_Sucesso() {
        	$login_sucesso = null;
        	 
        	if (!empty(self::$login_sucesso)) {
        		$login_sucesso = self::$login_sucesso;
        	} else if (!empty($_SESSION['login_sucesso'])) {
        		$login_sucesso = $_SESSION['login_sucesso'];
        		unset($_SESSION['login_sucesso']);
        	}
        	
            if (!empty($login_sucesso)) {
                foreach ($login_sucesso as $value) {
                	echo "<div class=\"alert alert-success col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong><span class=\"glyphicon glyphicon-ok\"></span></strong> " . $value . "</div>";
				}
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