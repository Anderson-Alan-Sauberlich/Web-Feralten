<?php
namespace application\view\src\pecas;

	@session_start();

    class Descricao {

        function __construct() {
        	
        }
        
        public function Executar() {
        	require_once RAIZ.'/application/view/html/pecas/descricao.php';
        }
    }
?>