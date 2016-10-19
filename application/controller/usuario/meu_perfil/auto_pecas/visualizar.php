<?php
namespace application\controller\usuario\meu_perfil\auto_pecas;

	require_once RAIZ.'/application/view/src/usuario/meu_perfil/auto_pecas/visualizar.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
	require_once RAIZ.'/application/model/dao/peca.php';
	require_once RAIZ.'/application/model/dao/status_peca.php';
	require_once RAIZ.'/application/model/dao/foto_peca.php';
	
	use application\view\src\usuario\meu_perfil\auto_pecas\Visualizar as View_Visualizar;
	use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	use application\model\dao\Peca as DAO_Peca;
	use application\model\dao\Status_Peca as DAO_Status_Peca;
	use application\model\dao\Foto_Peca as DAO_Foto_Peca;

	@session_start();

    class Visualizar {

        function __construct() {
            
        }
        
        private static $pecas;
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		if ($status == 1) {
        			self::$pecas = self::Buscar_Pecas_Usuario();
        			
        			$view = new View_Visualizar($status);
        			
        			$view->set_pecas(self::$pecas);
        			$view->set_status_pecas(DAO_Status_Peca::Buscar_Lista_Todos());
        			$view->set_fotos_pecas(self::Buscar_Lista_Fotos());
        			
        			$view->Executar();
        		}
        		
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        private static function Buscar_Pecas_Usuario() {
        	return DAO_Peca::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
        }
        
        private static function Buscar_Lista_Fotos() {
        	if (!empty(self::$pecas)) {
        		$fotos = array();
        		
        		foreach (self::$pecas as $peca) {
        			$foto = DAO_Foto_Peca::Buscar_Foto($peca->get_id(), 1);
        			
        			if (!empty($foto) AND $foto !== false) {
        				$fotos[$foto->get_peca_id()] = $foto->get_endereco();
        			}
        		}
        		
        		return $fotos;
        	} else {
        		return null;
        	}
        }
    }
?>