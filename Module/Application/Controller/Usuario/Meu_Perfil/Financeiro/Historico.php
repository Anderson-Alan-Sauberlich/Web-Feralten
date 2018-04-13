<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Historico as View_Historico;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\Common\Util\Login_Session;
    
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
                    
                    $faturas = DAO_Fatura::BuscarPorCodStatus(Login_Session::get_entidade_id(), 4, 8, 64);
                    
                    if (!empty($faturas) && $faturas != false) {
                        $view->set_faturas($faturas);
                    }
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
