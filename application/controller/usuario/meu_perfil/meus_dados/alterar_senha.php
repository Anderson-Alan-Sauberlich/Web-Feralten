<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

    require_once RAIZ.'/application/model/dao/usuario.php';
	require_once RAIZ.'/application/controller/usuario/login.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/alterar_senha.php';
	require_once RAIZ.'/application/controller/include_page/menu_usuario.php';
    
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
	            $alt_campos = array('erro_senha_antiga' =>  "certo", 'erro_senha_nova' => "certo", 'erro_senha_confnova' => "certo");
	            
			    $senha_antiga = null;
			    $senha_nova = null;
			    
			    if (empty($_POST['senha_antiga'])) {
			    	$erros_alterar_senha[] = "Digite a Senha Antiga";
			    	$alt_campos['erro_senha_antiga'] = "erro";
			    } else {
			    	$senha_usuario = DAO_Usuario::Buscar_Senha_Usuario(unserialize($_SESSION['usuario'])->get_id());
			    		
			    	if (!password_verify($senha_antiga, $senha_usuario)) {
			    		$erros_alterar_senha[] = "Senha Antiga Incorreta";
			    		$alt_campos['erro_senha_antiga'] = "erro";
			    	}
			    }
	            
	            if (empty($_POST['senha_nova']) OR empty($_POST['senha_confnova'])) {
	            	if (empty($_POST['senha_nova'])) {
	            		$erros_alterar_senha[] = "Preencha o Campo Nova Senha";
	            		$alt_campos['erro_senha_nova'] = "erro";
	            	}
	            	
	            	if (empty($_POST['senha_confnova'])) {
	            		$erros_alterar_senha[] = "Preencha o Campo Confirmar Nova Senha";
	            		$alt_campos['erro_senha_confnova'] = "erro";
	            	}
	            } else {
	            	if ($_POST['senha_nova'] === $_POST['senha_confnova']) {
		            	if (strlen($_POST['senha_nova']) >= 6 AND strlen($_POST['senha_nova']) <= 20) {
		            		$password = strip_tags($_POST['senha_nova']);
		            		 
		            		if ($password === $_POST['senha_nova']) {
		            			$senha_nova = $password;
		            		} else {
		            			$erros_cadastrar[] = "A Senha Não pode conter Tags de Programação";
		            			$cad_campos['erro_senha'] = "erro";
		            		}
		            	} else {
		            		$erros_cadastrar[] = "A Senha Deve conter de 6 a 20 caracteres";
		            		$cad_campos['erro_senha'] = "erro";
		            	}
	            	} else {
	            		$erros_alterar_senha[] = "Campos: \"Nova Senha\" e \"Confirmar Nova Senha\", Não estão Iguais.";
	            		$alt_campos['erro_senha_nova'] = "erro";
	            		$alt_campos['erro_senha_confnova'] = "erro";
	            	}
	            }
	            
	            if (empty($erros_alterar_senha)) {
	            	$senha_nova = password_hash($senha_nova, PASSWORD_DEFAULT);
					
	                DAO_Usuario::Atualizar_Senha($senha_nova, unserialize($_SESSION['usuario'])->get_id());
	                
					Login::Autenticar_Usuario_Logado(unserialize($_SESSION['usuario'])->get_email(), $senha_nova);
					
					return 'certo';
	            } else {
	                $_SESSION['erros_alterar_senha'] = $erros_alterar_senha;
					$_SESSION['alt_campos'] = $alt_campos;
					
					$form_alterar_senha = array();
						
					$form_alterar_senha['senha_antiga'] = strip_tags($_POST['senha_antiga']);
					$form_alterar_senha['senha_nova'] = strip_tags($_POST['senha_nova']);
					$form_alterar_senha['senha_confnova'] = strip_tags($_POST['senha_confnova']);
						
					$_SESSION['form_alterar_senha'] = $form_alterar_senha;
					
					return 'erro';
	            }
        	} else {
        		return false;
        	}
        }
    }
?>