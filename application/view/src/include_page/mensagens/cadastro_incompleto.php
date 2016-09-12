<?php
namespace application\view\src\include_page\mensagens;

    require_once(RAIZ.'/application/controller/include_page/mensagens/cadastro_incompleto.php');
    require_once(RAIZ.'/application/model/object/class_usuario.php');
    
    use application\controller\include_page\mensagens\Cadastro_Inconpleto as Controller_Cadastro_Inconpleto;
    use application\model\object\Usuario;

    @session_start();
	
	new Cadastro_Inconpleto();

    class Cadastro_Inconpleto {
		
        function __construct() {
            
        }
		
        public static function Mostrar_Nome() {
            echo unserialize($_SESSION['usuario'])->get_nome();
        }
    }
?>