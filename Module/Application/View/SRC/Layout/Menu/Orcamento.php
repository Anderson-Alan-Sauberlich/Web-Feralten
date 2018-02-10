<?php
namespace Module\Application\View\SRC\Layout\Menu;
    
    class Orcamento
    {
        public const MEUS_ORCAMENTOS = 'meus-orcamentos';
        
        public const CAIXA_DE_ENTRADA = 'caixa-de-entrada';
        
        public const RESPONDIDOS = 'respondidos';
        
        public const NAO_TENHO = 'nao-tenho';
        
        function __construct()
        {
            
        }
        
        private static $numero_recebido;
        private static $numero_nao_tenho;
        private static $numero_respondido;
        private static $numero_meus;
        private static $pagina;
        
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
        
        public function set_numero_meus(int $numero_meus) : void
        {
            self::$numero_meus = $numero_meus;
        }
        
        public function set_pagina(string $pagina) : void
        {
            self::$pagina = $pagina;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Menu/Orcamento.php';
        }
        
        public static function MostrarNumeroMeus() : void
        {
            echo self::$numero_meus;
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
        
        public static function MostrarPaginaAtualLink(string $pagina) : void
        {
            if (self::$pagina === $pagina) {
                echo 'active teal link';
            }
        }
        
        public static function MostrarPaginaAtualLabel(string $pagina) : void
        {
            if (self::$pagina === $pagina) {
                echo 'teal left pointing';
            }
        }
    }
