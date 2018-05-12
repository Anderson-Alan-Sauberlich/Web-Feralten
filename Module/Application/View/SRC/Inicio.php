<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    use Module\Application\View\SRC\Layout\Loader as View_Loader;
    use Module\Application\View\SRC\Layout\Modal\Saindo as View_Saindo;
    use Module\Application\View\SRC\Layout\Elemento\Card_Peca as View_Card_Peca;
    
    class Inicio
    {
        function __construct()
        {
            
        }
        
        private static $pecas_vip;
        
        public function set_pecas_vip($pecas_vip) : void
        {
            self::$pecas_vip = $pecas_vip;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Inicio.php';
        }
        
        public static function Incluir_Menu_Pesquisa()
        {
            new View_Pesquisa();
        }
        
        public static function Carregar_Loader() : void
        {
            $view_loader = new View_Loader();
            
            $view_loader->Executar();
        }
        
        public static function Carregar_Modal_Saindo() : void
        {
            $view_saindo = new View_Saindo();
            
            $view_saindo->Executar();
        }
        
        public static function Mostrar_Cards_Pecas_Vip()
        {
            if (!empty(self::$pecas_vip)) {
                foreach (self::$pecas_vip as $peca) {
                    $card_peca = new View_Card_Peca();
                    
                    $card_peca->set_obj_peca($peca);
                    
                    $card_peca->Executar($peca);
                }
            }
        }
    }
