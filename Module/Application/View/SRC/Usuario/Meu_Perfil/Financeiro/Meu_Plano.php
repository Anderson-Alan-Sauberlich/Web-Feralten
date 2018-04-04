<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    use Module\Application\Model\OBJ\Plano as OBJ_Plano;
    
    class Meu_Plano
    {
        function __construct($status)
        {
            self::$status_usuario = $status;
        }
        
        /**
         * Id codigo do status do usuario.
         * 
         * @var int $status_usuario
         */
        private static $status_usuario;
        
        /**
         * Lista array com todos os planos
         * 
         * @var array $planos
         */
        private static $planos;
        
        /**
         * ID do plano ativo.
         * 
         * @var int $plano_id
         */
        private static $plano_id;
        
        /**
         * Seta Lista array com todos os planos
         * 
         * @param array $planos
         */
        public function set_planos(array $planos) : void
        {
            self::$planos = $planos;
        }
        
        /**
         * Seta ID do plano ativo.
         * 
         * @param int $plano_id
         */
        public function set_plano_id(int $plano_id) : void
        {
            self::$plano_id = $plano_id;
        }
        
        /**
         * Chama a pagina view_SRC de forma estatica e atravez das function retorna os valores nescessarios.
         */
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Meu_Plano.php';
        }
        
        /**
         * Chama o Header do usuario.
         */
        public static function Incluir_Header_Usuario()
        {
            new View_Header_Usuario(self::$status_usuario, ['financeiro', 'meu-plano']);
        }
        
        /**
         * Chama o menu do usuario.
         */
        public static function Incluir_Menu_Usuario()
        {
            new View_Menu_Usuario(self::$status_usuario, ['financeiro', 'meu-plano']);
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
         * Verifica se é o plano ativo.
         * 
         * @param int $id
         */
        public static function Mostrar_Class_Plano_Ativo(int $id) : void
        {
            if (self::$plano_id === $id) {
                echo 'inverted green active';
            }
        }
        
        /**
         * Verifica se é o plano ativo e seta o texto do botão conforma nescesario.
         * 
         * @param int $id
         */
        public static function Mostrar_Texto_Plano_Ativo(int $id) : void
        {
            if (self::$plano_id === $id) {
                echo 'Ativo';
            } else {
                echo 'Contratar';
            }
        }
    }
