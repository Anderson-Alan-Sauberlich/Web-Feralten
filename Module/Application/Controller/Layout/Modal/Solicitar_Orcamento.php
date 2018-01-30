<?php
namespace Module\Application\Controller\Layout\Modal;
    
    use Module\Application\View\SRC\Layout\Modal\Solicitar_Orcamento as View_Solicitar_Orcamento;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Administration\Model\Common\Util\Login_Session;
    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use \Exception;
    use \DateTime;
    use \DateInterval;
                                  
    class Solicitar_Orcamento
    {
        function __construct()
        {
            $this->obj_orcamento = new Object_Orcamento();
        }
        
        private $obj_orcamento;
        private $erros = [];
        
        public function set_categoria_id($categoria_id) : void
        {
            try {
                $this->obj_orcamento->set_categoria_id(Validador::Orcamento()::validar_categoria_id($categoria_id));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_marca_id($marca_id) : void
        {
            try {
                $this->obj_orcamento->set_marca_id(Validador::Orcamento()::validar_marca_id($marca_id));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_modelo_id($modelo_id) : void
        {
            try {
                $this->obj_orcamento->set_modelo_id(Validador::Orcamento()::validar_modelo_id($modelo_id));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_versao_id($versao_id) : void
        {
            try {
                $this->obj_orcamento->set_versao_id(Validador::Orcamento()::validar_versao_id($versao_id));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_ano_de($ano_de) : void
        {
            try {
                $this->obj_orcamento->set_ano_de(Validador::Orcamento()::validar_ano_de($ano_de));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_ano_ate($ano_ate) : void
        {
            try {
                $this->obj_orcamento->set_ano_ate(Validador::Orcamento()::validar_ano_de($ano_ate));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_nome($nome) : void
        {
            try {
                $this->obj_orcamento->set_peca_nome(Validador::Orcamento()::validar_nome($nome));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_numero_serie($numero_serie) : void
        {
            try {
                $this->obj_orcamento->set_numero_serie(Validador::Orcamento()::validar_serie($numero_serie));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_estado_uso($estado_uso) : void
        {
            try {
                $this->obj_orcamento->set_estado_uso_id(Validador::Orcamento()::validar_estado_uso($estado_uso));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_preferencia_entrega($preferencia_entrega) : void
        {
            try {
                $this->obj_orcamento->set_preferencia_entrega_id(Validador::Orcamento()::validar_preferencia_entrega($preferencia_entrega));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function set_descricao($descricao) : void
        {
            try {
                $this->obj_orcamento->set_descricao(Validador::Orcamento()::validar_descricao($descricao));
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina() : void
        {
            $view = new View_Solicitar_Orcamento();
            
            $view->Executar();
        }
        
        public function Criar_Orcamento() : void
        {
            $retorno['status'] = '';
            $retorno['content'] = '';
            
            if (empty($this->erros)) {
                if (Controller_Usuario::Verificar_Autenticacao()) {
                    $datetime = new DateTime();
                    $this->obj_orcamento->set_datahora_solicitacao($datetime->format('Y-m-d H:i:s'));
                    $datetime->add(new DateInterval('P60D'));
                    $this->obj_orcamento->set_datahora_validade($datetime->format('Y-m-d H:i:s'));
                    $this->obj_orcamento->set_usuario_id(Login_Session::get_usuario_id());
                    
                    if (DAO_Orcamento::Inserir($this->obj_orcamento)) {
                        $retorno['status'] = 'certo';
                        $retorno['content'] = "<li>Sua Solicitação de Orçamento foi enviada com sucesso para todos os clientes do Feralten.</li>";
                    } else {
                        $retorno['status'] = 'erro';
                        $retorno['content'] .= "<li>Erro ao tentar criar um covo orçamento</li>";
                    }
                } else {
                    $retorno['status'] = 'erro';
                    $retorno['content'] .= "<li>Você deve estar autenticado</li>";
                }
            } else {
                $retorno['status'] = 'erro';
                
                foreach ($this->erros as $erro) {
                    $retorno['content'] .= "<li>$erro</li>";
                }
            }
            
            echo json_encode($retorno);
        }
    }
