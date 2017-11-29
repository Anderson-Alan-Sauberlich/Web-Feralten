<?php
namespace Module\Administration\View\SRC\Layout\Header;

    class Admin
    {
        
        function __construct()
        {
			
        }
        
        public static function Carregar_Id_Session() : void
        {
        	echo hash_hmac('sha1', session_id(), sha1(session_id()));
        }
    }
