<?php
namespace Module\Application\Controller\Layout\Form;

    use Module\Application\Model\Object\Contato_Anunciante as Object_Contato_Anunciante;
    use Module\Application\Model\DAO\Contato_Anunciante as DAO_Contato_Anunciante;
    use Module\Application\Controller\Common\Util\Email;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante;
    use \Exception;
    
    class Contato_Anunciante
    {
        
        function __construct()
        {
            $this->object_contato_anunciante = new Object_Contato_Anunciante();
        }
        
        private $object_contato_anunciante;
        private $campos = array();
        private $erros = array();
        
        public function set_nome($nome) : void
        {
            try {
                $this->object_contato_anunciante->set_nome(Validador::Contato_Anunciante()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome'] = "erro";
            }
        }
        
        public function set_email($email) : void
        {
            try {
                $this->object_contato_anunciante->set_email(Validador::Contato_Anunciante()::validar_email($email));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        public function set_telefone($telefone) : void
        {
            try {
                $this->object_contato_anunciante->set_telefone(Validador::Contato_Anunciante()::validar_telefone($telefone));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['telefone'] = "erro";
            }
        }
        
        public function set_whatsapp($whatsapp) : void
        {
            try {
                $this->object_contato_anunciante->set_whatsapp(Validador::Contato_Anunciante()::validar_whatsapp($whatsapp));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['whatsapp'] = "erro";
            }
        }
        
        public function set_mensagem($mensagem) : void
        {
            try {
                $this->object_contato_anunciante->set_mensagem(Validador::Contato_Anunciante()::validar_mensagem($mensagem));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['mensagem'] = "erro";
            }
        }
        
        public function set_peca_id($peca_id) : void
        {
            try {
                $this->object_contato_anunciante->set_object_peca(DAO_Peca::BuscarPorCOD(Validador::Contato_Anunciante()::validar_peca_id($peca_id)));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Contato_Anunciante();
            
            $view->set_peca_id($this->object_contato_anunciante->get_object_peca()->get_id());
            
            $view->Executar();
        }
        
        public function Enviar_Email() : void
        {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            $valor['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                if (Email::Enviar_Contato_Anunciante($this->object_contato_anunciante)) {
                    $this->object_contato_anunciante->set_datahora_envio(date('Y-m-d H:i:s'));
                    $this->object_contato_anunciante->set_lido(false);
                    
                    DAO_Contato_Anunciante::Inserir($this->object_contato_anunciante);
                    
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
