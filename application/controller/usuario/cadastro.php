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
    
    class Cadastro {

        function __construct() {
            
        }
        
        private $nome;
        private $email;
        private $confemail;
        private $senha;
        
        public function set_nome($nome) {
        	$this->nome = $nome;
        }
        
        public function set_email($email) {
        	$this->email = $email;
        }
        
        public function set_confemail($confemail) {
        	$this->confemail = $confemail;
        }
        
        public function set_senha($senha) {
        	$this->senha = $senha;
        }
        
        public function Carregar_Pagina(?array $cadastro_erros = null, ?array $cadastro_campos = null, ?array $cadastro_form = null) : void {
        	$view = new View_Cadastro();
        	
        	$view->set_cadastro_campos($cadastro_campos);
        	$view->set_cadastro_erros($cadastro_erros);
        	$view->set_cadastro_form($cadastro_form);
        	 
        	$view->Executar();
        }

        public function Cadastrar_Usuario() {
            $cadastro_erros = array();
            $cadastro_campos = array('erro_nome' => "certo", 'erro_email' =>  "certo", 'erro_confemail' => "certo", 'erro_senha' => "certo");

            $usuario = new Object_Usuario();
            
            if (empty($this->nome)) {
            	$cadastro_erros[] = "Digite Seu Nome Completo";
            	$cadastro_campos['erro_nome'] = "erro";
            } else {
            	$nome = strip_tags($this->nome);
            	
            	if ($nome === $this->nome) {
            		$this->nome = trim($this->nome);
            		$this->nome = preg_replace('/\s+/', " ", $this->nome);
	            	
            		if (strlen($this->nome) <= 150) {
            			if (preg_match("/^([A-zÀ-ú0-9çÇ ,'-]+)$/", $this->nome)) {
            				$usuario->set_nome(ucwords(strtolower($this->nome)));
	            		} else {
	            			$cadastro_erros[] = "O Nome Não Pode Conter Caracteres Especiais";
	            			$cadastro_campos['erro_nome'] = "erro";
	            		}
	            	} else {
	            		$cadastro_erros[] = "O Nome pode ter no maximo 150 Caracteres";
	            		$cadastro_campos['erro_nome'] = "erro";
	            	}
            	} else {
            		$cadastro_erros[] = "O Nome Não pode conter Tags de Programação";
            		$cadastro_campos['erro_nome'] = "erro";
            	}
            }
            
            if (empty($this->senha)) {
            	$cadastro_erros[] = "Preencha o Campo Senha";
            	$cadastro_campos['erro_senha'] = "erro";
            } else {
            	if (strlen($this->senha) >= 6 AND strlen($this->senha) <= 20) {
            		$senha = strip_tags($this->senha);
	            	 
            		if ($senha === $this->senha) {
            			$usuario->set_senha($this->senha);
	            	} else {
	            		$cadastro_erros[] = "A Senha Não pode conter Tags de Programação";
	            		$cadastro_campos['erro_senha'] = "erro";
	            	}
	            } else {
	            	$cadastro_erros[] = "A Senha Deve conter de 6 a 20 caracteres";
	            	$cadastro_campos['erro_senha'] = "erro";
	            }
            }
	        
	        if (empty($this->confemail) OR empty($this->email)) {
	        	if (empty($this->email)) {
	        		$cadastro_erros[] = "Preencha o Campo E-Mail";
	        		$cadastro_campos['erro_email'] = "erro";
	        	}
	        	 
	        	if (empty($this->confemail)) {
	        		$cadastro_erros[] = "Preencha o Campo Comfirmar E-Mail";
	        		$cadastro_campos['erro_confemail'] = "erro";
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
				        			$cadastro_erros[] = "Este E-Mail Já Esta Cadastrado";
				        			$cadastro_campos['erro_email'] = "erro";
				        			$cadastro_campos['erro_confemail'] = "erro";
				        		}
			        		} else {
			        			$cadastro_erros[] = "Erro ao tentar Encontrar E-Mail";
			        			$cadastro_campos['erro_email'] = "";
			        			$cadastro_campos['erro_confemail'] = "";
			        		}
		        		} else {
		        			$cadastro_erros[] = "O E-Mail pode ter no maximo 150 Caracteres";
		        			$cadastro_campos['erro_email'] = "erro";
		        			$cadastro_campos['erro_confemail'] = "erro";
		        		}
	        		} else {
	        			$cadastro_erros[] = "Este E-Mail Não é Valido";
	        			$cadastro_campos['erro_email'] = "erro";
	        			$cadastro_campos['erro_confemail'] = "erro";
	        		}
	        	} else {
	        		$cadastro_erros[] = "Digite o E-Mails Duas Vezes Igualmente";
	        		$cadastro_campos['erro_email'] = "erro";
	        		$cadastro_campos['erro_confemail'] = "erro";
	        	}
	        }
            
            if (empty($cadastro_erros)) {
            	$usuario->set_id(0);
            	$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	$usuario->set_status_id(2);
            	
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                $retorno = DAO_Usuario::Inserir($usuario);
				
                if ($retorno !== false) {
                	$retorno = Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                	
                	if ($retorno === false) {
                		$cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                	}
                } else {
                	$cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                }
            }
            
            if (empty($cadastro_erros)) {
            	return true;
            } else {
                $cadastro_form = array();
                
                $cadastro_form['nome'] = ucwords(strtolower(preg_replace('/\s+/', " ", trim(strip_tags($this->nome)))));
                $cadastro_form['email'] = trim(strip_tags($this->email));
                $cadastro_form['confemail'] = trim(strip_tags($this->confemail));
                $cadastro_form['senha'] = strip_tags($this->senha);
                
                $this->Carregar_Pagina($cadastro_erros, $cadastro_campos, $cadastro_form);
            }
        }
    }
?>