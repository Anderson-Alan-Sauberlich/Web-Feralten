<?php
namespace application\controller\usuario;
	
	require_once RAIZ.'/application/view/src/usuario/recuperar_senha.php';
	
	use application\view\src\usuario\Recuperar_Senha as View_Recuperar_Senha;
	
    class Recuperar_Senha {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	$view = new View_Recuperar_Senha();
        	
        	$view->Executar();
        }
    }
?>