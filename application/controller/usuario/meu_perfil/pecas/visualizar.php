<?php
namespace application\controller\usuario\meu_perfil\pecas;

	require_once RAIZ.'/application/view/src/usuario/meu_perfil/pecas/visualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	require_once RAIZ.'/application/model/dao/peca.php';
	
	use application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	use application\model\dao\Peca as DAO_Peca;

	@session_start();

    class Visualizar {

        function __construct() {
            
        }
        
        private static $pecas;
        private static $pagina;
        private static $paginas;
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			self::$pecas = self::Buscar_Pecas_Usuario();
        			
        			$view = new View_Visualizar($status);
        			
        			$view->set_pecas(self::$pecas);
        			$view->set_pagina(self::$pagina);
        			$view->set_paginas(self::$paginas);
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private static function Buscar_Pecas_Usuario() {
        	self::$pagina = 1;
        	self::$paginas = DAO_Peca::Buscar_Numero_Paginas_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
        	
        	if (!empty($_GET['p']) AND filter_var($_GET['p'], FILTER_VALIDATE_INT)) {
        		if ($_GET['p'] > 0 AND $_GET['p'] <= self::$paginas) {
        			self::$pagina = $_GET['p'];
        		}
        	}
        	
        	return DAO_Peca::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id(), self::$pagina);
        }
    }
?>