<?php
namespace application\view\src\dicas_de_venda;
	
	@session_start();
	
    class Venda_Segura {

        function __construct() {
        	require_once RAIZ.'/application/view/html/dicas_de_venda/venda_segura.php';
        }
    }
?>