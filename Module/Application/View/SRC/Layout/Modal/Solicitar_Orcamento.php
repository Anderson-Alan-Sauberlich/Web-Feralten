<?php
namespace Module\Application\View\SRC\Layout\Modal;
    
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Solicitar_Orcamento
    {
        function __construct()
        {
            
        }
        
        /**
         * Armazena o valor se o Modal é pra ser aberto de forma automatica.
         * 
         * @var bool
         */
        private static $abrir_autocaticamente = false;
        
        /**
         * Seta a informação se o modal é pra ser aberto de forma automatica.
         * 
         * @param bool $abrir_autocaticamente
         */
        public function set_abrir_autocaticamente(bool $abrir_autocaticamente) : void
        {
            self::$abrir_autocaticamente = $abrir_autocaticamente;
        }
        
        /**
         * Chama a view html que chama todas as variaveis estaticas.
         */
        public static function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Modal/Solicitar_Orcamento.php';
        }
        
        /**
         * Verifica se o usuario está logado.
         * 
         * @return bool|NULL
         */
        public static function Verificar_Logado() : ?bool
        {
            return Login_Session::Verificar_Login();
        }
        
        /**
         * Verifica se o modal deve ser aberto automaticamente.
         * 
         * @return bool
         */
        public static function Verificar_Abertura_Autocatica() : bool
        {
            return self::$abrir_autocaticamente;
        }
        
        /**
         * Mostra o comando hidden para esconder o elemente na classe se o usuario não estiver logado.
         */
        public static function Esconder_Orcamento() : void
        {
            if (!self::Verificar_Logado()) {
                echo 'hidden';
            }
        }
    }
