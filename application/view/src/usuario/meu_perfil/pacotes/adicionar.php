<?php
namespace application\view\src\usuario\meu_perfil\pacotes;
    
    @session_start();

    new Adicionar();

    class Adicionar {

        function __construct() {
            ob_start();
        }
    }
?>