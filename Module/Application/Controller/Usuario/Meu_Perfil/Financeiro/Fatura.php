<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
	
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Fatura as View_Fatura;
	use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
	
    class Fatura
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		if ($status != 0) {
        		    $view = new View_Fatura($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
