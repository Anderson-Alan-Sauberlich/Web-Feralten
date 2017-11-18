<?php
namespace module\application\controller\usuario\meu_perfil\financeiro;
	
	use module\application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	use module\application\model\dao\Plano as DAO_Plano;
	use module\application\model\dao\Entidade as DAO_Entidade;
	use module\application\model\object\Entidade as Object_Entidade;
	use module\application\model\common\util\Login_Session;
	use module\application\model\common\util\Validador;
	use \Exception;
	
    class Meu_Plano {
        
        function __construct() {
            
        }
        
        private $plano_id;
        private $erros;
        
        public function set_plano_id($plano_id) : void {
            try {
                $this->plano_id = Validador::Plano()::validar_id($plano_id);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->plano_id = Validador::Plano()::filtrar_id($plano_id);
            }
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		if ($status != 0) {
        		    $view = new View_Meu_Plano($status, DAO_Plano::BuscarTodos(), Login_Session::get_entidade_plano());
        			
        			$view->Executar();
        		}
        		return $status;
        	} else {
        		return false;
        	}
        }
        
        public function Salvar_Novo_Plano() {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $retorno = array();
                    $retorno['status'] = 'certo';
                    $retorno['erros'] = array();
                    
                    if (empty($this->erros)) {
                        $object_entidade = new Object_Entidade();
                        
                        $object_entidade->set_id(Login_Session::get_entidade_id());
                        $object_entidade->set_plano_id($this->plano_id);
                        $object_entidade->set_intervalo_pagamento_id(1);
                        $object_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                        
                        if (DAO_Entidade::Atualizar_Financeiro($object_entidade)) {
                            Login_Session::set_entidade_plano($this->plano_id);
                        } else {
                            $this->erros[] = 'Erro ao tentar Ativar o novo plano';
                        }
                        
                    }
                    
                    if (!empty($this->erros)) {
                        $retorno['erros'] = $this->erros;
                        $retorno['status'] = 'erro';
                    }
                    
                    echo json_encode($retorno);
                }
                return $status;
            } else {
                return false;
            }
        }
    }
?>