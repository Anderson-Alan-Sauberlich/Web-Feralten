<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
    @session_start();

    new Atualizar();

    class Atualizar {

        function __construct() {
            ob_start();
        }
    }
?>