<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Planos_Mensais as View_Planos_Mensais;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    
    class Planos_Mensais
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Planos_Mensais();
            
            $planos = DAO_Plano::BuscarTodos();
            
            if (!empty($planos) AND $planos != false) {
                $view->set_planos($planos);
            }
            
            $view->Executar();
        }
    }
