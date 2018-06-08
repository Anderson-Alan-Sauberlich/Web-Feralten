<?php
namespace Module\Application\View\SRC\Layout\Form;
    
    class Contato_Anunciante
    {
        function __construct()
        {
            
        }
        
        private static $peca_id;
        private static $nome;
        private static $email;
        private static $telefone;
        private static $whatsapp;
        private static $mensagem;
        
        public function set_peca_id(int $peca_id) : void
        {
            self::$peca_id = $peca_id;
        }
        
        public function set_nome(?string $nome) : void
        {
            self::$nome = $nome;
        }
        
        public function set_email(?string $email) : void
        {
            self::$email = $email;
        }
        
        public function set_telefone(?string $telefone) : void
        {
            self::$telefone = $telefone;
        }
        
        public function set_whatsapp(?bool $whatsapp) : void
        {
            self::$whatsapp = $whatsapp;
        }
        
        public function set_mensagem(?string $mensagem) : void
        {
            self::$mensagem = $mensagem;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Form/Contato_Anunciante.php';
        }
        
        public function Mostrar_Peca_Id() : void
        {
            echo self::$peca_id;
        }
        
        public static function RetornarUsuarioNome() : ?string
        {
            return self::$nome;
        }
        
        public static function RetornarUsuarioEmail() : ?string
        {
            return self::$email;
        }
        
        public static function RetornarUsuarioTelefone() : ?string
        {
            return self::$telefone;
        }
    }
