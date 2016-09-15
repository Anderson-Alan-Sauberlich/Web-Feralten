<?php
namespace application\controller\usuario\meu_perfil;

	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/perfil.php');

	use application\view\src\usuario\meu_perfil\Perfil as View_Perfil;
					
	@session_start();
	
    class Perfil {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Perfil();
        }
    }
?>