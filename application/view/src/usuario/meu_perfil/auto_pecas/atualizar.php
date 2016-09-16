<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
	require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/atualizar.php');

	use application\controller\usuario\meu_perfil\auto_pecas\Atualizar as Controller_Atualizar;
	
    @session_start();

    class Atualizar {

        function __construct() {
            require_once(RAIZ.'/application/view/html/usuario/meu_perfil/auto_pecas/atualizar.php');
        }
    }
?>