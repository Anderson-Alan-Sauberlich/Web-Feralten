<?php
namespace application\view\src\layout\header;

    class Admin {

        function __construct() {
			
        }
        
        public static function Carregar_Id_Session() : void {
        	echo hash_hmac('sha1', session_id(), sha1(session_id()));
        }
    }
?>