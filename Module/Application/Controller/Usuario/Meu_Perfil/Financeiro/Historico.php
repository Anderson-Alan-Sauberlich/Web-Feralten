<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Historico as View_Historico;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    
    class Historico
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
        
                if ($status != 0) {
                    $view = new View_Historico($status);
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
