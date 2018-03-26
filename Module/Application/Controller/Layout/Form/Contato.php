<?php
namespace Module\Application\Controller\Layout\Form;
    
    use Module\Application\View\SRC\Layout\Form\Contato as View_Contato;
    use Module\Application\Model\OBJ\Contato as OBJ_Contato;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Email\Controller\Common\Util\Email;
    use \Exception;

    class Contato
    {
        /**
         * Inicia a variavel $obj_contato.
         */
        function __construct()
        {
            $this->obj_contato = new OBJ_Contato();
        }
        
        /**
         * Armazena os dados de uma instancia OBJ_Contato.
         * 
         * @var OBJ_Contato
         */
        private $obj_contato;
        
        /**
         * Armazena todos os campos com erro.
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
         * Seta o nome para a variavel $obj_contato.
         * 
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            try {
                $this->obj_contato->set_nome(Validador::Contato()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome'] = "erro";
            }
        }
        
        /**
         * Seta o email para a variavel $obj_contato.
         * 
         * @param string $email
         */
        public function set_email($email) : void
        {
            try {
                $this->obj_contato->set_email(Validador::Contato()::validar_email($email));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = "erro";
            }
        }
        
        /**
         * Seta o numero de telefone para a variavel $obj_contato.
         * 
         * @param string $telefone
         */
        public function set_telefone($telefone) : void
        {
            try {
                $this->obj_contato->set_telefone(Validador::Contato()::validar_telefone($telefone));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['telefone'] = "erro";
            }
        }
        
        /**
         * Seta true se o telefone for whatsapp e false se não for para a variavel $obj_contato.
         * 
         * @param ?bool $whatsapp
         */
        public function set_whatsapp($whatsapp) : void
        {
            try {
                $this->obj_contato->set_whatsapp(Validador::Contato()::validar_whatsapp($whatsapp));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['whatsapp'] = "erro";
            }
        }
        
        /**
         * Seta o assunto para a variavel $obj_contato.
         * 
         * @param string $assunto
         */
        public function set_assunto($assunto) : void
        {
            try {
                $this->obj_contato->set_assunto(Validador::Contato()::validar_assunto($assunto));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['assunto'] = "erro";
            }
        }
        
        /**
         * Seta a mensagen para a variavel $obj_contato.
         * 
         * @param string $mensagem
         */
        public function set_mensagem($mensagem) : void
        {
            try {
                $this->obj_contato->set_mensagem(Validador::Contato()::validar_mensagem($mensagem));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['mensagem'] = "erro";
            }
        }
        
        /**
         * Carrega uma pagina abrindo uma nova view.
         */
        public function Carregar_Pagina() : void
        {
            $view = new View_Contato();
            
            $view->Executar();
        }
        
        /**
         * Function para enviar o email.
         * Echo de json com campos e mensagens de erro e sucesso.
         */
        public function Enviar_Email() : void
        {
            $valor = array();
            $valor['status'] = '';
            $valor['html'] = '';
            $valor['campos'] = $this->campos;
            
            if (empty($this->erros)) {
                if (Email::Enviar_Contato($this->obj_contato)) {
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
