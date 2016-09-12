<?php
namespace application\view\src\usuario\meu_perfil\financeiro;
    
    @session_start();

    new Boletos_Pagos();

    class Boletos_Pagos {

        function __construct() {
            ob_start();
        }
    }
?>