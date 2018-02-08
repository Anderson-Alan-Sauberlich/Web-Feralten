<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos as View_Meus_Orcamentos;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Controller\Layout\Menu\Orcamento as Controller_Menu_Orcamento;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Meus_Orcamentos
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Meus_Orcamentos($status);
                
                $controller_menu_orcamento = new Controller_Menu_Orcamento();
                
                $view->set_view_menu_orcamento($controller_menu_orcamento->Retornar_Pagina());
                
                $view->Executar();
            } else {
                return false;
            }
        }
    }
