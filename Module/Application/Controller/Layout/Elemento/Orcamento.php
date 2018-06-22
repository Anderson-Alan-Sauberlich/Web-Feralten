<?php
namespace Module\Application\Controller\Layout\Elemento;
    
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Orcamento
    {
        /**
         * @const Parametro Funcionalidade
         */
        public const MEUS_ORCAMENTOS = 'meus-orcamentos';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const CAIXA_DE_ENTRADA = 'caixa-de-entrada';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const RESPONDIDOS = 'respondidos';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const NAO_TENHO = 'nao-tenho';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const ORCAMENTOS = 'orcamentos';
        
        function __construct()
        {
            
        }
        
        /**
         * Armazena o id do orçamento.
         * 
         * @var int
         */
        private $id_orcamento;
        
        /**
         * Armazena as mensagens de erro.
         * 
         * @var array
         */
        private $erros = [];
        
        /**
         * Seta o id do orçamento para a variavel $id_orcamento.
         * 
         * @param int $id_orcamento
         */
        public function set_id_orcamento($id_orcamento) : void
        {
            try {
                $this->id_orcamento = Validador::Orcamento()::validar_id($id_orcamento);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina()
        {
            $view = $this->Retornar_Pagina();
            
            $view->Executar();
        }
        
        public function Retornar_Pagina() : View_Orcamento
        {
            $view = new View_Orcamento();
            
            return $view;
        }
        
        /**
         * Function para alterar o status na base local da entidade para Não Tenho.
         * Assim será mostrado em uma lista diferente estes orçamentos e na listagem principal não aparecera.
         * 
         * @return number|NULL|boolean
         */
        public function SetarOrcamentoNaoTenho()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (empty($this->erros)) {
                        $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                        
                        $obj_entidade_bd->SetarStatusOrcamento($this->id_orcamento, Entidade_BD::NAO_TENHO);
                    }
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
