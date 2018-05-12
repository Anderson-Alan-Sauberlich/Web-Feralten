<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Inicio as View_Inicio;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    
    class Inicio
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Inicio();
            
            $pecas_vip = DAO_Peca::BuscarVips();
            
            if (!empty($pecas_vip) && $pecas_vip != false) {
                $view->set_pecas_vip($pecas_vip);
            }
            
            $view->Executar();
        }
    }
