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
        
        public static function Mostrar_ID() : ?int
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_id();
            } else {
                return null;
            }
        }
        
        public static function Mostrar_Nome() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_peca_nome();
            } else {
                return null;
            }
        }
        
        public static function Mostrar_CMMV() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_categoria()->get_nome().', '.
                       self::$obj_orcamento->get_marca()->get_nome().', '.
                       self::$obj_orcamento->get_modelo()->get_nome().', '.
                       self::$obj_orcamento->get_versao()->get_nome();
            } else {
                return null;
            }
        }
        
        public static function Retornar_Pecas() : ?array
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_pecas();
            }
        }
        
        public static function Mostrar_Anos() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return 'Ano: de '.self::$obj_orcamento->get_ano_de().' até '.self::$obj_orcamento->get_ano_ate();
            } else {
                return null;
            }
        }
        
        public static function Mostrar_Descricao() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_descricao();
            } else {
                return null;
            }
        }
        
        public static function Verificar_Desativar_Botao() : ?string
        {
            if (self::$pagina === self::NAO_TENHO) {
                return 'disabled';
            } else {
                return null;
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
        
        public static function Verificar_Mostrar_Botoes() : bool
        {
            if (self::$pagina === self::MEUS_ORCAMENTOS) {
                return false;
            } else {
                return true;
            }
        }
    }
