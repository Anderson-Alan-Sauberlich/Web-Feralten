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
        private $alterar_senha_form = array();
        private $alterar_senha_erros = array();
        private $alterar_senha_campos = array();
        
        public function set_senha_antiga($senha_antiga) : void
        {
            try {
                $this->senha_antiga = Validador::Usuario()::validar_senha_antiga($senha_antiga);
                $this->alterar_senha_campos['erro_senha_antiga'] = "certo";
            } catch (Exception $e) {
                $this->alterar_senha_erros[] = $e->getMessage();
                $this->alterar_senha_campos['erro_senha_antiga'] = "erro";
                
                $this->senha_antiga = Validador::Usuario()::filtrar_senha_antiga($senha_antiga);
            }
        }
        
        public function set_senha_nova($senha_nova) : void
        {
            try {
                $this->senha_nova = Validador::Usuario()::validar_senha_nova($senha_nova);
                $this->alterar_senha_campos['erro_senha_nova'] = 'certo';
            } catch (Exception $e) {
                $this->alterar_senha_erros[] = $e->getMessage();
                $this->alterar_senha_campos['erro_senha_nova'] = 'erro';
                
                $this->senha_nova = Validador::Usuario()::filtrar_senha_nova($senha_nova);
            }
        }
        
        public function set_senha_confnova($senha_confnova) : void
        {
            try {
                $this->senha_confnova = Validador::Usuario()::validar_senha_confnova($senha_confnova, $this->senha_nova);
                $this->alterar_senha_campos['erro_senha_confnova'] = 'certo';
            } catch (Exception $e) {
                $this->alterar_senha_erros[] = $e->getMessage();
                $this->alterar_senha_campos['erro_senha_confnova'] = 'erro';
                
                $this->senha_confnova = Validador::Usuario()::filtrar_senha_confnova($senha_confnova);
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Alterar_Senha($status);
                
                $view->set_alterar_senha_campos($this->alterar_senha_campos);
                $view->set_alterar_senha_erros($this->alterar_senha_erros);
                $view->set_alterar_senha_form($this->alterar_senha_form);
                 
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public function Atualizar_Senha_Usuario()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                if (empty($this->alterar_senha_erros)) {
                    $this->senha_nova = password_hash($this->senha_nova, PASSWORD_DEFAULT);
                    
                    if (DAO_Usuario::Atualizar_Senha($this->senha_nova, Login_Session::get_usuario_id()) === false) {
                        $this->alterar_senha_erros[] = "Erro ao tentar Alterar a Senha do Usuario";
                        $this->alterar_senha_campos['erro_senha_antiga'] = "";
                        $this->alterar_senha_campos['erro_senha_nova'] = "";
                        $this->alterar_senha_campos['erro_senha_confnova'] = "";
                    }
                }
                
                if (empty($this->alterar_senha_erros)) {
                    return 'certo';
                } else {
                    $this->alterar_senha_form['senha_antiga'] = $this->senha_antiga;
                    $this->alterar_senha_form['senha_nova'] = $this->senha_nova;
                    $this->alterar_senha_form['senha_confnova'] = $this->senha_confnova;
                    
                    $this->Carregar_Pagina();
                }
            } else {
                return false;
            }
        }
    }
