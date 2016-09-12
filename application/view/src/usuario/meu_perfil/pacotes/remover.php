<?php
namespace application\view\src\usuario\meu_perfil\pacotes;
    
    @session_start();

    new Remover();

    class Remover {

        function __construct() {
            ob_start();
        }
    }
?>