<?php
namespace application\view\src\include_page\mensagens;

    require_once RAIZ.'/application/controller/include_page/mensagens/cadastro_incompleto.php';
    
    use application\controller\include_page\mensagens\Cadastro_Inconpleto as Controller_Cadastro_Inconpleto;

    class Cadastro_Inconpleto {
		
        function __construct() {
            
        }
		
        public static function Mostrar_Nome() : void {
            echo Controller_Cadastro_Inconpleto::Mostrar_Nome();
        }
    }
?>