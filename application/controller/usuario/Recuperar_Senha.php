<?php
namespace application\controller\usuario;
	
	use application\view\src\usuario\Recuperar_Senha as View_Recuperar_Senha;
	use application\model\object\Recuperar_Senha as Object_Recuperar_Senha;
	use application\model\dao\Recuperar_Senha as DAO_Recuperar_Senha;
	use application\model\dao\Usuario as DAO_Usuario;
	use application\controller\common\util\Email;
	use application\model\common\util\Validador;
	use \Exception;
	
    class Recuperar_Senha {

        function __construct() {
            $this->object_recuperar_senha = new Object_Recuperar_Senha();
        }
        
        private $object_recuperar_senha;
        private $campos = array();
        private $erros = array();
        
        public function set_email($email) : void {
            try {
                $this->object_recuperar_senha->set_object_usuario(DAO_Usuario::Autenticar(Validador::Usuario()::validar_email_login($email)));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        public function Carregar_Pagina() : void {
        	$view = new View_Recuperar_Senha();
        	
        	$view->Executar();
        }
        
        public function Enviar_Link_Email() : void {
            $valor = array();
            $valor['status'] = '';
            $valor['header'] = '';
            $valor['content'] = '';
            $valor['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                $this->object_recuperar_senha->set_codigo(bin2hex(random_bytes(40)));
                
                if (Email::Enviar_Recuperar_Senha($this->object_recuperar_senha)) {
                    $this->object_recuperar_senha->set_data_hora(date('Y-m-d H:i:s'));
                    
                    if (DAO_Recuperar_Senha::Inserir($this->object_recuperar_senha)) {
                        $valor['status'] = 'certo';
                        $valor['header'] = '<h3>Enviado com Sucesso</h3>';
                        $valor['content'] = '<p>Link enviado com sucesso para sua conta de E-Mail!</p>
                                             <p>Verifique seus e-mails e siga os passos sugeridos para criar uma nova senha.</p>';
                    } else {
                        $valor['status'] = 'erro';
                        $valor['header'] = '<h3>Erro ao tentar salvar código</h3>';
                        $valor['content'] = '<p>Desculpe, servidor de Banco de Dados Offline</p>';
                    }
                } else {
                    $valor['status'] = 'erro';
                    $valor['header'] = '<h3>Erro ao tentar enviar e-mail</h3>';
                    $valor['content'] = '<p>Desculpe, servidor de e-mail Offline</p>';
                }
            } else {
                $valor['status'] = 'erro';
                $valor['header'] = '<h3>Erro ao tentar enviar e-mail</h3>';
                
                foreach ($this->erros as $erro) {
                    $valor['content'] .= "<p>$erro</p>";
                }
            }
            
            echo json_encode($valor);
        }
    }
?>