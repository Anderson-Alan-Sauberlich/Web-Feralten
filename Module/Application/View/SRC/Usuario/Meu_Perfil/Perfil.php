<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Perfil
    {
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $num_pecas;
        private static $num_pecas_vip;
        private static $num_limite_pecas;
        private static $num_limite_pecas_vip;
        private static $num_meus_orcamentos;
        private static $num_orcamentos_recebidos;
        
        public function set_num_pecas(int $num_pecas) : void
        {
            self::$num_pecas = $num_pecas;
        }
        
        public function set_num_pecas_vip(int $num_pecas_vip) : void
        {
            self::$num_pecas_vip = $num_pecas_vip;
        }
        
        public function set_num_limite_pecas(int $num_limite_pecas) : void
        {
            self::$num_limite_pecas = $num_limite_pecas;
        }
        
        public function set_num_limite_pecas_vip(int $num_limite_pecas_vip) : void
        {
            self::$num_limite_pecas_vip = $num_limite_pecas_vip;
        }
        
        public function set_num_meus_orcamentos(int $num_meus_orcamentos) : void
        {
            self::$num_meus_orcamentos = $num_meus_orcamentos;
        }
        
        public function set_num_orcamentos_recebidos(int $num_orcamentos_recebidos) : void
        {
            self::$num_orcamentos_recebidos = $num_orcamentos_recebidos;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Perfil.php';
        }
        
        public static function Incluir_Header_Usuario()
        {
            new View_Header_Usuario(self::$status_usuario, ['meu-perfil', 'perfil']);
        }
        
        public static function Incluir_Menu_Usuario()
        {
            new View_Menu_Usuario(self::$status_usuario, ['meu-perfil', 'perfil']);
        }
        
        public static function RetornarNomeUsuario() : ?string
        {
            return Login_Session::get_usuario_nome();
        }
        
        public static function RetornarNumPecas() : string
        {
            if (empty(self::$num_pecas)) {
                return '0';
            } else {
                return self::$num_pecas;
            }
        }
        
        public static function RetornarNumPecasVip() : string
        {
            if (empty(self::$num_pecas_vip)) {
                return '0';
            } else {
                return self::$num_pecas_vip;
            }
        }
        
        public static function RetornarNumLimitePecas() : string
        {
            if (empty(self::$num_limite_pecas)) {
                return '0';
            } else {
                if (self::$num_limite_pecas < 100000) {
                    return self::$num_limite_pecas;
                } else {
                    return 'Sem Limites';
                }
            }
        }
        
        public static function RetornarNumLimitePecasVip() : string
        {
            if (empty(self::$num_limite_pecas_vip)) {
                return '0';
            } else {
                return self::$num_limite_pecas_vip;
            }
        }
        
        public static function RetornarNumMeusOrcamentos() : string
        {
            if (empty(self::$num_meus_orcamentos)) {
                return '0';
            } else {
                return self::$num_meus_orcamentos;
            }
        }
        
        public static function RetornarNumOrcamentosRecebidos() : string
        {
            if (empty(self::$num_orcamentos_recebidos)) {
                return '0';
            } else {
                return self::$num_orcamentos_recebidos;
            }
        }
    }
