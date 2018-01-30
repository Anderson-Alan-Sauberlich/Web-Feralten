<?php
namespace Module\Application\Controller\Usuario;
    
    use Module\Application\View\SRC\Usuario\Recuperar_Senha as View_Recuperar_Senha;
    use Module\Application\Controller\Usuario\Login as Controller_Login;
    use Module\Application\Model\Object\Recuperar_Senha as Object_Recuperar_Senha;
    use Module\Application\Model\DAO\Recuperar_Senha as DAO_Recuperar_Senha;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Controller\Common\Util\Email;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Recuperar_Senha
    {

        function __construct()
        {
            $this->object_recuperar_senha = new Object_Recuperar_Senha();
        }
        
        private $object_recuperar_senha;
        private $senha_nova;
        private $senha_confnova;
        private $campos = array();
        private $erros = array();
        
        public function set_email($email) : void
        {
            try {
                $this->object_recuperar_senha->set_object_usuario(DAO_Usuario::Autenticar(Validador::Usuario()::validar_email_login($email)));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        public function set_codigo($codigo) : void
        {
            try {
                $codigo = Validador::Recuperar_Senha()::validar_codigo($codigo);
                
                $recuperar_senhas = DAO_Recuperar_Senha::BuscarTodos();
                
                foreach ($recuperar_senhas as $recuperar_senha) {
                    if (hash_hmac('sha512', $recuperar_senha->get_codigo(), hash('sha512', $recuperar_senha->get_codigo())) === $codigo) {
                        $this->object_recuperar_senha = $recuperar_senha;
                        break;
                    }
                }
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['codigo'] = "erro";
            }
        }
        
        public function set_senha_nova($senha_nova) : void
        {
            try {
                $this->senha_nova = Validador::Usuario()::validar_senha_nova($senha_nova);
                $this->campos['senha_nova'] = 'certo';
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['senha_nova'] = 'erro';
                
                $this->senha_nova = Validador::Usuario()::filtrar_senha_nova($senha_nova);
            }
        }
        
        public function set_senha_confnova($senha_confnova) : void
        {
            try {
                $this->senha_confnova = Validador::Usuario()::validar_senha_confnova($senha_confnova, $this->senha_nova);
                $this->campos['enha_confnova'] = 'certo';
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['senha_confnova'] = 'erro';
                
                $this->senha_confnova = Validador::Usuario()::filtrar_senha_confnova($senha_confnova);
            }
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Recuperar_Senha();
            
            $view->set_object_recuperar_senha($this->object_recuperar_senha);
            
            $view->Executar();
        }
        
        public function Enviar_Link_Email() : void
        {
            $retorno['status'] = '';
            $retorno['header'] = '';
            $retorno['content'] = '';
            $retorno['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                $this->object_recuperar_senha->set_codigo(bin2hex(random_bytes(40)));
                
                if (Email::Enviar_Recuperar_Senha($this->object_recuperar_senha)) {
                    $this->object_recuperar_senha->set_data_hora(date('Y-m-d H:i:s'));
                    
                    if (DAO_Recuperar_Senha::Inserir($this->object_recuperar_senha)) {
                        $retorno['status'] = 'certo';
                        $retorno['header'] = '<h3>Enviado com Sucesso</h3>';
                        $retorno['content'] = '<p>Link enviado com sucesso para sua conta de E-Mail!</p>
                                             <p>Verifique seus e-mails e siga os passos sugeridos para criar uma nova senha.</p>';
                    } else {
                        $retorno['status'] = 'erro';
                        $retorno['header'] = '<h3>Erro ao tentar salvar código</h3>';
                        $retorno['content'] = '<p>Desculpe, servidor de Banco de Dados Offline</p>';
                    }
                } else {
                    $retorno['status'] = 'erro';
                    $retorno['header'] = '<h3>Erro ao tentar enviar e-mail</h3>';
                    $retorno['content'] = '<p>Desculpe, servidor de e-mail Offline</p>';
                }
            } else {
                $retorno['status'] = 'erro';
                $retorno['header'] = '<h3>Erro ao tentar enviar e-mail</h3>';
                
                foreach ($this->erros as $erro) {
                    $retorno['content'] .= "<p>$erro</p>";
                }
            }
            
            echo json_encode($retorno);
        }
        
        public function Salvar_Senha() : void
        {
            $retorno = array();
            $retorno['status'] = '';
            $retorno['header'] = '';
            $retorno['content'] = '';
            $retorno['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                if (!empty($this->object_recuperar_senha->get_object_usuario())) {
                    $this->senha_nova = password_hash($this->senha_nova, PASSWORD_DEFAULT);
                    
                    if (DAO_Usuario::Atualizar_Senha($this->senha_nova, $this->object_recuperar_senha->get_object_usuario()->get_id()) === false) {
                        $retorno['status'] = 'erro';
                        $retorno['header'] = '<h3>Erro Salvar Nova Senha</h3>';
                        $retorno['content'] = '<p>Desculpe, não foi possível salvar a nova senha</p>';
                    } else {
                        DAO_Recuperar_Senha::Deletar($this->object_recuperar_senha->get_object_usuario()->get_id());
                        
                        Controller_Login::ReAutenticar_Usuario_Logado($this->object_recuperar_senha->get_object_usuario()->get_id());
                        
                        $retorno['status'] = 'certo';
                        $retorno['header'] = '<h3>Senha Alterada com Sucesso</h3>';
                        $retorno['content'] = '<p>Clique no Link para Entrar com sua Nova Senha: <a>/usuario/login/</a></p>';
                    }
                } else {
                    $retorno['status'] = 'erro';
                    $retorno['header'] = '<h3>Erro Codigo Usuario</h3>';
                    $retorno['content'] = '<p>Desculpe, código de usuario invalido</p>';
                }
            } else {
                $retorno['status'] = 'erro';
                $retorno['header'] = '<h3>Erro ao tentar salvar nova senha</h3>';
                
                foreach ($this->erros as $erro) {
                    $retorno['content'] .= "<p>$erro</p>";
                }
            }
            
            echo json_encode($retorno);
        }
    }
