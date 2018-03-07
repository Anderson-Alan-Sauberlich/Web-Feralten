<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Elemento\Vendedor as View_Vendedor;
    
    class Vendedores
    {
        function __construct()
        {
            
        }
        
        /**
         * Lista das intidades.
         * 
         * @var array
         */
        private static $entidades;
        
        /**
         * Seta a lista de entidades.
         * 
         * @param array $entidades
         */
        public function set_entidades(array $entidades) : void
        {
            self::$entidades = $entidades;
        }
        
        /**
         * Chama a pagina html que por sua vez chama todas as function estaticas.
         */
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Vendedores.php';
        }
        
        /**
         * Chama e inclui o codigo fonte dos vendedores que são as entidades.
         * 
         * @param array $entidades
         */
        public static function IncluirElementoVendedor(?array $entidades = null) : void
        {
            if (!empty($entidades)) {
                self::$entidades = $entidades;
            }
            
            if (!empty(self::$entidades)) {
                foreach (self::$entidades as $entidade) {
                    $view_vendedor = new View_Vendedor();
                    
                    $view_vendedor->set_obj_entidade($entidade);
                    
                    $view_vendedor->Executar();
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum vendedor foi encontrado.</label></h2></div>";
            }
        }
    }
