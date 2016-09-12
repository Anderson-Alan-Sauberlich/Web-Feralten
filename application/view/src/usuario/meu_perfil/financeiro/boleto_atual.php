<?php
namespace application\view\src\usuario\meu_perfil\financeiro;
    
    @session_start();

    new Boleto_Atual();

    class Boleto_Atual {

        function __construct() {
            ob_start();
        }
    }
?>