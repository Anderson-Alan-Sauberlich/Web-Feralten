<?php
namespace Module\Application\View\SRC\Layout\Menu;
    
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    
    class Usuario
    {
        
        private static $status_usuario;
        private static $url_menu;

        function __construct(int $status, array $url)
        {
            self::$status_usuario = $status;
            self::$url_menu = $url;
            
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Menu/Usuario.php';
        }
        
        public static function Mostrar_Nome() : void
        {
            echo Controller_Usuario::Mostrar_Nome();
        }
        
        public static function Incluir_Mensagem_Status_Usuario() : void
        {
            if (self::$status_usuario !== null) {
                if (self::$status_usuario === 0 
                    AND self::$url_menu[1] !== 'concluir'
                    AND self::$url_menu[1] !== 'alterar-senha'
                    AND self::$url_menu[1] !== 'meus-orcamentos') {
                    include_once RAIZ.'/Module/Application/View/HTML/Layout/Mensagens/Cadastro_Incompleto.php';
                } else if (self::$status_usuario === 1) {
            
                } else if (self::$status_usuario === 2) {
                    include_once RAIZ.'/Module/Application/View/HTML/Layout/Mensagens/Pagamento_Atrasado.php';
                } else if (self::$status_usuario === 3) {
                    include_once RAIZ.'/Module/Application/View/HTML/Layout/Mensagens/Conta_Desativada.php';
                }
            }
        }
        
        public static function Verificar_URL_Ativa(string $id_tab, ?string $id_pill = null) : void
        {
            $class = '';
            
            if (self::$url_menu[0] === $id_tab) {
                $class = 'active';
                
                if (isset($id_pill)) {
                    if (self::$url_menu[1] !== $id_pill) {
                        $class = '';
                    }
                }
            }
            
            if ($id_pill === 'concluir' AND self::$status_usuario !== 0) {
                $class = 'disabled';
            }
            
            echo $class;
        }
    }
