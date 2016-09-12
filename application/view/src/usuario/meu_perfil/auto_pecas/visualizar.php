<?php
namespace application\view\src\usuario\meu_perfil\auto_pecas;
    
	require_once(RAIZ.'/application/controller/usuario/meu_perfil/auto_pecas/visualizar.php');

	use application\controller\usuario\meu_perfil\auto_pecas\Visualizar as Controller_Visualizar;

    @session_start();

    new Visualizar();

    class Visualizar {

        function __construct() {
            ob_start();
        }
        
        public static function Mostrar_Card_Peca() {
        	for ($i = 0; $i <= 5; $i++) {
        		echo "<div class=\"ui raised card\">";
        		echo "<div class=\"content\">";
        		echo "<div class=\"meta\">Nome da Peça</div>";
        		echo "</div>";
        		echo "<div class=\"ui medium bordered image\">";
        		echo "<img src=\"/resources/img/imagem_Indisponivel.png\">";
        		echo "</div>";
        		echo "<div class=\"content\">";
        		echo "<div class=\"header\">Molly</div>";
        		echo "<div class=\"meta\">";
        		echo "<span class=\"date\">Coworker</span>";
        		echo "</div>";
        		echo "<div class=\"description\">";
        		echo "Molly is a personal assistant living in Paris.";
        		echo "</div>";
        		echo "</div>";
        		echo "<div class=\"extra content\">";
        		echo "<span class=\"right floated\">Joined in 2011</span>";
        		echo "<span><i class=\"user icon\"></i>35 Friends</span>";
        		echo "</div>";
        		echo "<div class=\"extra content\">";
        		echo "<div class=\"ui two buttons\">";
        		echo "<div class=\"ui basic green button\">Approve</div>";
        		echo "<div class=\"ui basic red button\">Decline</div>";
        		echo "</div>";
        		echo "</div>";
        		echo "</div>";
        	}
        }
    }
?>