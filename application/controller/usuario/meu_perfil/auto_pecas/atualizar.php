<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;
    
	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/atualizar.php');

	use application\view\src\usuario\meu_perfil\auto_pecas\Atualizar as View_Atualizar;
	
	@session_start();
	
    class Atualizar {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Atualizar();
        }
    }
?>