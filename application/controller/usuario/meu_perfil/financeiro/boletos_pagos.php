<?php
namespace application\controller\usuario\meu_perfil\financeiro;
	
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/financeiro/boletos_pagos.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
	
	use application\view\src\usuario\meu_perfil\financeiro\Boletos_Pagos as View_Boletos_Pagos;
	use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Boletos_Pagos {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        
        		if ($status != 0) {
        			$view = new View_Boletos_Pagos($status);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
    }
?>