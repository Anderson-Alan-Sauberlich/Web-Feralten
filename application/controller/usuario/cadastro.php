<?php
namespace application\controller\usuario;
	
	require_once RAIZ.'/application/model/common/util/filtro.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/controller/usuario/login.php';
    require_once RAIZ.'/application/view/src/usuario/cadastro.php';
	
    use application\model\common\util\Filtro;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\Login;
    use application\view\src\usuario\Cadastro as View_Cadastro;
    use \Exception;
    
    class Cadastro {
		
        function __construct() {
            
        }
        
        private $nome;
        private $email;
        private $confemail;
        private $senha;
        private $cadastro_erros = array();
        private $cadastro_campos = array();
        private $cadastro_form = array();
        
        public function set_nome($nome) {
        	try {
        		$this->nome = Filtro::Usuario()::validar_nome($nome);
        		$this->cadastro_campos['erro_nome'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_nome'] = "erro";
        		
        		$this->nome = Filtro::Usuario()::filtrar_nome($nome);
        	}
        }
        
        public function set_email($email) {
        	try {
        		$this->email = Filtro::Usuario()::validar_email($email);
        		$this->cadastro_campos['erro_email'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_email'] = "erro";
        		
        		$this->email = Filtro::Usuario()::filtrar_email($email);
        	}
        }
        
        public function set_confemail($confemail) {
        	try {
        		$this->confemail= Filtro::Usuario()::validar_confemail($confemail);
        		$this->cadastro_campos['erro_confemail'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_confemail'] = "erro";
        		if ($this->cadastro_campos['erro_email'] !== "certo") {
        			$this->cadastro_campos['erro_email'] = "erro";
        		}
        		
        		$this->confemail = Filtro::Usuario()::filtrar_email($confemail);
        	}
        }
        
        public function set_senha($senha) {
        	try {
        		$this->senha = Filtro::Usuario()::validar_senha($senha);
        		$this->cadastro_campos['erro_senha'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_senha'] = "erro";
        		
        		$this->senha = Filtro::Usuario()::filtrar_senha($senha);
        	}
        }
        
        public function Carregar_Pagina() : void {
        	$view = new View_Cadastro();
        	
        	$view->set_cadastro_campos($this->cadastro_campos);
        	$view->set_cadastro_erros($this->cadastro_erros);
        	$view->set_cadastro_form($this->cadastro_form);
        	 
        	$view->Executar();
        }

        public function Cadastrar_Usuario() {
            $usuario = new Object_Usuario();
            
	        if (empty($this->confemail) OR empty($this->email)) {
	        	if (empty($this->email)) {
	        		$this->cadastro_erros[] = "Preencha o Campo E-Mail";
	        		$this->cadastro_campos['erro_email'] = "erro";
	        	}
	        	 
	        	if (empty($this->confemail)) {
	        		$this->cadastro_erros[] = "Preencha o Campo Comfirmar E-Mail";
	        		$this->cadastro_campos['erro_confemail'] = "erro";
	        	}
	        } else {
	        	$this->confemail = trim($this->confemail);
	        	$this->email = trim($this->email);
	        	
	        	if ($this->confemail=== $this->email) {
	        		if (filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false) {
	        			if (strlen($this->email) <= 150) {
	        				$retorno = DAO_Usuario::Verificar_Email($this->email);
		        			
			        		if ($retorno !== false) {
			        			if ($retorno === 0) {
			        				$usuario->set_email($this->email);
				        		} else {
				        			$this->cadastro_erros[] = "Este E-Mail Já Esta Cadastrado";
				        			$this->cadastro_campos['erro_email'] = "erro";
				        			$this->cadastro_campos['erro_confemail'] = "erro";
				        		}
			        		} else {
			        			$this->cadastro_erros[] = "Erro ao tentar Encontrar E-Mail";
			        			$this->cadastro_campos['erro_email'] = "";
			        			$this->cadastro_campos['erro_confemail'] = "";
			        		}
		        		} else {
		        			$this->cadastro_erros[] = "O E-Mail pode ter no maximo 150 Caracteres";
		        			$this->cadastro_campos['erro_email'] = "erro";
		        			$this->cadastro_campos['erro_confemail'] = "erro";
		        		}
	        		} else {
	        			$this->cadastro_erros[] = "Este E-Mail Não é Valido";
	        			$this->cadastro_campos['erro_email'] = "erro";
	        			$this->cadastro_campos['erro_confemail'] = "erro";
	        		}
	        	} else {
	        		$this->cadastro_erros[] = "Digite o E-Mails Duas Vezes Igualmente";
	        		$this->cadastro_campos['erro_email'] = "erro";
	        		$this->cadastro_campos['erro_confemail'] = "erro";
	        	}
	        }
            
            if (empty($this->cadastro_erros)) {
            	$usuario->set_id(0);
            	$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	$usuario->set_status_id(2);
            	
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                $retorno = DAO_Usuario::Inserir($usuario);
				
                if ($retorno !== false) {
                	$retorno = Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                	
                	if ($retorno === false) {
                		$this->cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                	}
                } else {
                	$this->cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                }
            }
            
            if (empty($this->cadastro_erros)) {
            	return true;
            } else {
                $this->cadastro_form['nome'] = $this->nome;
                $this->cadastro_form['email'] = trim(strip_tags($this->email));
                $this->cadastro_form['confemail'] = trim(strip_tags($this->confemail));
                $this->cadastro_form['senha'] = strip_tags($this->senha);
                
                $this->Carregar_Pagina();
            }
        }
    }
?>