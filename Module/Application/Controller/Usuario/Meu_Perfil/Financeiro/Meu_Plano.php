<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Meu_Plano as View_Meu_Plano;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\Object\Fatura as Object_Fatura;
    use Module\Application\Model\Object\Status_Fatura as Object_Status_Fatura;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Conexao;
    use \DateTime;
    use \DateInterval;
    use \Exception;
    
    class Meu_Plano
    {
        
        function __construct()
        {
            
        }
        
        private $plano_id;
        private $erros;
        
        public function set_plano_id($plano_id) : void
        {
            try {
                $this->plano_id = Validador::Plano()::validar_id($plano_id);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->plano_id = Validador::Plano()::filtrar_id($plano_id);
            }
        }
        
        public function Carregar_Pagina()
        {
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
        
        public function Salvar_Novo_Plano()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $retorno = array();
                    $retorno['status'] = 'certo';
                    $retorno['erros'] = array();
                    
                    if (empty($this->erros)) {
                        $fatura_antiga = DAO_Fatura::BuscarPorCodStatus(Login_session::get_entidade_id(), 1);
                        $fatura_antiga_sts = true;
                        
                        Conexao::$conection->beginTransaction();
                        
                        foreach ($fatura_antiga as $fatura) {
                            if (!DAO_Fatura::Atualizar_Status($fatura->get_id(), 8)) {
                                $fatura_antiga_sts = false;
                            }
                        }
                        
                        if ($fatura_antiga_sts) {
                            $object_fatura = new Object_Fatura();
                            $object_fatura->set_id(0);
                            $object_fatura->set_entidade_id(Login_Session::get_entidade_id());
                            $object_fatura->set_data_emissao(date('Y-m-d H:i:s'));
                            $object_fatura->set_data_vencimento(date('Y-m-d H:i:s'));
                            $object_fatura->set_valor_total(DAO_Plano::BuscarValorMensalPorCOD($this->plano_id));
                            
                            $object_status = new Object_Status_Fatura();
                            $object_status->set_id(2);
                            $object_fatura->set_object_status($object_status);
                            
                            if (DAO_Fatura::Inserir($object_fatura)) {
                                $object_fatura = new Object_Fatura();
                                
                                $object_fatura->set_id(0);
                                $object_fatura->set_entidade_id(Login_Session::get_entidade_id());
                                $object_fatura->set_valor_total(DAO_Plano::BuscarValorMensalPorCOD($this->plano_id));
                                
                                $datetime = new DateTime();
                                $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                                $datetime->add(new DateInterval('P30D'));
                                $object_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
                                
                                $object_status = new Object_Status_Fatura();
                                $object_status->set_id(1);
                                $object_fatura->set_object_status($object_status);
                                
                                if (DAO_Fatura::Inserir($object_fatura)) {
                                    $object_entidade = new Object_Entidade();
                                    $object_entidade->set_id(Login_Session::get_entidade_id());
                                    $object_entidade->set_plano_id($this->plano_id);
                                    $object_entidade->set_intervalo_pagamento_id(1);
                                    $object_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                                    
                                    if (DAO_Entidade::Atualizar_Financeiro($object_entidade)) {
                                        Login_Session::set_entidade_plano($this->plano_id);
                                        Conexao::$conection->commit();
                                    } else {
                                        $this->erros[] = 'Erro ao tentar Ativar novo plano';
                                        Conexao::$conection->rollBack();
                                    }
                                } else {
                                    $this->erros[] = 'Erro ao tentar gerar Fatura';
                                    Conexao::$conection->rollBack();
                                }
                            } else {
                                $this->erros[] = 'Erro ao tentar fechar Fatura';
                                Conexao::$conection->rollBack();
                            }
                        } else {
                            $this->erros[] = 'Erro ao tentar Cancelar fatura antiga';
                            Conexao::$conection->rollBack();
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
