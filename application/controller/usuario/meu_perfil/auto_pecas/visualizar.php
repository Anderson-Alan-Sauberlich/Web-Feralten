<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;

	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/visualizar.php');
	
	use application\view\src\usuario\meu_perfil\auto_pecas\Visualizar as View_Visualizar;

	@session_start();

    class Visualizar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Visualizar();
        }
    }
?>