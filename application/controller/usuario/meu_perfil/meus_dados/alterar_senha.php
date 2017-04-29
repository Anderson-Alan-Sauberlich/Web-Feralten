<?php
namespace application\controller\usuario\meu_perfil\meus_dados;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
	require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/alterar_senha.php';
	require_once RAIZ.'/application/controller/include_page/menu/usuario.php';
    
	use application\model\common\util\Login_Session;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\view\src\usuario\meu_perfil\meus_dados\Alterar_Senha as View_Alterar_Senha;
    use application\controller\include_page\menu\Usuario as Controller_Usuario;
	
    class Alterar_Senha {

        function __construct() {
            
        }
        
        private $senha_antiga;
        private $senha_nova;
        private $senha_confnova;
        
        public function set_senha_antiga($senha_antiga){
        	$this->senha_antiga = $senha_antiga;
        }   
        
        public function set_senha_nova($senha_nova) {
        	$this->senha_nova = $senha_nova;
        }
        
        public function set_senha_confnova($senha_confnova) {
        	$this->senha_confnova = $senha_confnova;
        }
        
        public function Carregar_Pagina(?array $alterar_senha_erros = null, ?array $alterar_senha_campos = null, ?array $alterar_senha_form = null) {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		$view = new View_Alterar_Senha($status);
        		
        		$view->set_alterar_senha_campos($alterar_senha_campos);
        		$view->set_alterar_senha_erros($alterar_senha_erros);
        		$view->set_alterar_senha_form($alterar_senha_form);
        		 
        		$view->Executar();
        	} else {
        		return false;
        	}
        }
        
        public function Atualizar_Senha_Usuario() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
	            $alterar_senha_erros = array();
	            $alterar_senha_campos = array('erro_senha_antiga' =>  "certo", 'erro_senha_nova' => "certo", 'erro_senha_confnova' => "certo");
	            
			    if (empty($this->senha_antiga)) {
			    	$alterar_senha_erros[] = "Digite a Senha Antiga";
			    	$alterar_senha_campos['erro_senha_antiga'] = "erro";
			    } else {
			    	$senha_usuario = DAO_Usuario::Buscar_Senha_Usuario(Login_Session::get_usuario_id());
			    		
			    	if (!password_verify($this->senha_antiga, $senha_usuario)) {
			    		$alterar_senha_erros[] = "Senha Antiga Incorreta";
			    		$alterar_senha_campos['erro_senha_antiga'] = "erro";
			    	}
			    }
	            
			    if (empty($this->senha_nova) OR empty($this->senha_confnova)) {
			    	if (empty($this->senha_nova)) {
	            		$alterar_senha_erros[] = "Preencha o Campo Nova Senha";
	            		$alterar_senha_campos['erro_senha_nova'] = "erro";
	            	}
	            	
	            	if (empty($this->senha_confnova)) {
	            		$alterar_senha_erros[] = "Preencha o Campo Confirmar Nova Senha";
	            		$alterar_senha_campos['erro_senha_confnova'] = "erro";
	            	}
	            } else {
	            	if ($this->senha_nova === $this->senha_confnova) {
	            		if (strlen($this->senha_nova) >= 6 AND strlen($this->senha_nova) <= 20) {
	            			$password = strip_tags($this->senha_nova);
		            		 
	            			if ($password !== $this->senha_nova) {
		            			$erros_cadastrar[] = "A Senha Não pode conter Tags de Programação";
		            			$cad_campos['erro_senha'] = "erro";
		            		}
		            	} else {
		            		$erros_cadastrar[] = "A Senha Deve conter de 6 a 20 caracteres";
		            		$cad_campos['erro_senha'] = "erro";
		            	}
	            	} else {
	            		$alterar_senha_erros[] = "Campos: \"Nova Senha\" e \"Confirmar Nova Senha\", Não estão Iguais.";
	            		$alterar_senha_campos['erro_senha_nova'] = "erro";
	            		$alterar_senha_campos['erro_senha_confnova'] = "erro";
	            	}
	            }
	            
	            if (empty($alterar_senha_erros)) {
	            	$this->senha_nova = password_hash($this->senha_nova, PASSWORD_DEFAULT);
					
	            	if (DAO_Usuario::Atualizar_Senha($this->senha_nova, Login_Session::get_usuario_id()) === false) {
	                	$alterar_senha_erros[] = "Erro ao tentar Alterar a Senha do Usuario";
	                	$alterar_senha_campos['erro_senha_antiga'] = "";
	                	$alterar_senha_campos['erro_senha_nova'] = "";
	                	$alterar_senha_campos['erro_senha_confnova'] = "";
	                }
	            }
	            
	            if (empty($alterar_senha_erros)) {
	            	return 'certo';
	            } else {
	            	$alterar_senha_form = array();
	            	
	            	$alterar_senha_form['senha_antiga'] = strip_tags($this->senha_antiga);
	            	$alterar_senha_form['senha_nova'] = strip_tags($this->senha_nova);
	            	$alterar_senha_form['senha_confnova'] = strip_tags($this->senha_confnova);
	            	
	            	$this->Carregar_Pagina($alterar_senha_erros, $alterar_senha_campos, $alterar_senha_form);
	            }
        	} else {
        		return false;
        	}
        }
    }
?>