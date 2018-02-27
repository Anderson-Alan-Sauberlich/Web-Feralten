<?php
namespace Module\Application\Controller\Layout\Elemento;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Gerenciar_Imagens;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Model\DAO\Removido as DAO_Removido;
    use Module\Application\Model\Object\Removido as Object_Removido;
    use \Exception;

    class Card_Peca
    {
        function __construct()
        {
            
        }
        
        /**
         * Armazena o ID da Peça.
         * 
         * @var $peca int
         */
        private $peca;
        
        /**
         * Armazena o codigo para verificar se a peça deve ser deletada, o codigo deveria ser 'deletar'.
         * 
         * @var $deletar ?string
         */
        private $deletar;
        
        /**
         * Armazena o status que a peça deve receber.
         * 
         * @var $status ?int
         */
        private $status;
        
        /**
         * Seta o id para a variavel $peca.
         * 
         * @param int $peca
         */
        public function set_peca($peca) : void
        {
            try {
                $this->peca = Validador::Peca()::validar_id($peca);
            } catch (Exception $e) {
                $this->peca = null;
            }
        }
        
        /**
         * Seta o cidogo 'deletar' para a variavel $deletar, caso o usuario tenha escolhido deletar a peça.
         * 
         * @param ?string $deletar
         */
        public function set_deletar($deletar) : void
        {
            $this->deletar = $deletar;
        }
        
        /**
         * Seta o status para a peça que o usuario tiver escolhido.
         * 
         * @param ?int $status
         */
        public function set_status($status) : void
        {
            try {
                $this->status = Validador::Status_Peca()::validar_status_url($status);
            } catch (Exception $e) {
                $this->status = null;
            }
        }
        
        /**
         * Executa todas as opções que o usuario tiver selecionado, inclusive deletar os arquivos das imagens.
         */
        public function Salvar_Alteracoes_Peca() : void
        {
            if (Login_Session::Verificar_Login() AND !empty($this->peca)) {
                if (!empty($this->deletar) AND $this->deletar === 'deletar') {
                    if (DAO_Peca::Deletar($this->peca)) {
                        Gerenciar_Imagens::Deletar_Imagens_Peca($this->peca, Login_Session::get_entidade_id());
                        
                        $entidade = new Object_Entidade();
                        $entidade->set_id(Login_Session::get_entidade_id());
                        
                        $usuario_responsavel = new Object_Usuario();
                        $usuario_responsavel->set_id(Login_Session::get_usuario_id());
                        
                        $object_removido = new Object_Removido();
                        $object_removido->set_object_entidade($entidade);
                        $object_removido->set_object_usuario($usuario_responsavel);
                        $object_removido->set_datahora(date('Y-m-d H:i:s'));
                        
                        DAO_Removido::Inserir($object_removido);
                    }
                } else if (!empty($this->status)) {
                    DAO_Peca::Atualizar_Status($this->peca, $this->status);
                }
            }
        }
    }
