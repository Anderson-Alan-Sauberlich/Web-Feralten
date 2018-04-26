<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Faturas as View_Faturas;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Transacao as DAO_Transacao;
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\OBJ\Transacao as OBJ_Transacao;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Controller\Common\Util\GerenciarFaturas;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Common\Util\PagSeguro;
    use \Exception;
    
    class Faturas
    {
        function __construct()
        {
            
        }
        
        /**
         * Token do cartão de credito feito pelo pagseguro.
         * 
         * @var string $token
         */
        private $token;
        
        /**
         * Hash do usuario da sessão do browser feito pelo pagseguro.
         * 
         * @var string $hahs
         */
        private $hash;
        
        /**
         * Ip da maquina do usuario.
         * 
         * @var string $ip
         */
        private $ip;
        
        /**
         * Nome do usuario dono do cartão de credito, assim como está no cartão.
         * 
         * @var string $nome;
         */
        private $nome;
        
        /**
         * CPF ou CNPJ do usuario dono do cartão de credito.
         * 
         * @var string $cpf_cnpj
         */
        private $cpf_cnpj;
        
        /**
         * Data de nascimento do usuario dono do cartão de credito.
         * 
         * @var string $nascimento
         */
        private $nascimento;
        
        /**
         * @var array $erros Array com todas as mensagens de erro
         */
        private $erros = [];
        
        /**
         * @var array $sucesso Array com todos as Mensagens de Sucesso
         */
        private $sucessos = [];
        
        /**
         * @var array $campos Array com todos os Status dos Campos do Formulario
         */
        private $campos = [];
        
        /**
         * Seta Tipo da notificação vindo como resposta do pagseguro.
         * 
         * @param string $notificationType
         */
        public function set_notificationType($notificationType) : void
        {
            try {
                $this->notificationType = Validador::Fatura()::validar_notificationType($notificationType);
            } catch (Exception $e) {
                $this->campos['notificationType'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Código da notificação vindo como resposta do pagseguro.
         * 
         * @param string $notificationCode
         */
        public function set_notificationCode($notificationCode) : void
        {
            try {
                $this->notificationCode = Validador::Fatura()::validar_notificationCode($notificationCode);
            } catch (Exception $e) {
                $this->campos['notificationCode'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Token do cartão de credito feito pelo pagseguro.
         * 
         * @param string $token
         */
        public function set_token($token) : void
        {
            try {
                $this->token = Validador::Fatura()::validar_token($token);
            } catch (Exception $e) {
                $this->campos['token'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Hash do usuario da sessão do browser feito pelo pagseguro.
         * 
         * @param string $hash
         */
        public function set_hash($hash) : void
        {
            try {
                $this->hash = Validador::Fatura()::validar_hash($hash);
            } catch (Exception $e) {
                $this->campos['hash'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Ip da maquina do usuario.
         * 
         * @param string $ip
         */
        public function set_ip($ip) : void
        {
            try {
                //$this->ip = Validador::Fatura()::validar_ip($ip);
                $this->ip = '127.0.0.0';
            } catch (Exception $e) {
                $this->campos['ip'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Nome do usuario dono do cartão de credito, assim como está no cartão.
         * 
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            try {
                $this->nome = Validador::Fatura()::validar_nome($nome);
            } catch (Exception $e) {
                $this->campos['nome'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta CPF ou CNPJ do usuario dono do cartão de credito.
         * 
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj($cpf_cnpj) : void
        {
            try {
                //pagseguro por enquanto só aceita pagamento com cpf.
                //$this->cpf_cnpj = Validador::Fatura()::validar_cpf_cnpj($cpf_cnpj);
                $this->cpf_cnpj = Validador::Fatura()::validar_cpf($cpf_cnpj);
            } catch (Exception $e) {
                $this->campos['cpf_cnpj'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Seta Data de nascimento do usuario dono do cartão de credito.
         * 
         * @param string $nascimento
         */
        public function set_nascimento($nascimento) : void
        {
            try {
                $this->nascimento = Validador::Fatura()::validar_nascimento($nascimento);
            } catch (Exception $e) {
                $this->campos['nascimento'] = 'erro';
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Instancia e Abre a View
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status != 0) {
                    $view = new View_Faturas($status);
                    
                    $fatura_aberta = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 1);
                    
                    if (!empty($fatura_aberta)) {
                        $view->set_fatura_aberta($fatura_aberta);
                    }
                    
                    $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 16);
                    
                    if (empty($fatura_fechada)) {
                        $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 32);
                        
                        if (empty($fatura_fechada)) {
                            $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 128);
                            
                            if (empty($fatura_fechada)) {
                                $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 2);
                            }
                        }
                    }
                    
                    if (!empty($fatura_fechada)) {
                        $view->set_fatura_fechada($fatura_fechada);
                    }
                    
                    $pagseguro = new PagSeguro();
                    
                    $view->set_pagseguro_sessao_id($pagseguro->getIdSessao());
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Recebe os dados de pagamento do formulario de pagamento com cartão de credito e realiza o pagamento com PagSeguro.
         */
        public function PagarPagSeguroCredito() : void
        {
            if (empty($this->erros)) {
                $pagseguro = new PagSeguro();
                
                $endereco = DAO_Endereco::Buscar_Por_Id_Entidade(Login_Session::get_entidade_id());
                if ($endereco instanceof OBJ_Endereco) {
                    $pagseguro->set_billing($endereco);
                }
                
                $pagseguro->set_token($this->token);
                $pagseguro->set_hash($this->hash);
                $pagseguro->set_nome($this->nome);
                $pagseguro->set_usuario_cpf_cnpj($this->cpf_cnpj);
                $pagseguro->set_birthdate($this->nascimento);
                $pagseguro->set_ip($this->ip);
                
                $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 16);
                
                if (empty($fatura_fechada)) {
                    $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 32);
                    
                    if (empty($fatura_fechada)) {
                        $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 2);
                    }
                }
                
                if (!empty($fatura_fechada)) {
                    $pagseguro->set_reference($fatura_fechada->get_id());
                    $pagseguro->set_total($fatura_fechada->get_valor_total());
                    
                    $fatura_servicos_fechada = DAO_Fatura_Servico::BuscarPorCOD($fatura_fechada->get_id());
                    
                    if (!empty($fatura_servicos_fechada) AND $fatura_servicos_fechada != false) {
                        $pagseguro->set_servicos($fatura_servicos_fechada);
                    }
                }
                
                $entidade = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
                if ($entidade instanceof OBJ_Entidade) {
                    $pagseguro->set_entidade_cpf_cnpj($entidade->get_cpf_cnpj());
                }
                
                $usuario = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
                if ($usuario instanceof OBJ_Usuario) {
                    $pagseguro->set_email($usuario->get_email());
                    $pagseguro->set_fone($usuario->get_fone());
                }
                
                if ($pagseguro->pagarCredito()) {
                    DAO_Fatura::Atualizar_Status($fatura_fechada->get_id(), 128);
                    $this->sucessos[] = 'Dados de pagamentos recebidos com sucesso! Em breve o pagamento será confirmado.';
                } else {
                    $this->erros[] = 'Erro ao tentar enviar solicitação de pagamento';
                }
            }
            
            $retorno['erros'] = View_Faturas::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Faturas::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            
            echo json_encode($retorno);
        }
        
        /**
         * Recebe os dados de pagamento do formulario de pagamento com debito online e realiza o pagamento com PagSeguro.
         */
        public function PagarPagSeguroDebito() : void
        {
            if (empty($this->erros)) {
                $pagseguro = new PagSeguro();
                
                $pagseguro->pagarDebito();
            }
        }
        
        /**
         * Recebe os dados de pagamento do formulario de pagamento com boleto bancario e realiza o pagamento com PagSeguro.
         */
        public function PagarPagSeguroBoleto() : void
        {
            $link_boleto = '';
            
            if (empty($this->erros)) {
                $pagseguro = new PagSeguro();
                
                $pagseguro->set_hash($this->hash);
                $pagseguro->set_ip($this->ip);
                
                $entidade = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
                if ($entidade instanceof OBJ_Entidade) {
                    $pagseguro->set_entidade_cpf_cnpj($entidade->get_cpf_cnpj());
                }
                
                $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 16);
                if (empty($fatura_fechada)) {
                    $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 32);
                    
                    if (empty($fatura_fechada)) {
                        $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 2);
                    }
                }
                
                if (!empty($fatura_fechada)) {
                    $pagseguro->set_reference($fatura_fechada->get_id());
                    $pagseguro->set_total($fatura_fechada->get_valor_total());
                    
                    $fatura_servicos_fechada = DAO_Fatura_Servico::BuscarPorCOD($fatura_fechada->get_id());
                    
                    if (!empty($fatura_servicos_fechada) AND $fatura_servicos_fechada != false) {
                        $pagseguro->set_servicos($fatura_servicos_fechada);
                    }
                }
                
                $usuario = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
                if ($usuario instanceof OBJ_Usuario) {
                    $pagseguro->set_nome($usuario->get_nome().' '.$usuario->get_sobrenome());
                    $pagseguro->set_email($usuario->get_email());
                    $pagseguro->set_fone($usuario->get_fone());
                }
                
                $link_boleto = $pagseguro->pagarBoleto();
                if (!empty($link_boleto)) {
                    DAO_Fatura::Atualizar_Status($fatura_fechada->get_id(), 128);
                    $this->sucessos[] = 'Boleto gerado com sucesso! o pagamento será confirmado em até 3 dias após o pagamento.';
                } else {
                    $this->erros[] = 'Erro ao tentar gerar solicitação de pagamento';
                }
            }
            
            $retorno['erros'] = View_Faturas::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Faturas::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            $retorno['link_boleto'] = $link_boleto;
            
            echo json_encode($retorno);
        }
        
        /**
         * Recebe o retorno do pagseguro para informar que o pagamento foi aprovado ou não.
         * Achar documentação: https://pagseguro.uol.com.br/v2/guia-de-integracao/consulta-de-transacoes-por-codigo.html#!rmcl
         */
        public function RespostaPagSeguro() : void
        {
            $pagseguro = new PagSeguro();
            
            $response = $pagseguro->esperarResposta();
            
            if (!empty($response)) {
                $obj_fatura = DAO_Fatura::BuscarPorCOD($response->getReference());
                
                if (!empty($obj_fatura)) {
                    $obj_transacao = new OBJ_Transacao();
                    
                    if ($response->getPaymentMethod()->getType() == 1) {
                        $obj_transacao->set_forma_pagamento('Crédito');
                    } else if ($response->getPaymentMethod()->getType() == 2) {
                        $obj_transacao->set_forma_pagamento('Boleto');
                    } else if ($response->getPaymentMethod()->getType() == 3) {
                        $obj_transacao->set_forma_pagamento('Débito');
                    }
                    
                    /**
                     * Id do status da fatura.
                     * 
                     * @var ?int $fatura_status_id
                     */
                    $fatura_status_id = null;
                    
                    if ($response->getStatus() == 1) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 128) {
                            $obj_transacao->set_status('Aguardado Confirmação de Pagamento');
                            $fatura_status_id = 128; //Aguardado Confirmação de Pagamento.
                        }
                    } else if ($response->getStatus() == 2) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 128) {
                            $obj_transacao->set_status('Em análise');
                            $fatura_status_id = 128; //Aguardado Confirmação de Pagamento.
                        }
                    } else if ($response->getStatus() == 3) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 4) {
                            $obj_transacao->set_status('Paga');
                            $fatura_status_id = 4; //Paga.
                        }
                    } else if ($response->getStatus() == 4) {
                        if ($obj_fatura->get_obj_status()->get_id() === 128 ||
                            $obj_fatura->get_obj_status()->get_id() === 2 ||
                            $obj_fatura->get_obj_status()->get_id() === 16 ||
                            $obj_fatura->get_obj_status()->get_id() === 32) {
                            
                            $obj_transacao->set_status('Disponível');
                            $fatura_status_id = 4; //Paga.
                        }
                    } else if ($response->getStatus() == 5) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 128) {
                            $obj_transacao->set_status('Em disputa');
                            $fatura_status_id = 128; //Aguardado Confirmação de Pagamento.
                        }
                    } else if ($response->getStatus() == 6) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 64) {
                            $obj_transacao->set_status('Devolvida');
                            $fatura_status_id = 64; //Reembolsada.
                        }
                    } else if ($response->getStatus() == 7) {
                        if ($obj_fatura->get_obj_status()->get_id() !== 8) {
                            $obj_transacao->set_status('Cancelada');
                            $fatura_status_id = 8; //Cancelada.
                        }
                    }
                    
                    $obj_transacao->set_fatura_id($obj_fatura->get_id());
                    $obj_transacao->set_datahora(date_format(date_create($response->getDate()), 'Y-m-d H:i:s'));
                    $obj_transacao->set_valor($response->getGrossAmount());
                    $obj_transacao->set_pags_codigo($response->getCode());
                    
                    if (!empty($fatura_status_id)) {
                        if (DAO_Transacao::Inserir($obj_transacao)) {
                            if (DAO_Fatura::Atualizar_Status($obj_fatura->get_id(), $fatura_status_id)) {
                                if ($fatura_status_id === 4) {
                                    $entidade = DAO_Entidade::BuscarPorCOD($obj_fatura->get_entidade_id());
                                    if ($entidade instanceof OBJ_Entidade) {
                                        //Status 2 = Pagamento Atrasado
                                        if ($entidade->get_status_id() === 2) {
                                            DAO_Entidade::Atualizar_Status($fatura->get_entidade_id(), 1); // Status 1 = Ok
                                            
                                            GerenciarFaturas::Cancelar_Fatura_Aberta($entidade->get_id());
                                            
                                            GerenciarFaturas::Criar_Fatura($entidade->get_id(), $entidade->get_plano_id(), GerenciarFaturas::MENSAL);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
