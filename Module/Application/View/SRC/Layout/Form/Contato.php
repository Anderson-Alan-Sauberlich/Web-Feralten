<?php
namespace Module\Application\View\SRC\Layout\Form;
    
    class Contato
    {
        function __construct()
        {
            
        }
        
        /**
         * 
         * @var string
         */
        private static $nome;
        
        /**
         * 
         * @var string
         */
        private static $email;
        
        /**
         * 
         * @var string
         */
        private static $telefone;
        
        /**
         * 
         * @var bool
         */
        private static $whatsapp;
        
        /**
         * 
         * @var string
         */
        private static $mensagem;
        
        /**
         * 
         * @param string $nome
         */
        public function set_nome(?string $nome) : void
        {
            self::$nome = $nome;
        }
        
        /**
         * 
         * @param string $email
         */
        public function set_email(?string $email) : void
        {
            self::$email = $email;
        }
        
        /**
         * 
         * @param string $telefone
         */
        public function set_telefone(?string $telefone) : void
        {
            self::$telefone = $telefone;
        }
        
        /**
         * 
         * @param bool $whatsapp
         */
        public function set_whatsapp(?bool $whatsapp) : void
        {
            self::$whatsapp = $whatsapp;
        }
        
        /**
         * 
         * @param string $mensagem
         */
        public function set_mensagem(?string $mensagem) : void
        {
            self::$mensagem = $mensagem;
        }
        
        /**
         * Chama a view html que chama todas as variaveis staticas.
         */
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Form/Contato.php';
        }
        
        /**
         *
         * @return string|NULL
         */
        public static function RetornarUsuarioNome() : ?string
        {
            return self::$nome;
        }
        
        /**
         *
         * @return string|NULL
         */
        public static function RetornarUsuarioEmail() : ?string
        {
            return self::$email;
        }
        
        /**
         *
         * @return string|NULL
         */
        public static function RetornarUsuarioTelefone() : ?string
        {
            return self::$telefone;
        }
    }
