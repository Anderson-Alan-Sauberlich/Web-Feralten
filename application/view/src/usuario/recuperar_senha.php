<?php
namespace application\view\src\usuario;

	@session_start();

    class Recuperar_Senha {

        function __construct() {
        	require_once RAIZ.'/application/view/html/usuario/recuperar_senha.php';
        }
    }
?>