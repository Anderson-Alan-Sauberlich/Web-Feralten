<?php
namespace application\controller\publicidade;
	
	require_once RAIZ.'/application/view/src/publicidade/condicoes_gerais.php';
	
	use application\view\src\publicidade\Condicoes_Gerais as View_Condicoes_Gerais;
	
	@session_start();
	
    class Condicoes_Gerais {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Condicoes_Gerais();
        }
    }
?>