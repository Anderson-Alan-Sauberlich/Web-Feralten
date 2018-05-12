<?php
namespace Module\Application\View\SRC;
    
    use Module\Application\Model\OBJ\Plano as OBJ_Plano;
    
    class Planos_Mensais
    {
        function __construct()
        {
            
        }
        
        /**
         * Lista array com todos os planos
         *
         * @var array $planos
         */
        private static $planos;
        
        /**
         * Seta Lista array com todos os planos
         *
         * @param array $planos
         */
        public function set_planos(array $planos) : void
        {
            self::$planos = $planos;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Planos_Mensais.php';
        }
        
        /**
         * Retorna o valor do plano.
         * @param int $id
         */
        public static function Mostrar_Valor(int $id) : void
        {
            if (self::$planos[$id] instanceof OBJ_Plano) {
                echo number_format(self::$planos[$id]->get_valor_mensal(), 2, ',', '.');
            }
        }
        
        /**
         * Retorna o limite de peças do plano.
         *
         * @param int $id
         */
        public static function Mostrar_Limite_Pecas(int $id) : void
        {
            if (self::$planos[$id] instanceof OBJ_Plano) {
                echo self::$planos[$id]->get_limite_pecas();
            }
        }
        
        /**
         * Retorna o limite de peças vip do plano.
         *
         * @param int $id
         */
        public static function Mostrar_Limite_Pecas_Vip(int $id) : void
        {
            if (self::$planos[$id] instanceof OBJ_Plano) {
                echo self::$planos[$id]->get_limite_pecas_vip();
            }
        }
    }
