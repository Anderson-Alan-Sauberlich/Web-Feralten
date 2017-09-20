<?php
namespace application\controller\layout\form;
	
    use application\view\src\layout\form\Contato as View_Contato;
	use application\model\object\Contato as Object_Contato;
	use application\model\common\util\Validador;
	use application\controller\common\util\Email;
	use \Exception;

    class Contato {
		
        function __construct() {
            $this->object_contato = new Object_Contato();
        }
        
        private $object_contato;
        private $campos = array();
        private $erros = array();
        
        public function set_nome($nome) : void {
            try {
                $this->object_contato->set_nome(Validador::Contato()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome'] = "erro";
            }
        }
        
        public function set_email($email) : void {
            try {
                $this->object_contato->set_email(Validador::Contato()::validar_email($email));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        public function set_telefone($telefone) : void {
            try {
                $this->object_contato->set_telefone(Validador::Contato()::validar_telefone($telefone));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['telefone'] = "erro";
            }
        }
        
        public function set_whatsapp($whatsapp) : void {
            try {
                $this->object_contato->set_whatsapp(Validador::Contato()::validar_whatsapp($whatsapp));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['whatsapp'] = "erro";
            }
        }
        
        public function set_assunto($assunto) : void {
            try {
                $this->object_contato->set_assunto(Validador::Contato()::validar_assunto($assunto));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['assunto'] = "erro";
            }
        }
        
        public function set_mensagem($mensagem) : void {
            try {
                $this->object_contato->set_mensagem(Validador::Contato()::validar_mensagem($mensagem));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['mensagem'] = "erro";
            }
        }
        
        public function Carregar_Pagina() : void {
            $view = new View_Contato();
            
            $view->Executar();
        }
        
        public function Enviar_Email() : void {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            $valor['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                if (Email::Enviar_Contato($this->object_contato)) {
                    $valor['status'] = 'certo';
                    $valor['html'] = "<li>Enviado com Sucesso</li>";
                } else {
                    $valor['status'] = 'erro';
                    $valor['html'] = '<li>Erro ao tentar enviar e-mail</li>';
                }
            } else {
                $valor['status'] = 'erro';
                
                foreach ($this->erros as $erro) {
                    $valor['html'] .= "<li>$erro</li>";
                }
            }
            
            echo json_encode($valor);
        }
    }
?>