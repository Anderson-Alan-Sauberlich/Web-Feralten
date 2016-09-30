<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once(RAIZ.'/application/model/dao/usuario.php');
	require_once(RAIZ.'/application/controller/usuario/login.php');
	require_once(RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/alterar_senha.php');
	require_once(RAIZ.'/application/controller/include_page/menu_usuario.php');
    
    use application\model\dao\Usuario as DAO_Usuario;
	use application\controller\usuario\Login;
    use application\view\src\usuario\meu_perfil\meus_dados\Alterar_Senha as View_Alterar_Senha;
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
	
    @session_start();
    
    class Alterar_Senha {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Menu_Usuario::Verificar_Status_Usuario();
        		
        		new View_Alterar_Senha($status);
        	} else {
        		return false;
        	}
        }
        
        public static function Atualizar_Senha_Usuario() {
        	if (Controller_Menu_Usuario::Verificar_Autenticacao()) {
	            $erros_alterar_senha = array();
	            $alt_campos = array('erro_senha_antiga' =>  "certo", 'erro_senha_nova' => "certo", 'erro_confsenha_nova' => "certo");
	            
	            $senha_antiga_usuario = $_POST["senha_antiga"];
	            $senha_nova_usuario = $_POST["confsenha_nova"] == $_POST['senha_nova'] ? $_POST['senha_nova'] : "erro";
	            
	            if ($_POST['confsenha_nova'] == $_POST['senha_nova']) {
	            	$senha_nova_usuario = $_POST['senha_nova'];
	            } else if (isset($_POST['confsenha_nova']) AND empty($_POST['senha_nova'])) {
	            	$senha_nova_usuario = "erro1";
	            } else if (isset($_POST['senha_nova']) AND empty($_POST['confsenha_nova'])) {
	            	$senha_nova_usuario = "erro2";
	            } else {
	            	$senha_nova_usuario = "erro";
	            }
	            
				if (empty($senha_antiga_usuario)) {
					$erros_alterar_senha[] = "Digite a Senha Antiga";
					$alt_campos['erro_senha_antiga'] = "erro";
				} else {
					$senha = DAO_Usuario::Buscar_Senha_Usuario(unserialize($_SESSION['usuario'])->get_id());
					
					if (!password_verify($senha_antiga_usuario, $senha)) {
						$erros_alterar_senha[] = "Senha Antiga Incorreta";
						$alt_campos['erro_senha_antiga'] = "erro";
					}
				}
				
	            if (empty($senha_nova_usuario)) {
	                $erros_alterar_senha[] = "Informe Uma Nova Senha";
	                $alt_campos['erro_senha_nova'] = "erro";
					$alt_campos['erro_confsenha_nova'] = "erro";
	            } else if ($senha_nova_usuario == "erro") {
	                $erros_alterar_senha[] = "Campos: \"Nova Senha\" e \"Confirmar Nova Senha\", Não estão Iguais.";
	                $alt_campos['erro_senha_nova'] = "erro";
	                $alt_campos['erro_confsenha_nova'] = "erro";
	            } else if ($senha_nova_usuario == "erro1") {
	                $erros_alterar_senha[] = "Preencha o Campo Nova Senha";
	                $alt_campos['erro_senha_nova'] = "erro";
	            } else if ($senha_nova_usuario == "erro2") {
	            	$erros_alterar_senha[] = "Preencha o Campo Comfirmar Nova Senha";
	            	$alt_campos['erro_confsenha_nova'] = "erro";
	            } else if (strlen($senha_nova_usuario) < 8 or strlen($senha_nova_usuario) > 20) {
	                $erros_alterar_senha[] = "A Senha deve ter de 8 até 20 caracteres";
	                $alt_campos['erro_senha_nova'] = "erro";
	                $alt_campos['erro_confsenha_nova'] = "erro";
	            }
	            
	            if (empty($erros_alterar_senha)) {
	            	$senha_nova_usuario = password_hash($senha_nova_usuario, PASSWORD_DEFAULT);
					
	                DAO_Usuario::Atualizar_Senha($senha_nova_usuario, unserialize($_SESSION['usuario'])->get_id());
	                
					Login::Autenticar_Usuario_Logado(unserialize($_SESSION['usuario'])->get_email(), $senha_nova_usuario);
					
					return 'certo';
	            } else {
	                $_SESSION['erros_alterar_senha'] = $erros_alterar_senha;
					$_SESSION['alt_campos'] = $alt_campos;
					
					$form_alterar_senha = array();
						
					$form_alterar_senha['senha_antiga'] = $_POST['senha_antiga'];
					$form_alterar_senha['senha_nova'] = $_POST['senha_nova'];
					$form_alterar_senha['confsenha_nova'] = $_POST['confsenha_nova'];
						
					$_SESSION['form_alterar_senha'] = $form_alterar_senha;
					
					return 'erro';
	            }
        	} else {
        		return false;
        	}
        }
    }
?>