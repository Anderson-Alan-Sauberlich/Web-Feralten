<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Faturas as View_Faturas;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
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
         * CPF do usuario dono do cartão de credito.
         * 
         * @var string $cpf
         */
        private $cpf;
        
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
         * Seta CPF do usuario dono do cartão de credito.
         * 
         * @param string $cpf
         */
        public function set_cpf($cpf) : void
        {
            try {
                $this->cpf = Validador::Fatura()::validar_cpf($cpf);
            } catch (Exception $e) {
                $this->campos['cpf'] = 'erro';
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
                        
                        $fatura_servicos_aberta = DAO_Fatura_Servico::BuscarPorCOD($fatura_aberta->get_id());
                        
                        if (!empty($fatura_servicos_aberta) AND $fatura_servicos_aberta != false) {
                            $view->set_fatura_servicos_aberta($fatura_servicos_aberta);
                        }
                    }
                    
                    $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 16);
                    
                    if (empty($fatura_fechada)) {
                        $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 32);
                        
                        if (empty($fatura_fechada)) {
                            $fatura_fechada = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 2);
                        }
                    }
                    
                    if (!empty($fatura_fechada)) {
                        $view->set_fatura_fechada($fatura_fechada);
                        
                        $fatura_servicos_fechada = DAO_Fatura_Servico::BuscarPorCOD($fatura_fechada->get_id());
                        
                        if (!empty($fatura_servicos_fechada) AND $fatura_servicos_fechada != false) {
                            $view->set_fatura_servicos_fechada($fatura_servicos_fechada);
                        }
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
                $pagseguro->set_cpf_cnpj($this->cpf);
                $pagseguro->set_birthdate($this->nascimento);
                $pagseguro->set_ip($this->ip);
                
                $fatura_aberta = GerenciarFaturas::Retornar_Fatura(Login_Session::get_entidade_id(), 1);
                
                if (!empty($fatura_aberta)) {
                    $pagseguro->set_reference('fatura_'.$fatura_aberta->get_id().'_credito');
                    $pagseguro->set_total($fatura_aberta->get_valor_total());
                    
                    $fatura_servicos_aberta = DAO_Fatura_Servico::BuscarPorCOD($fatura_aberta->get_id());
                    
                    if (!empty($fatura_servicos_aberta) AND $fatura_servicos_aberta != false) {
                        $pagseguro->set_servicos($fatura_servicos_aberta);
                    }
                }
                
                $usuario = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
                if ($usuario instanceof OBJ_Usuario) {
                    $pagseguro->set_email($usuario->get_email());
                    $pagseguro->set_fone($usuario->get_fone());
                }
                
                $pagseguro->pagarCredito();
            }
            
            $retorno['erros'] = View_Faturas::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Faturas::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            
            echo json_encode($retorno);
        }
        
        public function PagarPagSeguroDebito() : void
        {
            if (empty($this->erros)) {
                $pagseguro = new PagSeguro();
                
                $pagseguro->pagarDebito();
            }
        }
        
        public function PagarPagSeguroBoleto() : void
        {
            if (empty($this->erros)) {
                $pagseguro = new PagSeguro();
                
                $pagseguro->pagarBoleto();
            }
        }
    }
