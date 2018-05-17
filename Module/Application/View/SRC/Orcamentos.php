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
         * Seta a lista de orçamentos.
         *
         * @param array $orcamentos
         */
        public function set_orcamentos(array $orcamentos) : void
        {
            self::$orcamentos = $orcamentos;
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
         *
         * @param array $orcamentos
         */
        public static function Incluir_Elemento_Orcamento(?array $orcamentos = null) : void
        {
            if (!empty($orcamentos)) {
                self::$orcamentos = $orcamentos;
            }
            
            if (!empty(self::$orcamentos)) {
                foreach (self::$orcamentos as $obj_orcamento) {
                    if ($obj_orcamento instanceof OBJ_Orcamento) {
                        $view_orcamento = new View_Orcamento();
                        
                        $view_orcamento->set_obj_orcamento($obj_orcamento);
                        $view_orcamento->set_pagina(View_Orcamento::ORCAMENTOS);
                        
                        $view_orcamento->Executar();
                    }
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum orçamento foi encontrado.</label></h2></div>";
            }
        }
    }
