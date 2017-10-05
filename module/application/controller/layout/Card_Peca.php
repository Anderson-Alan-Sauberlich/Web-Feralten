<?php
namespace module\application\controller\layout;
    
    use module\application\model\common\util\Login_Session;
    use module\application\model\common\util\Validador;
    use module\application\model\common\util\Gerenciar_Imagens;
    use module\application\model\dao\Peca as DAO_Peca;
    use module\application\view\src\layout\Card_Peca as View_Card_Peca;
    use module\application\model\object\Entidade as Object_Entidade;
    use module\application\model\object\Usuario as Object_Usuario;
    use module\application\model\dao\Removido as DAO_Removido;
    use module\application\model\object\Removido as Object_Removido;
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
?>