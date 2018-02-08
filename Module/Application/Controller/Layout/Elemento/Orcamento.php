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
        
        private $id_orcamento;
        private $erros = [];
        
        public function set_id_orcamento($id_orcamento) : void
        {
            try {
                $this->id_orcamento = Validador::Orcamento()::validar_id($id_orcamento);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
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
