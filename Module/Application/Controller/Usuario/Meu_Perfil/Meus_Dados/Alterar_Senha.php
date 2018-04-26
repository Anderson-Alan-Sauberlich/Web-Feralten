<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Alterar_Senha as View_Alterar_Senha;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use \Exception;
    
    class Alterar_Senha
    {
        function __construct()
        {
            
        }
        
        private $senha_antiga;
        private $senha_nova;
        private $senha_confnova;
        private $form = [];
        private $erros = [];
        private $campos = [];
        
        public function set_senha_antiga($senha_antiga) : void
        {
            try {
                $this->senha_antiga = Validador::Usuario()::validar_senha_antiga($senha_antiga);
                $this->campos['erro_senha_antiga'] = "certo";
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_senha_antiga'] = "erro";
                
                $this->senha_antiga = Validador::Usuario()::filtrar_senha_antiga($senha_antiga);
            }
        }
        
        public function set_senha_nova($senha_nova) : void
        {
            try {
                $this->senha_nova = Validador::Usuario()::validar_senha_nova($senha_nova);
                $this->campos['erro_senha_nova'] = 'certo';
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_senha_nova'] = 'erro';
                
                $this->senha_nova = Validador::Usuario()::filtrar_senha_nova($senha_nova);
            }
        }
        
        public function set_senha_confnova($senha_confnova) : void
        {
            try {
                $this->senha_confnova = Validador::Usuario()::validar_senha_confnova($senha_confnova, $this->senha_nova);
                $this->campos['erro_senha_confnova'] = 'certo';
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_senha_confnova'] = 'erro';
                
                $this->senha_confnova = Validador::Usuario()::filtrar_senha_confnova($senha_confnova);
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Alterar_Senha($status);
                
                $view->set_campos($this->campos);
                $view->set_erros($this->erros);
                $view->set_form($this->form);
                 
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public function Atualizar_Senha_Usuario()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (empty($this->erros)) {
                    $this->senha_nova = password_hash($this->senha_nova, PASSWORD_DEFAULT);
                    
                    if (DAO_Usuario::Atualizar_Senha($this->senha_nova, Login_Session::get_usuario_id()) == false) {
                        $this->erros[] = "Erro ao tentar Alterar a Senha do Usuario";
                        $this->campos['erro_senha_antiga'] = "";
                        $this->campos['erro_senha_nova'] = "";
                        $this->campos['erro_senha_confnova'] = "";
                    }
                }
                
                if (empty($this->erros)) {
                    return 'certo';
                } else {
                    $this->form['senha_antiga'] = $this->senha_antiga;
                    $this->form['senha_nova'] = $this->senha_nova;
                    $this->form['senha_confnova'] = $this->senha_confnova;
                    
                    $this->Carregar_Pagina();
                }
            } else {
                return false;
            }
        }
    }
