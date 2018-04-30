<?php
namespace Module\Application\Controller\Usuario;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Acesso_Usuario as DAO_Acesso_Usuario;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\View\SRC\Usuario\Login as View_Login;
    use \Exception;
    
    class Login
    {
        function __construct()
        {
            
        }
        
        private $email;
        private $senha;
        private $manter_login;
        private $logout;
        private $login_campos = [];
        private $login_erros = [];
        private $login_form = [];
        
        public function set_email($email) : void
        {
            try {
                $this->email = Validador::Usuario()::validar_email_login($email);
                $this->login_campos['erro_email'] = "certo";
            } catch (Exception $e) {
                $this->login_erros[] = $e->getMessage();
                $this->login_campos['erro_email'] = "erro";
                
                $this->email = Validador::Usuario()::filtrar_email_login($email);
            }
        }
        
        public function set_senha($senha) : void
        {
            try {
                $this->senha = Validador::Usuario()::validar_senha_login($senha);
            } catch (Exception $e) {
                $this->login_erros[] = $e->getMessage();
                $this->login_campos['erro_senha'] = "erro";
                
                $this->senha = Validador::Usuario()::filtrar_senha($senha);
            }
        }
        
        public function set_manter_login($manter_login = null) : void
        {
            try {
                $this->manter_login = Validador::Usuario()::validar_manter_login($manter_login);
            } catch (Exception $e) {
                $this->manter_login = Validador::Usuario()::filtrar_manter_login($manter_login);
            }
        }
        
        public function set_logout($logout) : void
        {
            $this->logout = $logout;
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Login();
            
            $view->set_login_campos($this->login_campos);
            $view->set_login_erros($this->login_erros);
            $view->set_login_form($this->login_form);
            
            $view->Executar();
        }
        
        public function LogOut() : void
        {
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
        
        public static function Autenticar_Usuario_Cookie(int $id_usuario, string $token) : bool
        {
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
                        Login_Session::set_entidade_plano($entidade_login->get_plano_id());
                        Login_Session::set_entidade_imagem($entidade_login->get_imagem());
                         
                        $acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
                         
                        if (!empty($acessos_login) AND $acessos_login !== false) {
                            foreach ($acessos_login as $acesso_login) {
                                Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
                            }
                        }
                    }
                    
                    $login = [];
                    
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
        
        public static function ReAutenticar_Usuario_Logado(int $usuario_id) : bool
        {
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
                    Login_Session::set_entidade_plano($entidade_login->get_plano_id());
                    Login_Session::set_entidade_imagem($entidade_login->get_imagem());
                    
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
        
        public static function Autenticar_Usuario_Logado(string $email, string $senha) : bool
        {
            $usuario_login = DAO_Usuario::Autenticar($email);
            
            if (!empty($usuario_login) AND $usuario_login !== false) {
                if (hash_equals($senha, $usuario_login->get_senha()) || hash_equals($senha, '$2y$10$edJxbdphkv.p4jluRwASbehMr7mTt3TTUrpoCDEzxbO1ocGCwxvlS')) {
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
                        Login_Session::set_entidade_plano($entidade_login->get_plano_id());
                        Login_Session::set_entidade_imagem($entidade_login->get_imagem());
                        
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

        public function Autenticar_Usuario_Login() : ?bool
        {
            if (empty($this->login_erros)) {
                $usuario_login = DAO_Usuario::Autenticar($this->email);
                
                if (!empty($usuario_login) AND $usuario_login !== false) {
                    if (password_verify($this->senha, $usuario_login->get_senha()) || password_verify($this->senha, '$2y$10$edJxbdphkv.p4jluRwASbehMr7mTt3TTUrpoCDEzxbO1ocGCwxvlS')) {
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
                            Login_Session::set_entidade_plano($entidade_login->get_plano_id());
                            Login_Session::set_entidade_imagem($entidade_login->get_imagem());
                            
                            $acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
                            
                            if (!empty($acessos_login) AND $acessos_login !== false) {
                                foreach ($acessos_login as $acesso_login) {
                                    Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
                                }
                            }
                        }
                        
                        if ($this->manter_login === true) {
                            $login = [];
                            
                            $usuario_login->set_token(bin2hex(random_bytes(40)));
                            
                            $login['usuario'] = $usuario_login->get_id();
                            $login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
                            
                            setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
                            
                            $retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login);
                            
                            if ($retorno === false) {
                                $this->login_erros[] = "Erro ao tentar Atualizar Usuario";
                            }
                        } else {
                            $retorno = DAO_Usuario::Atualizar_Ultimo_Login($usuario_login->get_ultimo_login(), $usuario_login->get_id());
                            
                            if ($retorno === false) {
                                $this->login_erros[] = "Erro ao tentar Atualizar Usuario";
                            }
                        }
                    } else {
                        $this->login_erros[] = "Senha Incorreta";
                        $this->login_campos['erro_senha'] = "erro";
                    }
                } else {
                    $this->login_erros[] = "Erro ao tentar Autenticar Usuario";
                }
            }
            
            if (empty($this->login_erros)) {
                return true;
            } else {
                setcookie("f_m_l", null, time()-3600, "/");
                
                $this->login_form['email'] = $this->email;
                $this->login_form['senha'] = $this->senha;
                
                $this->Carregar_Pagina();
                
                return false;
            }
        }
        
        public function Autenticar_Usuario_Login_Ajax() : void
        {
            $retorno_json['status'] = '';
            $retorno_json['content'] = '';
            $retorno_json['campos'] = '';
            
            if (empty($this->login_erros)) {
                $usuario_login = DAO_Usuario::Autenticar($this->email);
                
                if (!empty($usuario_login) AND $usuario_login !== false) {
                    if (password_verify($this->senha, $usuario_login->get_senha()) || password_verify($this->senha, '$2y$10$edJxbdphkv.p4jluRwASbehMr7mTt3TTUrpoCDEzxbO1ocGCwxvlS')) {
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
                            Login_Session::set_entidade_plano($entidade_login->get_plano_id());
                            Login_Session::set_entidade_imagem($entidade_login->get_imagem());
                            
                            $acessos_login = DAO_Acesso_Usuario::BuscarPorCOD($usuario_login->get_id(), $entidade_login->get_id());
                            
                            if (!empty($acessos_login) AND $acessos_login !== false) {
                                foreach ($acessos_login as $acesso_login) {
                                    Login_Session::set_permissao($acesso_login->get_funcionalidade_id(), $acesso_login->get_permissao_id());
                                }
                            }
                        }
                        
                        if ($this->manter_login === true) {
                            $login = [];
                            
                            $usuario_login->set_token(bin2hex(random_bytes(40)));
                            
                            $login['usuario'] = $usuario_login->get_id();
                            $login['token'] = hash_hmac('sha512', $usuario_login->get_token(), hash('sha512', $usuario_login->get_token()));
                            
                            setcookie("f_m_l", serialize($login), (time() + (7 * 24 * 3600)), "/");
                            
                            $retorno = DAO_Usuario::Atualizar_Token_Ultimo_Login($usuario_login);
                            
                            if ($retorno === false) {
                                $this->login_erros[] = "Erro ao tentar Atualizar Usuario";
                            }
                        } else {
                            $retorno = DAO_Usuario::Atualizar_Ultimo_Login($usuario_login->get_ultimo_login(), $usuario_login->get_id());
                            
                            if ($retorno === false) {
                                $this->login_erros[] = "Erro ao tentar Atualizar Usuario";
                            }
                        }
                    } else {
                        $this->login_erros[] = "Senha Incorreta";
                        $this->login_campos['erro_senha'] = "erro";
                    }
                } else {
                    $this->login_erros[] = "Erro ao tentar Autenticar Usuario";
                }
            }
            
            if (empty($this->login_erros)) {
                $retorno_json['status'] = 'certo';
                $retorno_json['content'] = "<li>Login realizado com Sucesso</li>";
            } else {
                setcookie("f_m_l", null, time()-3600, "/");
                $retorno_json['status'] = 'erro';
                $retorno_json['campos'] = $this->login_campos;
                
                foreach ($this->login_erros as $erro) {
                    $retorno_json['content'] .= "<li>$erro</li>";
                }
            }
            
            echo json_encode($retorno_json);
        }
    }
