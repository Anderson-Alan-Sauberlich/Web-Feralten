<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\View\SRC\Layout\Form\Contato as View_Contato;
    
    class Perguntas_Frequentes
    {
        function __construct()
        {
            
        }
        
        /**
         *
         * @var View_Contato
         */
        private static $view_contato;
        
        /**
         * Seta o objeto do form contato.
         *
         * @param View_Contato $view_contato_anunciante
         */
        public function set_view_contato(View_Contato $view_contato) : void
        {
            self::$view_contato = $view_contato;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Perguntas_Frequentes.php';
        }
        
        public static function Incluir_Form_Contato() : void
        {
            if (self::$view_contato instanceof View_Contato) {
                self::$view_contato->Executar();
            }
        }
    }
