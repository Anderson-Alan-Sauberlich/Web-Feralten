<?php
namespace application\controller\include_page\form;

    use application\model\object\Contato_Anunciante as Object_Contato_Anunciante;
    use application\model\dao\Contato_Anunciante as DAO_Contato_Anunciante;
    use application\model\common\util\Validador;
	use application\view\src\include_page\form\Contato_Anunciante as View_Contato_Anunciante;
	use \Exception;
	
    class Contato_Anunciante {
		
        function __construct() {
            $this->object_contato_anunciante = new Object_Contato_Anunciante();
        }
        
        private $object_contato_anunciante;
        private $campos = array();
        private $erros = array();
        
        public function set_nome($nome) : void {
            try {
                $this->object_contato_anunciante->set_nome(Validador::Contato_Anunciante()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_nome'] = "erro";
            }
        }
        
        public function set_email($email) : void {
            try {
                $this->object_contato_anunciante->set_email(Validador::Contato_Anunciante()::validar_email($email));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_email'] = "erro";
            }
        }
        
        public function set_telefone($telefone) : void {
            try {
                $this->object_contato_anunciante->set_telefone(Validador::Contato_Anunciante()::validar_telefone($telefone));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_telefone'] = "erro";
            }
        }
        
        public function set_whatsapp($whatsapp) : void {
            try {
                $this->object_contato_anunciante->set_whatsapp(Validador::Contato_Anunciante()::validar_whatsapp($whatsapp));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_whatsapp'] = "erro";
            }
        }
        
        public function set_mensagem($mensagem) : void {
            try {
                $this->object_contato_anunciante->set_mensagem(Validador::Contato_Anunciante()::validar_mensagem($mensagem));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['erro_mensagem'] = "erro";
            }
        }
        
        public function Carregar_Pagina() : void {
            $view = new View_Contato_Anunciante();
        }
        
        public function Enviar_Email() : void {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            
            if (empty($this->erros)) {
                $to = $this->object_contato_anunciante->get_email();
                $subject = "Feralten - Nova Mensagem de ".$this->object_contato_anunciante->get_nome();
                $txt = $this->object_contato_anunciante->get_mensagem();
                $headers = "From: contato.feralten@gmail.com" . "\r\n" .
                    "CC: contato.feralten@gmail.com";
                
                mail($to,$subject,$txt,$headers);
                
                $valor['status'] = 'certo';
                $valor['html'] .= "<li>Enviado com Sucesso!</li>";
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