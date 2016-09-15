<?php
namespace application\view\src\usuario\meu_perfil;
    
	require_once(RAIZ.'/application/controller/usuario/meu_perfil/perfil.php');
	
	use application\controller\usuario\meu_perfil\Perfil as Controller_Perfil;

    @session_start();

    class Perfil {

        function __construct() {
            require_once(RAIZ.'/application/view/html/usuario/meu_perfil/perfil.php');
        }
    }
?>