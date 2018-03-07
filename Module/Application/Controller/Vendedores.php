<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Vendedores as View_Vendedores;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    
    class Vendedores
    {
        function __construct()
        {
            
        }
        
        /**
         * Chama e uma nova view que carrega a pagina com a lista de todas as entidades|Vendedores.
         */
        public function Carregar_Pagina()
        {
            $view = new View_Vendedores();
            
            $view->set_entidades(DAO_Entidade::BuscarVendedores());
            
            $view->Executar();
        }
    }
