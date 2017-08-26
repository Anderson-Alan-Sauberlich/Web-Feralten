<?php
namespace application\view\src\pecas;
    
    use application\model\object\Peca as Object_Peca;
    
    class Detalhes {

        function __construct() {
        	
        }
        
        private static $object_peca;
        private static $categorias_pativeis;
        private static $marcas_pativeis;
        private static $modelos_pativeis;
        private static $versoes_pativeis;
        
        public function set_object_peca(Object_Peca $object_peca) : void {
            self::$object_peca = $object_peca;
        }
        
        public function set_categorias_pativeis(array $categorias_pativeis) : void {
            self::$categorias_pativeis = $categorias_pativeis;
        }
        
        public function set_marcas_pativeis(array $marcas_pativeis) : void {
            self::$marcas_pativeis = $marcas_pativeis;
        }
        
        public function set_modelos_pativeis(array $modelos_pativeis) : void {
            self::$modelos_pativeis = $modelos_pativeis;
        }
        
        public function set_versoes_pativeis(array $versoes_pativeis) : void {
            self::$versoes_pativeis = $versoes_pativeis;
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
        
        public static function Mostrar_Foto(int $numero, string $tamanho) : void {
            if (empty(self::$object_peca->get_foto($numero)) OR self::$object_peca->get_foto($numero) == false) {
                echo '/application/view/resources/img/imagem_indisponivel.png';
            } else {
                echo str_replace('@', $tamanho, self::$object_peca->get_foto($numero)->get_endereco());
            }
        }
        
        public static function Mostrar_Pativeis() : void {
            if (!empty(self::$categorias_pativeis) AND self::$categorias_pativeis != false) {
                foreach (self::$categorias_pativeis as $categoria_pativel) {
                    echo $categoria_pativel->get_object_categoria()->get_nome().'/';
                    
                    if (!empty(self::$marcas_pativeis) AND self::$marcas_pativeis != false) {
                        foreach (self::$marcas_pativeis as $marca_pativel) {
                            echo $marca_pativel->get_object_marca()->get_nome().'/';
                            
                            if (!empty(self::$modelos_pativeis) AND self::$modelos_pativeis != false) {
                                foreach (self::$modelos_pativeis as $modelo_pativel) {
                                    echo $modelo_pativel->get_object_modelo()->get_nome().'/';
                                    
                                    if (!empty(self::$versoes_pativeis) AND self::$versoes_pativeis != false) {
                                        foreach (self::$versoes_pativeis as $versao_pativel) {
                                            echo $versao_pativel->get_object_versao()->get_nome();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>