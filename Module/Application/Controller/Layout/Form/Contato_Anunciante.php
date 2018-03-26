<?php
namespace Module\Application\Controller\Layout\Form;

    use Module\Application\Model\OBJ\Contato_Anunciante as OBJ_Contato_Anunciante;
    use Module\Application\Model\DAO\Contato_Anunciante as DAO_Contato_Anunciante;
    use Module\Email\Controller\Common\Util\Email;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante;
    use \Exception;
    
    class Contato_Anunciante
    {
        /**
         * Inicia a variavel $obj_contato_anunciante.
         */
        function __construct()
        {
            $this->obj_contato_anunciante = new OBJ_Contato_Anunciante();
        }
        
        /**
         * Armazena o objeto contato anunciante.
         * 
         * @var OBJ_Contato_Anunciante
         */
        private $obj_contato_anunciante;
        
        /**
         * Armazena todos os campos com erros.
         * 
         * @var array
         */
        private $campos = [];
        
        /**
         * Armazena todas as mensagens de erro.
         * 
         * @var array
         */
        private $erros = [];
        
        /**
         * Seta o nome para a variavel $obj_contato_anunciante.
         * 
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            try {
                $this->obj_contato_anunciante->set_nome(Validador::Contato_Anunciante()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome'] = "erro";
            }
        }
        
        /**
         * seta o email para a variavel $obj_contato_anunciante.
         * 
         * @param string $email
         */
        public function set_email($email) : void
        {
            try {
                $this->obj_contato_anunciante->set_email(Validador::Contato_Anunciante()::validar_email($email));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        /**
         * Seta o numero de telefone para a variavel $obj_contato_anunciante.
         * 
         * @param string $telefone
         */
        public function set_telefone($telefone) : void
        {
            try {
                $this->obj_contato_anunciante->set_telefone(Validador::Contato_Anunciante()::validar_telefone($telefone));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['telefone'] = "erro";
            }
        }
        
        /**
         * Seta true se o numero de telefone for whatsapp e false se não for na variavel $obj_contato_anunciante.
         * 
         * @param ?bool $whatsapp
         */
        public function set_whatsapp($whatsapp) : void
        {
            try {
                $this->obj_contato_anunciante->set_whatsapp(Validador::Contato_Anunciante()::validar_whatsapp($whatsapp));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['whatsapp'] = "erro";
            }
        }
        
        /**
         * Seta a mensagem para a variavel $obj_contato_anunciante.
         * 
         * @param string $mensagem
         */
        public function set_mensagem($mensagem) : void
        {
            try {
                $this->obj_contato_anunciante->set_mensagem(Validador::Contato_Anunciante()::validar_mensagem($mensagem));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['mensagem'] = "erro";
            }
        }
        
        /**
         * Seta o id da peça para a variavel $obj_contato_anunciante.
         * 
         * @param int $peca_id
         */
        public function set_peca_id($peca_id) : void
        {
            try {
                $this->obj_contato_anunciante->set_obj_peca(DAO_Peca::BuscarPorCOD(Validador::Contato_Anunciante()::validar_peca_id($peca_id)));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Carrega a pagina abrindo uma nova view.
         */
        public function Carregar_Pagina() : void
        {
            $view = new View_Contato_Anunciante();
            
            $view->set_peca_id($this->obj_contato_anunciante->get_obj_peca()->get_id());
            
            $view->Executar();
        }
        
        /**
         * Realiza o envio do email.
         * Echo de json com os campos e mensagens de erro e sucesso.
         */
        public function Enviar_Email() : void
        {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            $valor['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                if (Email::Enviar_Contato_Anunciante($this->obj_contato_anunciante)) {
                    $this->obj_contato_anunciante->set_datahora_envio(date('Y-m-d H:i:s'));
                    $this->obj_contato_anunciante->set_lido(false);
                    
                    DAO_Contato_Anunciante::Inserir($this->obj_contato_anunciante);
                    
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
