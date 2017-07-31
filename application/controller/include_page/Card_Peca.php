<?php
namespace application\controller\include_page;
    
    use application\model\common\util\Login_Session;
    use application\model\common\util\Validador;
    use application\model\common\util\Gerenciar_Imagens;
    use application\model\dao\Peca as DAO_Peca;
	use application\view\src\include_page\Card_Peca as View_Card_Peca;
	use \Exception;

    class Card_Peca {
		
        function __construct() {
            
        }
        
        private $peca;
        private $deletar;
        private $status;
        
        public function set_peca($peca) : void {
            try {
                $this->peca = Validador::Peca()::validar_id($peca);
            } catch (Exception $e) {
                $this->peca = null;
            }
        }
        
        public function set_deletar($deletar) : void {
            $this->deletar = $deletar;
        }
        
        public function set_status($status) : void {
            try {
                $this->status = Validador::Status_Peca()::validar_status_url($status);
            } catch (Exception $e) {
                $this->status = null;
            }
        }
        
        public function Salvar_Alteracoes_Peca() : void {
            if (Login_Session::Verificar_Login() AND !empty($this->peca)) {
                if (!empty($this->deletar) AND $this->deletar === 'deletar') {
                    if (DAO_Peca::Deletar($this->peca)) {
                        Gerenciar_Imagens::Deletar_Imagens_Peca($this->peca, Login_Session::get_entidade_id());
                    }
                } else if (!empty($this->status)) {
                    DAO_Peca::Atualizar_Status($this->peca, $this->status);
                }
            }
        }
    }
?>