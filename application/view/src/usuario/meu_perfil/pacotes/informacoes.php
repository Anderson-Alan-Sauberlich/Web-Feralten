<?php
namespace application\view\src\usuario\meu_perfil\pacotes;
    
    @session_start();

    new Informacoes();

    class Informacoes {

        function __construct() {
            ob_start();
        }
    }
?>