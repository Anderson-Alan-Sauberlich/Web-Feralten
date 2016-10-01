<?php
namespace application\controller\usuario;

    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/controller/usuario/login.php';
    require_once RAIZ.'/application/view/src/usuario/cadastro.php';

    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\Login;
    use application\view\src\usuario\Cadastro as View_Cadastro;
    
    @session_start();

    class Cadastro {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Cadastro();
        }

        public function Cadastrar_Usuario() {
            $erros_cadastrar = array();
            $cad_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' => "certo", 'erro_senha' => "certo");

            $usuario = new Object_Usuario();
            
            $usuario->set_id(0);
            $usuario->set_nome($_POST['nome']);
            $usuario->set_senha($_POST['password']);
            $usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	
            if ($_POST['confemail'] == $_POST['email']) {
            	$usuario->set_email($_POST['email']);
            } else if (isset($_POST['confemail']) AND empty($_POST['email'])) {
            	$usuario->set_email("erro1");
            } else if (isset($_POST['email']) AND empty($_POST['confemail'])) {
            	$usuario->set_email("erro2");
            } else {
            	$usuario->set_email("erro");
            }
            
            if (empty($usuario->get_nome())) {
                $erros_cadastrar[] = "Digite seu Nome Completo";
                $cad_campos['erro_nome'] = "erro";
            }
			
            if (empty($usuario->get_email())) {
                $erros_cadastrar[] = "Digite seu Email";
                $cad_campos['erro_email'] = "erro";
				$cad_campos['erro_confemail'] = "erro";
            } else if ($usuario->get_email() == "erro") {
                $erros_cadastrar[] = "Digite o E-Mails Duas Vezes Igualmente";
                $cad_campos['erro_email'] = "erro";
                $cad_campos['erro_confemail'] = "erro";
            } else if ($usuario->get_email() == "erro1") {
                $erros_cadastrar[] = "Preencha o Campo E-Mail";
                $cad_campos['erro_email'] = "erro";
            } else if ($usuario->get_email() == "erro2") {
            	$erros_cadastrar[] = "Preencha o Campo Comfirmar E-Mail";
            	$cad_campos['erro_confemail'] = "erro";
            } else if (DAO_Usuario::Verificar_Email($usuario->get_email()) > 0) {
            	$erros_cadastrar[] = "Este E-Mail Já Esta Cadastrado";
                $cad_campos['erro_email'] = "erro";
				$cad_campos['erro_confemail'] = "erro";
            }
			
            if (empty($usuario->get_senha())) {
                $erros_cadastrar[] = "Digite sua Senha";
                $cad_campos['erro_senha'] = "erro";
            } else if (strlen($usuario->get_senha()) < 8 OR strlen($usuario->get_senha()) > 20) {
                $erros_cadastrar[] = "A Senha Deve Ter De 8 Até 20 Caracteres";
                $cad_campos['erro_senha'] = "erro";
            }
            
            if (empty($erros_cadastrar)) {
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                DAO_Usuario::Inserir($usuario);
				
                Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                
                return true;
            } else {
                $_SESSION['erros_cadastrar'] = $erros_cadastrar;
                $_SESSION['cad_campos'] = $cad_campos;
                
                $form_cadastro = array();
                
                $form_cadastro['nome'] = $_POST['nome'];
                $form_cadastro['email'] = $_POST['email'];
                $form_cadastro['confemail'] = $_POST['confemail'];
                $form_cadastro['senha'] = $_POST['password'];
                
                $_SESSION['form_cadastro'] = $form_cadastro;
                
                return false;
            }
        }
    }
?>