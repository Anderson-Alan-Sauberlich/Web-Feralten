<?php
namespace Module\Application\View\SRC\Layout\Header;
    
    use Module\Application\View\SRC\Layout\Header\Cabecalho as View_Cabecalho;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Usuario
    {
        private static $status_usuario;
        private static $url_menu;
        
        function __construct(int $status, array $url)
        {
            self::$status_usuario = $status;
            self::$url_menu = $url;
            
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Usuario.php';
        }
        
        public static function Incluir_Mensagem_Status_Usuario() : void
        {
            if (self::$status_usuario !== null) {
                if (self::$status_usuario === 0 
                    AND self::$url_menu[1] !== 'alterar-senha'
                    AND self::$url_menu[1] !== 'meus-orcamentos'
                    AND self::$url_menu[1] !== 'editar-dados') {
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
                
                if (!empty($id_pill)) {
                    if (self::$url_menu[1] !== $id_pill) {
                        $class = '';
                    }
                }
            }
            
            echo $class;
        }
        
        public static function MostrarCodigoLogout() : void
        {
            echo View_Cabecalho::RetornarCodigoLogout();
        }
        
        public static function RetornarImagemEntidade() : ?string
        {
            if (!empty(Login_Session::get_entidade_imagem())) {
                return str_replace("@", "200x150", Login_Session::get_entidade_imagem());
            } else {
                return '/resources/img/imagem_indisponivel.png';
            }
        }
    }
