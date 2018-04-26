<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    use Module\Application\View\SRC\Layout\Elemento\Fatura as View_Fatura;
    
    class Historico
    {
        /**
         * Seta por paramelhor o codigo do status do usuario.
         * 
         * @param int $status
         */
        function __construct($status)
        {
            self::$status_usuario = $status;
        }
        
        /**
         * Codigo do status do usuario.
         * 
         * @var int $status_usuario
         */
        private static $status_usuario;
        
        /**
         * Lista de faturas.
         *
         * @var array $faturas
         */
        private static $faturas;
        
        /**
         * Seta a lista de faturas.
         *
         * @param array $faturas
         */
        public function set_faturas(array $faturas) : void
        {
            self::$faturas = $faturas;
        }
        
        /**
         * Chama a pagina html que por sua vez chama todas as function estaticas.
         */
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Historico.php';
        }
        
        /**
         * Chama e inclui o codigo fonte do header do usuario header.
         */
        public static function Incluir_Header_Usuario()
        {
            new View_Header_Usuario(self::$status_usuario, ['financeiro', 'historico']);
        }
        
        /**
         * Chama e inclie o codigo fonte do menu do usuario header.
         */
        public static function Incluir_Menu_Usuario()
        {
            new View_Menu_Usuario(self::$status_usuario, ['financeiro', 'historico']);
        }
        
        /**
         * Chama e inclui o codigo dos elementos das faturas.
         *
         * @param ?array $faturas
         */
        public static function Incluir_Elemento_Fatura(?array $faturas = null) : void
        {
            if (!empty($faturas)) {
                self::$faturas = $faturas;
            }
            
            if (!empty(self::$faturas)) {
                foreach (self::$faturas as $obj_fatura) {
                    $view_fatura = new View_Fatura();
                    
                    $view_fatura->set_obj_fatura($obj_fatura);
                    $view_fatura->set_pagina(View_Fatura::HISTORICO);
                    
                    $view_fatura->Executar();
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhuma fatura foi encontrada.</label></h2></div>";
            }
        }
    }
