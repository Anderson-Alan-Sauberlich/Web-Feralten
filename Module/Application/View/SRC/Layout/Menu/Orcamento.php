<?php
namespace Module\Application\View\SRC\Layout\Menu;
    
    class Orcamento
    {
        function __construct()
        {
            
        }
        
        private static $numero_recebido;
        private static $numero_nao_tenho;
        private static $numero_respondido;
        
        public function set_numero_recebidos(int $numero_recebidos) : void
        {
            self::$numero_recebido = $numero_recebidos;
        }
        
        public function set_numero_nao_tenho(int $numero_nao_tenho) : void
        {
            self::$numero_nao_tenho = $numero_nao_tenho;
        }
        
        public function set_numero_respondido(int $numero_respondido) : void
        {
            self::$numero_respondido = $numero_respondido;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Menu/Orcamento.php';
        }
        
        public static function MostrarNumeroRecebido() : void
        {
            echo self::$numero_recebido;
        }
        
        public static function MostrarNumeroNaoTenho() : void
        {
            echo self::$numero_nao_tenho;
        }
        
        public static function MostrarNumeroRespondido() : void
        {
            echo self::$numero_respondido;
        }
    }
