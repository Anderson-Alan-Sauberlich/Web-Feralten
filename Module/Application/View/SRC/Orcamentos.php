<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    use Module\Application\Model\OBJ\Orcamento as OBJ_Orcamento;
    
    class Orcamentos
    {
        function __construct()
        {
            
        }
        
        /**
         * Lista de orçamentos.
         *
         * @var array
         */
        private static $orcamentos;
        
        /**
         * Objeto do elemento de orçamento.
         *
         * @var View_Orcamento $view_orcamento
         */
        private static $view_orcamento;
        
        /**
         * Seta a lista de orçamentos.
         *
         * @param array $orcamentos
         */
        public function set_orcamentos(array $orcamentos) : void
        {
            self::$orcamentos = $orcamentos;
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
        
        /**
         * Chama o arquivo html que por sua vez chama todas as functions staticas da classe.
         */
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Orcamentos.php';
        }
        
        /**
         * Chama o codigo fonte dos elementos dos orçamentos.
         */
        public static function Incluir_Elemento_Orcamento() : void
        {
            if (!empty(self::$orcamentos)) {
                if (self::$view_orcamento instanceof View_Orcamento) {
                    foreach (self::$orcamentos as $obj_orcamento) {
                        if ($obj_orcamento instanceof OBJ_Orcamento) {
                            self::$view_orcamento->set_obj_orcamento($obj_orcamento);
                            self::$view_orcamento->Executar();
                        }
                    }
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum orçamento foi encontrado.</label></h2></div>";
            }
        }
    }
