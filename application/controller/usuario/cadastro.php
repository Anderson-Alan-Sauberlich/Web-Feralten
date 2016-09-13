<?php
namespace application\controller\usuario;

    require_once(RAIZ.'/application/model/dao/usuario.php');
    require_once(RAIZ.'/application/model/object/usuario.php');
    require_once(RAIZ.'/application/controller/usuario/login.php');

    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\Login;
    
    @session_start();

    class Cadastro {

        function __construct() {
            
        }

        public function Cadastrar_Usuario(Object_Usuario $usuario) {
            $erros_cadastrar = array();
            $cad_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' => "certo", 'erro_senha' => "certo");

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
            } else {
                $_SESSION['erros_cadastrar'] = $erros_cadastrar;
                $_SESSION['cad_campos'] = $cad_campos;                
            }
        }
    }
?>