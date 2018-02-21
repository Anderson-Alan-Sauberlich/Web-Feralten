<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados as View_Editar_Dados;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as Controller_Endereco;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as Controller_Entidade;
    use Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as Controller_Usuario;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Menu_Usuario;
    
    class Editar_Dados
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Menu_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Editar_Dados($status);
                
                $controller_endereco = new Controller_Endereco();
                $controller_entidade = new Controller_Entidade();
                $controller_usuario = new Controller_Usuario();
                
                $view->set_view_endereco($controller_endereco->Retornar_Pagina());
                $view->set_view_entidade($controller_entidade->Retornar_Pagina());
                $view->set_view_usuario($controller_usuario->Retornar_Pagina());
                
                $view->Executar();
                
                return $status;
            } else {
                return false;
            }
        }
    }
