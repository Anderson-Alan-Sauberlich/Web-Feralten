<?php
namespace Module\Common\Util;
    
    use Module\Application\Model\OBJ\Endereco as OBJ_Endereco;
    use Module\Application\Model\OBJ\Fatura_Servico as OBJ_Fatura_Servico;
    use \PagSeguro\Library;
    use \PagSeguro\Services\Session;
    use \PagSeguro\Configuration\Configure;
    use \PagSeguro\Domains\Requests\DirectPayment\CreditCard;
    use \PagSeguro\Domains\Requests\DirectPayment\Boleto;
    use \PagSeguro\Domains\Requests\DirectPayment\OnlineDebit;
    use \PagSeguro\Parsers\Transaction\Response;
    use \PagSeguro\Helpers\Xhr;
    use \PagSeguro\Services\Transactions\Notification;
    use \Exception;
    use \InvalidArgumentException;
    
    class PagSeguro
    {
        function __construct()
        {
            Library::initialize();
            Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
            Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
        }
        
        /**
         * ID para servir como referencia para achar a tranzação mais facilmente.
         * 
         * @var string $reference
         */
        private $reference;
        
        /**
         * Nome do usuario, ser vor cartão de credito, o nome deve estar Identico ao cartão.
         * 
         * @var string $nome
         */
        private $nome;
        
        /**
         * Email do cliente comprador.
         * 
         * @var string $email
         */
        private $email;
        
        /**
         * Telefone do cliente comprador.
         * 
         * @var string $fone
         */
        private $fone;
        
        /**
         * CPF do dono do cartão / da pessoa que esta pagamdno.
         * 
         * @var string $cpf_cnpj
         */
        private $cpf_cnpj;
        
        /**
         * Hash da sessão do usuario no navegador.
         * 
         * @var string $hash
         */
        private $hash;
        
        /**
         * IP do cliete que esta realizando o pagamento.
         * @var string $ip
         */
        private $ip;
        
        /**
         * Objeto do Endereço do cliente comprador.
         * 
         * @var OBJ_Endereco $billing
         */
        private $billing;
        
        /**
         * Token do cartão de Credito.
         * 
         * @var string $token
         */
        private $token;
        
        /**
         * Data de nacimento do dono do cartão / da pessoa que esta realizando o pagamento.
         * 
         * @var string $birthdate
         */
        private $birthdate;
        
        /**
         * Nome do banco para debito online.
         * 
         * @var string $banco
         */
        private $banco;
        
        /**
         * Valor todal da fatura.
         * 
         * @var float $total
         */
        private $total;
        
        /**
         * Lista com objeto Fatura_Servico de todos os serviços a serem cobrados.
         * 
         * @var array $servicos
         */
        private $servicos = [];
        
        /**
         * Lista com todas as mensagens de erro.
         * 
         * @var array $erros
         */
        private $erros = [];
        
        /**
         * Lista com todos as Mensagens de Sucesso.
         * 
         * @var array $sucesso
         */
        private $sucessos = [];
        
        /**
         * Seta ID para servir como referencia para achar a tranzação mais facilmente.
         * 
         * @param string $reference
         */
        public function set_reference(string $reference) : void
        {
            $this->reference = $reference;
        }
        
        /**
         * Seta Nome do usuario, ser vor cartão de credito, o nome deve estar Identico ao cartão.
         * 
         * @param string $nome
         */
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        /**
         * Seta Email do cliente comprador.
         * 
         * @param string $email
         */
        public function set_email(string $email) : void
        {
            $this->email = $email;
        }
        
        /**
         * Seta Telefone do cliente comprador.
         * 
         * @param string $fone
         */
        public function set_fone(string $fone) : void
        {
            $this->fone = $fone;
        }
        
        /**
         * Seta CPF do dono do cartão / da pessoa que esta pagamdno.
         * 
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj(string $cpf_cnpj) : void
        {
            $this->cpf_cnpj = $cpf_cnpj;
        }
        
        /**
         * Seta Hash da sessão do usuario no navegador.
         * 
         * @param string $hash
         */
        public function set_hash(string $hash) : void
        {
            $this->hash = $hash;
        }
        
        /**
         * Seta IP do cliete que esta realizando o pagamento.
         * 
         * @param string $ip
         */
        public function set_ip(string $ip) : void
        {
            $this->ip = $ip;
        }
        
        /**
         * Seta Objeto do Endereço do cliente comprador.
         * 
         * @param OBJ_Endereco $billing
         */
        public function set_billing(OBJ_Endereco $billing) : void
        {
            $this->billing = $billing;
        }
        
        /**
         * Seta Token do cartão de Credito.
         * 
         * @param string $token
         */
        public function set_token(string $token) : void
        {
            $this->token = $token;
        }
        
        /**
         * Seta Data de nacimento do dono do cartão / da pessoa que esta realizando o pagamento.
         * 
         * @param string $birthdate
         */
        public function set_birthdate(string $birthdate) : void
        {
            $this->birthdate = $birthdate;
        }
        
        /**
         * Seta Nome do banco para debito online.
         * 
         * @param string $banco
         */
        public function set_banco(string $banco) : void
        {
            $this->banco = $banco;
        }
        
        /**
         * Seta Valor todal da fatura.
         * 
         * @param float $total
         */
        public function set_total(float $total) : void
        {
            $this->total = $total;
        }
        
        /**
         * Seta Lista com objeto Fatura_Servico de todos os serviços a serem cobrados.
         * 
         * @param array $servicos
         */
        public function set_servicos(array $servicos) : void
        {
            $this->servicos = $servicos;
        }
        
        /**
         * Retorna o id da sessão para usar no navegador, plugin JS do pagseguro.
         * 
         * @return string
         */
        public function getIdSessao() : string
        {
            try {
                $sessionCode = Session::create(Configure::getAccountCredentials());
                
                return $sessionCode->getResult();
            } catch (Exception $e) {
                return '';
            }
        }
        
        /**
         * Reliza o pagamento por cartão de credito.
         * 
         * @return bool
         */
        public function pagarCredito() : bool
        {
            $creditCard = new CreditCard();
            
            /**
             * @todo Change the receiver Email
             */
            $creditCard->setReceiverEmail('pagseguro@feralten.com');
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $creditCard->setReference($this->reference);
            
            // Set the currency
            $creditCard->setCurrency("BRL");
            
            foreach ($this->servicos as $servico) {
                if ($servico instanceof OBJ_Fatura_Servico) {
                    // Add an item for this payment request
                    $creditCard->addItems()->withParameters(
                        $servico->get_id(),
                        $servico->get_descricao(),
                        1,
                        $servico->get_valor()
                    );
                }
            }
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $creditCard->setSender()->setName($this->nome);
            $creditCard->setSender()->setEmail($this->email);
            
            $creditCard->setSender()->setPhone()->withParameters(
                substr($this->fone, 0, 2),
                substr($this->fone, 2, strlen($this->fone))
            );
            
            if (strlen($this->cpf_cnpj) === 11) {
                $creditCard->setSender()->setDocument()->withParameters('CPF', $this->cpf_cnpj);
            } else if (strlen($this->cpf_cnpj) === 14) {
                $creditCard->setSender()->setDocument()->withParameters('CNPJ', $this->cpf_cnpj);
            }
            
            $creditCard->setSender()->setHash($this->hash);
            $creditCard->setSender()->setIp($this->ip);
            
            $creditCard->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            if ($this->billing instanceof OBJ_Endereco) {
                //Set billing information for credit card
                $creditCard->setBilling()->setAddress()->withParameters(
                    $this->billing->get_rua(),
                    $this->billing->get_numero(),
                    $this->billing->get_bairro(),
                    $this->billing->get_cep(),
                    $this->billing->get_cidade()->get_nome(),
                    $this->billing->get_estado()->get_uf(),
                    'BRA'
                );
            }
            
            // Set credit card token
            $creditCard->setToken($this->token);
            
            // Set the installment quantity and value (could be obtained using the Installments
            // service, that have an example here in \public\getInstallments.php)
            $creditCard->setInstallment()->withParameters(1, $this->total);
            
            // Set the credit card holder information
            $creditCard->setHolder()->setBirthdate($this->birthdate);
            $creditCard->setHolder()->setName($this->nome); // Equals in Credit Card
            
            $creditCard->setHolder()->setPhone()->withParameters(
                substr($this->fone, 0, 2),
                substr($this->fone, 2, strlen($this->fone))
            );
            
            if (strlen($this->cpf_cnpj) === 11) {
                $creditCard->setHolder()->setDocument()->withParameters('CPF', $this->cpf_cnpj);
            } else if (strlen($this->cpf_cnpj) === 14) {
                $creditCard->setHolder()->setDocument()->withParameters('CNPJ', $this->cpf_cnpj);
            }
            
            // Set the Payment Mode for this payment request
            $creditCard->setMode('DEFAULT');
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            
            try {
                //Get the crendentials and register the boleto payment
                $result = $creditCard->register(Configure::getAccountCredentials());
                
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        
        /**
         * Realiza o pagamento por Boleto Bancario.
         * 
         * @return bool
         */
        public function pagarBoleto() : ?string
        {
            $boleto = new Boleto();
            
            // Set the Payment Mode for this payment request
            $boleto->setMode('DEFAULT');
            
            /**
             * @todo Change the receiver Email
             */
            $boleto->setReceiverEmail('pagseguro@feralten.com');
            
            // Set the currency
            $boleto->setCurrency("BRL");
            
            foreach ($this->servicos as $servico) {
                if ($servico instanceof OBJ_Fatura_Servico) {
                    // Add an item for this payment request
                    $boleto->addItems()->withParameters(
                        $servico->get_id(),
                        $servico->get_descricao(),
                        1,
                        $servico->get_valor()
                    );
                }
            }
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $boleto->setReference($this->reference);
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $boleto->setSender()->setName($this->nome);
            $boleto->setSender()->setEmail($this->email);
            
            $boleto->setSender()->setPhone()->withParameters(
                substr($this->fone, 0, 2),
                substr($this->fone, 2, strlen($this->fone))
            );
            
            if (strlen($this->cpf_cnpj) === 11) {
                $boleto->setSender()->setDocument()->withParameters('CPF', $this->cpf_cnpj);
            } else if (strlen($this->cpf_cnpj) === 14) {
                $boleto->setSender()->setDocument()->withParameters('CNPJ', $this->cpf_cnpj);
            }
            
            $boleto->setSender()->setHash($this->hash);
            $boleto->setSender()->setIp($this->ip);
            
            $boleto->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            try {
                //Get the crendentials and register the boleto payment
                $result = $boleto->register(Configure::getAccountCredentials());
                
                // You can use methods like getCode() to get the transaction code and getPaymentLink() for the Payment's URL.
                return $result->getPaymentLink();
            } catch (Exception $e) {
                return null;
            }
        }
        
        /**
         * Realiza o pagamento por Debito Online.
         * 
         * @return bool
         */
        public function pagarDebito() : bool
        {
            $onlineDebit = new OnlineDebit();
            
            // Set the Payment Mode for this payment request
            $onlineDebit->setMode('DEFAULT');
            
            // Set bank for this payment request
            $onlineDebit->setBankName($this->banco);
            
            /**
             * @todo Change the receiver Email
             */
            $onlineDebit->setReceiverEmail('pagseguro@feralten.com');
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $onlineDebit->setReference($this->reference);
            
            // Set the currency
            $onlineDebit->setCurrency("BRL");
            
            foreach ($this->servicos as $servico) {
                if ($servico instanceof OBJ_Fatura_Servico) {
                    // Add an item for this payment request
                    $onlineDebit->addItems()->withParameters(
                        $servico->get_id(),
                        $servico->get_descricao(),
                        1,
                        $servico->get_valor()
                    );
                }
            }
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $onlineDebit->setSender()->setName($this->nome);
            $onlineDebit->setSender()->setEmail($this->email);
            
            $onlineDebit->setSender()->setPhone()->withParameters(
                substr($this->fone, 0, 2),
                substr($this->fone, 2, strlen($this->fone))
            );
            
            if (strlen($this->cpf_cnpj) === 11) {
                $onlineDebit->setSender()->setDocument()->withParameters('CPF', $this->cpf_cnpj);
            } else if (strlen($this->cpf_cnpj) === 14) {
                $onlineDebit->setSender()->setDocument()->withParameters('CNPJ', $this->cpf_cnpj);
            }
            
            $onlineDebit->setSender()->setHash($this->hash);
            $onlineDebit->setSender()->setIp($this->ip);
            
            $onlineDebit->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            try {
                //Get the crendentials and register the boleto payment
                $result = $onlineDebit->register(Configure::getAccountCredentials());
                
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        
        /**
         * Recebe o codigo do pagseguro e solicita os dados referentes ao codigo.
         * 
         * @throws InvalidArgumentException
         * @return Response|NULL
         */
        public function esperarResposta() : ?Response
        {
            try {
                if (Xhr::hasPost()) {
                    $response = Notification::check(Configure::getAccountCredentials());
                } else {
                    throw new InvalidArgumentException($_POST);
                }
                
                if ($response instanceof Response) {
                    return $response;
                } else {
                    return null;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
