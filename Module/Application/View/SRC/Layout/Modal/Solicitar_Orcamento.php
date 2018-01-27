<?php
namespace Module\Application\View\SRC\Layout\Modal;
    
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Solicitar_Orcamento
    {
        function __construct()
        {
            
        }
        
        public static function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Modal/Solicitar_Orcamento.php';
        }
        
        public static function Verificar_Logado() : ?bool
        {
            return Login_Session::Verificar_Login();
        }
        
        public static function Esconder_Orcamento() : void
        {
            if (!self::Verificar_Logado()) {
                echo 'hidden';
            }
        }
    }
