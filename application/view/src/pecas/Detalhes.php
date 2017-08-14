<?php
namespace application\view\src\pecas;
    
    use application\model\object\Peca as Object_Peca;
    
    class Detalhes {

        function __construct() {
        	
        }
        
        private static $object_peca;
        
        public function set_object_peca(Object_Peca $object_peca) : void {
            self::$object_peca = $object_peca;
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pecas/Detalhes.php';
        }
        
        public static function Mostrar_Nome() : void {
            echo self::$object_peca->get_nome();
        }
        
        public static function Mostrar_Fabricante() : void {
            if (empty(self::$object_peca->get_fabricante()) OR self::$object_peca->get_fabricante() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_fabricante();
            }
        }
        
        public static function Mostrar_Preco() : void {
            if (empty(self::$object_peca->get_preco()) OR self::$object_peca->get_preco() == false) {
                echo 'a negociar';
            } else {
                echo self::$object_peca->get_preco();
            }
        }
        
        public static function Mostrar_Estado_Uso() : void {
            if (empty(self::$object_peca->get_estado_uso()) OR self::$object_peca->get_estado_uso() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_estado_uso()->get_nome();
            }
        }
        
        public static function Mostrar_Serie() : void {
            if (empty(self::$object_peca->get_serie()) OR self::$object_peca->get_serie() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_serie();
            }
        }
        
        public static function Mostrar_Descricao() : void {
            if (empty(self::$object_peca->get_descricao()) OR self::$object_peca->get_descricao() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_descricao();
            }
        }
    }
?>