<?php
namespace Module\Application\Controller\Layout\Elemento;
    
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Orcamento
    {
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
        
        /**
         * Function para alterar o status na base local da entidade para Não Tenho.
         * Assim será mostrado em uma lista diferente estes orçamentos e na listagem principal não aparecera.
         * 
         * @return number|NULL|boolean
         */
        public function SetarOrcamentoNaoTenho()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
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
