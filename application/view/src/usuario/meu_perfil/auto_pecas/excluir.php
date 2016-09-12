<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
    @session_start();

    new Excluir();

    class Excluir {

        function __construct() {
            ob_start();
        }
    }
?>