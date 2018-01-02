<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos as View_Orcamentos;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Orcamentos
    {
        
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Orcamentos($status);
                
                $view->Executar();
            } else {
                return false;
            }
        }
        //TODO Criar foreach no html, e passar o objeto de dentro da array por aparetro para uma function statica, e a function statica retorna o valor com echo no src
    }
