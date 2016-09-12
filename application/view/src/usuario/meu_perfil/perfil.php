<?php
namespace application\view\src\usuario\meu_perfil;
    
    @session_start();

    new Perfil();

    class Perfil {

        function __construct() {
            ob_start();
        }
    }
?>