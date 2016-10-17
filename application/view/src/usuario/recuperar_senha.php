<?php
namespace application\view\src\usuario;

	@session_start();

    class Recuperar_Senha {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/usuario/recuperar_senha.php';
        }
    }
?>