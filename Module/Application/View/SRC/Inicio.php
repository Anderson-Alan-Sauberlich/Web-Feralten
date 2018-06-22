<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    use Module\Application\View\SRC\Layout\Loader as View_Loader;
    use Module\Application\View\SRC\Layout\Modal\Saindo as View_Saindo;
    use Module\Application\View\SRC\Layout\Elemento\Card_Peca as View_Card_Peca;
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    use Module\Application\Model\OBJ\Orcamento as OBJ_Orcamento;
    
    class Inicio
    {
        function __construct()
        {
            
        }
        
        /**
         * Lista de objetos de peças vip.
         * 
         * @var array
         */
        private static $pecas_vip;
        
        /**
         * Lista dos ultimos orçamentos solicitados.
         * 
         * @var array
         */
        private static $ultimos_orcamentos;
        
        /**
         * Objeto do elemento de orçamento.
         *
         * @var View_Orcamento $view_orcamento
         */
        private static $view_orcamento;
        
        public function set_pecas_vip(array $pecas_vip) : void
        {
            self::$pecas_vip = $pecas_vip;
        }
        
        public function set_ultimos_orcamentos(array $ultimos_orcamentos) : void
        {
            self::$ultimos_orcamentos = $ultimos_orcamentos;
        }
        
        /**
         * Seta objeto do elemento de orçamento.
         *
         * @param View_Orcamento $view_orcamento
         */
        public function set_view_orcamento(View_Orcamento $view_orcamento) : void
        {
            self::$view_orcamento = $view_orcamento;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Inicio.php';
        }
        
        public static function IncluirMenuPesquisa()
        {
            new View_Pesquisa();
        }
        
        public static function CarregarLoader() : void
        {
            $view_loader = new View_Loader();
            
            $view_loader->Executar();
        }
        
        public static function CarregarModalSaindo() : void
        {
            $view_saindo = new View_Saindo();
            
            $view_saindo->Executar();
        }
        
        public static function MostrarCardsPecasVip() : void
        {
            if (!empty(self::$pecas_vip)) {
                foreach (self::$pecas_vip as $peca) {
                    $card_peca = new View_Card_Peca();
                    $card_peca->set_obj_peca($peca);
                    $card_peca->Executar();
                }
            }
        }
        
        public static function MostrarUltimosOrcamentos() : void
        {
            if (!empty(self::$ultimos_orcamentos)) {
                if (self::$view_orcamento instanceof View_Orcamento) {
                    foreach (self::$ultimos_orcamentos as $obj_orcamento) {
                        if ($obj_orcamento instanceof OBJ_Orcamento) {
                            self::$view_orcamento->set_obj_orcamento($obj_orcamento);
                            echo '<div class="column">';
                            self::$view_orcamento->Executar();
                            echo '</div>';
                        }
                    }
                }
            }
        }
    }
