<?php
namespace application\controller\usuario;
	
	require_once RAIZ.'/application/model/common/util/login_session.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/dao/acesso_usuario.php';
    require_once RAIZ.'/application/model/dao/entidade.php';
    require_once RAIZ.'/application/view/src/usuario/login.php';
	
    use application\model\common\util\Login_Session;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\dao\Acesso_Usuario as DAO_Acesso_Usuario;
    use application\model\dao\Entidade as DAO_Entidade;
    use application\view\src\usuario\Login as View_Login;

    class Login {

        function __construct() {
            
        }
        
        private $email;
        private $senha;
        private $manter_login;
        private $logout;
        
        public function set_email($email) {
        	$this->email = $email;
        }
        
        public function set_senha($senha) {
        	$this->senha = $senha;
        }
        
        public function set_manter_login($manter_login = null) {
        	$this->manter_login = $manter_login;
        }
        
        public function set_logout(string $logout) {
        	$this->logout = $logout;
        }
        
        public function Carregar_Pagina(?array $login_erros = null, ?array $login_campos = null, ?array $login_form = null) : void {
        	$view = new View_Login();
        	
        	$view->set_login_campos($login_campos);
        	$view->set_login_erros($login_erros);
        	$view->set_login_form($login_form);
        	
        	$view->Executar();
        }
        
        public function LogOut() : void {
        	if (!empty($this->logout)) {
        		if(hash_equals($this->logout, hash_hmac('sha1', session_id(), sha1(session_id())))) {
	        		if (isset($_COOKIE['f_m_l'])) {
	        			if (isset($_SESSION['login'])) {
	        				DAO_Usuario::Atualizar_Token(null, Login_Session::get_usuario_id());
	        			}
	        			 
	        			setcookie("f_m_l", null, time()-3600, "/");
	        		}
	        
	        		Login_Session::Finalizar_Login_Session();
	        		
	        		$_SESSION['login_sucesso'][] = "LogOut efetuado com Sucesso";
	        	}
        	}
        }
		
		public static function Autenticar_Usuario_Cookie(int $id_usuario, string $token) : bool {
			$usuario_login = DAO_Usuario::Buscar_Usuario($id_usuario);
			
			if ($usuario_login !== false) {
				if (hash_equals($token, hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token())))) {
					$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
					$usuario_login->set_token(null);
					
					Login_Session::set_usuario_id($usuario_login->get_id());
					Login_Session::set_usuario_nome($usuario_login->get_nome());
					Login_Session::set_usuario_status($usuario_login->get_status_id());
					
					$entidade_login = DAO_Entidade::Buscar_Por_Id_Usuario($usuario_login->get_id());
					
					if (!empty($entidade_login) AND $entidade_login !== false) {
						$login['entidade'] = $entidade_login->get_id();
						
						Login_Session::set_entidade_id($entidade_login->get_id());
						Login_Session::set_entidade_nome($entidade_login->get_nome_comercial());
						Login_Session::set_entidade_status($entidade_login->get_status_id());
						 
						$acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
						 
						if (!empty($acessos_login) AND $acessos_login !== false) {
							foreach ($acessos_login as $acesso_login) {
								Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
							}
						}
					}
					
	                $login = array();
					
					$usuario_login->set_token(bin2hex(random_bytes(40)));
					
					$login['usuario'] = $usuario_login->get_id();
					$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
					
	                setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
	                
					$retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login);
					
					if ($retorno === false) {
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		public static function ReAutenticar_Usuario_Logado(int $usuario_id) : bool {
			$usuario_login = DAO_Usuario::Buscar_Usuario($usuario_id);
			
			if (!empty($usuario_login) AND $usuario_login !== false) {
				Login_Session::set_usuario_id($usuario_login->get_id());
				Login_Session::set_usuario_nome($usuario_login->get_nome());
				Login_Session::set_usuario_status($usuario_login->get_status_id());
				
				$entidade_login = DAO_Entidade::Buscar_Por_Id_Usuario($usuario_login->get_id());
				
				if (!empty($entidade_login) AND $entidade_login !== false) {
					Login_Session::set_entidade_id($entidade_login->get_id());
					Login_Session::set_entidade_nome($entidade_login->get_nome_comercial());
					Login_Session::set_entidade_status($entidade_login->get_status_id());
					
					$acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
					
					if (!empty($acessos_login) AND $acessos_login !== false) {
						foreach ($acessos_login as $acesso_login) {
							Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
						}
					}
				}
				
				return true;
			} else {
				return false;
			}
		}
		
        public static function Autenticar_Usuario_Logado(string $email, string $senha) : bool {
        	$usuario_login = DAO_Usuario::Autenticar($email);
            
            if (!empty($usuario_login) AND $usuario_login !== false) {
            	if (hash_equals($senha, $usuario_login->get_senha())) {
            		Login_Session::Finalizar_Login_Session();
            		setcookie("f_m_l", null, time()-3600, "/");
            		
            		Login_Session::set_usuario_id($usuario_login->get_id());
            		Login_Session::set_usuario_nome($usuario_login->get_nome());
            		Login_Session::set_usuario_status($usuario_login->get_status_id());
            		
            		$entidade_login = DAO_Entidade::Buscar_Por_Id_Usuario($usuario_login->get_id());
            		
            		if (!empty($entidade_login) AND $entidade_login !== false) {
            			Login_Session::set_entidade_id($entidade_login->get_id());
            			Login_Session::set_entidade_nome($entidade_login->get_nome_comercial());
            			Login_Session::set_entidade_status($entidade_login->get_status_id());
            			
            			$acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
            			
            			if (!empty($acessos_login) AND $acessos_login !== false) {
            				foreach ($acessos_login as $acesso_login) {
            					Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
            				}
            			}
            		}
					
					return true;
            	} else {
            		false;
            	}
            } else {
            	return false;
            }
        }

        public function Autenticar_Usuario_Login() : ?bool {
            $login_campos = array('erro_email' => "certo");
            $login_erros = array();
            
            if (empty($this->email)) {
                $login_erros[] = "Digite seu Email";
                $login_campos['erro_email'] = "erro";                
            } else {
            	$this->email = trim($this->email);
            	
            	if (filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false) {
            		$retorno = DAO_Usuario::Verificar_Email($this->email);
            		
            		if ($retorno !== false) {
		            	if ($retorno === 0) {
			                $login_erros[] = "Email não Cadastrado";
			                $login_campos['erro_email'] = "erro";
		            	}
            		} else {
            			$login_erros[] = "Erro ao tentar Encontrar E-Mail";
            			$login_campos['erro_email'] = "";
            		}
            	} else {
            		$login_erros[] = "Este E-Mail Não é Valido";
		            $login_campos['erro_email'] = "erro";
            	}
            }
            
            if (empty($this->senha)) {
                $login_erros[] = "Digite sua Senha";
                $login_campos['erro_senha'] = "erro";
            } else {
            	$senha = strip_tags($this->senha);
            	 
            	if ($senha !== $this->senha) {
            		$login_erros[] = "A Senha Não pode conter Tags de Programação";
            		$login_campos['erro_senha'] = "erro";
            	}
            }
            
            if (!empty($this->manter_login)) {
            	$this->manter_login = true;
            }

            if (empty($login_erros)) {
            	$usuario_login = DAO_Usuario::Autenticar($this->email);
                
                if (!empty($usuario_login) AND $usuario_login !== false) {
                	if (password_verify($this->senha, $usuario_login->get_senha())) {
						$usuario_login->set_ultimo_login(date("Y-m-d H:i:s"));
						
						Login_Session::set_usuario_id($usuario_login->get_id());
						Login_Session::set_usuario_nome($usuario_login->get_nome());
						Login_Session::set_usuario_status($usuario_login->get_status_id());
						
						$entidade_login = DAO_Entidade::Buscar_Por_Id_Usuario($usuario_login->get_id());
						
						if (!empty($entidade_login) AND $entidade_login !== false) {
							$login['entidade'] = $entidade_login->get_id();
							
							Login_Session::set_entidade_id($entidade_login->get_id());
							Login_Session::set_entidade_nome($entidade_login->get_nome_comercial());
							Login_Session::set_entidade_status($entidade_login->get_status_id());
							
							$acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
							
							if (!empty($acessos_login) AND $acessos_login !== false) {
								foreach ($acessos_login as $acesso_login) {
									Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
								}
							}
						}
						
						if ($this->manter_login === true) {
		                    $login = array();
							
							$usuario_login->set_token(bin2hex(random_bytes(40)));
							
							$login['usuario'] = $usuario_login->get_id();
							$login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
							
		                    setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
		                    
							$retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login);
		                	
							if ($retorno === false) {
								$login_erros[] = "Erro ao tentar Atualizar Usuario";
							}
		                } else {
		                    $retorno = DAO_Usuario::Atualizar_Ultimo_Login($usuario_login->get_ultimo_login(), $usuario_login->get_id());
		                	
		                    if ($retorno === false) {
		                    	$login_erros[] = "Erro ao tentar Atualizar Usuario";
		                    }
		                }
		            } else {
		                $login_erros[] = "Senha Incorreta";
		                $login_campos['erro_senha'] = "erro";
		            }
                } else {
                	$login_erros[] = "Erro ao tentar Autenticar Usuario";
                }
            }
            
            if (empty($login_erros)) {
            	return true;
            } else {
            	setcookie("f_m_l", null, time()-3600, "/");
            	
            	$login_form = array();
            	
            	$login_form['email'] = trim(strip_tags($this->email));
            	$login_form['senha'] = strip_tags($this->senha);
            	
            	$this->Carregar_Pagina($login_erros, $login_campos, $login_form);
            	
            	return false;
            }
        }
    }
?>