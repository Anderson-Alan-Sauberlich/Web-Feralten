<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
        
    class Orcamento
    {
        function __construct()
        {
            
        }
        
        private static $obj_orcamento;
        
        public function set_obj_orcamento(Object_Orcamento $obj_orcamento) : void
        {
            self::$obj_orcamento = $obj_orcamento;
        }
        
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Orcamento.php';
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
    }
