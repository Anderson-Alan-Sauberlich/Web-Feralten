<?php
namespace application\view\src\dicas_de_venda;

	@session_start();

    class Apresentacao {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/dicas_de_venda/apresentacao.php';
        }
    }
?>