<?php
namespace application\controller\include_page\form;

    use application\model\object\Contato_Anunciante as Object_Contato_Anunciante;
    use application\model\dao\Contato_Anunciante as DAO_Contato_Anunciante;
    use application\model\dao\Peca as DAO_Peca;
    use application\model\common\util\Validador;
	use application\view\src\include_page\form\Contato_Anunciante as View_Contato_Anunciante;
	use \Exception;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception as Mail_Exception;
	
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
        
        public function set_peca_id($peca_id) : void {
            try {
                $this->object_contato_anunciante->set_object_peca(DAO_Peca::BuscarPorCOD(Validador::Contato_Anunciante()::validar_peca_id($peca_id)));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina() : void {
            $view = new View_Contato_Anunciante();
            
            $view->set_peca_id($this->object_contato_anunciante->get_object_peca()->get_id());
            
            $view->Executar();
        }
        
        public function Enviar_Email() : void {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            
            if (empty($this->erros)) {
                $mail = new PHPMailer(true);
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'contato.feralten@gmail.com';
                    $mail->Password = 'Abar$ore%FJ#12';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    
                    //Recipients
                    $mail->setFrom('contato.feralten@gmail.com', 'Feralten');
                    $mail->addAddress($this->object_contato_anunciante->get_object_peca()->get_responsavel()->get_email());
                    $mail->addReplyTo('contato.feralten@gmail.com', 'Feralten');
                    $mail->addCC('contato.feralten@gmail.com');
                    
                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Feralten - Nova mensagem de '.$this->object_contato_anunciante->get_nome();
                    $mail->Body    = $this->object_contato_anunciante->get_mensagem();
                    $mail->AltBody = 'Sauber Sistemas - ©2017 Feralten. Todos os direitos reservados.';
                    
                    if ($mail->send()) {
                        $valor['status'] = 'certo';
                        $valor['html'] = "<li>Enviado com Sucesso</li>";
                    } else {
                        $valor['status'] = 'erro';
                        $valor['html'] = '<li>Erro ao tentar enviar e-mail</li>';
                    }
                } catch (Mail_Exception $e) {
                    $valor['status'] = 'erro';
                    $valor['html'] = $mail->ErrorInfo;
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