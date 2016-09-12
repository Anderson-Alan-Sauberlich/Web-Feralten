<?php
namespace application\view\src\usuario\meu_perfil\pacotes;
    
    @session_start();

    new Meus_Pacotes();

    class Meus_Pacotes {

        function __construct() {
            ob_start();
        }
    }
?>