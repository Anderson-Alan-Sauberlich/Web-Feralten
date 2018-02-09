<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
        
    class Orcamento
    {
        public const MEUS_ORCAMENTOS = 'meus-orcamentos';
        
        public const CAIXA_DE_ENTRADA = 'caixa-de-entrada';
        
        public const RESPONDIDOS = 'respondidos';
        
        public const NAO_TENHO = 'nao-tenho';
        
        function __construct()
        {
            
        }
        
        private static $obj_orcamento;
        private static $pagina;
        
        public function set_obj_orcamento(Object_Orcamento $obj_orcamento) : void
        {
            self::$obj_orcamento = $obj_orcamento;
        }
        
        public function set_pagina(string $pagina) : void
        {
            self::$pagina = $pagina;
        }
        
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Orcamento.php';
        }
        
        public static function Mostrar_ID() : void
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                echo self::$obj_orcamento->get_id();
            }
        }
        
        public static function Mostrar_Nome() : void
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                echo self::$obj_orcamento->get_peca_nome();
            }
        }
        
        public static function Mostrar_CMMV() : void
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                echo self::$obj_orcamento->get_categoria()->get_nome().', '
                    .self::$obj_orcamento->get_marca()->get_nome().', '
                    .self::$obj_orcamento->get_modelo()->get_nome().', '
                    .self::$obj_orcamento->get_versao()->get_nome();
            }
        }
        
        public static function Mostrar_Anos() : void
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                echo 'Ano: de '.self::$obj_orcamento->get_ano_de().' até '.self::$obj_orcamento->get_ano_ate();
            }
        }
        
        public static function Mostrar_Descricao() : void
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                echo self::$obj_orcamento->get_descricao();
            }
        }
        
        public static function Verificar_Desativar_Botao() : void
        {
            if (self::$pagina === self::NAO_TENHO) {
                echo 'disabled';
            }
        }
        
        public static function Verificar_Mostrar_ListaPecas() : bool
        {
            if (self::$pagina === self::RESPONDIDOS ||
                self::$pagina === self::MEUS_ORCAMENTOS) {
                return true;
            } else {
                return false;
            }
        }
    }
