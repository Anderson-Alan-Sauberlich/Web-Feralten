<?php
namespace module\application\view\src\layout\form;
    
    class Contato_Anunciante
    {
    	
        function __construct()
        {
        	
        }
        
        private static $peca_id;
        
        public function set_peca_id(int $peca_id) : void
        {
            self::$peca_id = $peca_id;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/module/application/view/html/layout/form/Contato_Anunciante.php';
        }
        
        public function Mostrar_Peca_Id() : void
        {
            echo self::$peca_id;
        }
    }
