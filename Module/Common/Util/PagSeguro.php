<?php
namespace Module\Common\Util;
    
    use Module\Application\Model\Object\Endereco as Object_Endereco;
    use \PagSeguro\Library;
    use \PagSeguro\Services\Session;
    use \PagSeguro\Configuration\Configure;
    use \PagSeguro\Domains\Requests\DirectPayment\CreditCard;
    use \PagSeguro\Domains\Requests\DirectPayment\Boleto;
    use \PagSeguro\Domains\Requests\DirectPayment\OnlineDebit;
    use Exception;
    
    class PagSeguro
    {
        function __construct()
        {
            Library::initialize();
            Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
            Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
        }
        
        private $reference;
        
        private $nome;
        
        private $email;
        
        private $fone;
        
        private $cpf;
        
        private $hash;
        
        private $ip;
        
        private $billing;
        
        private $token;
        
        private $birthdate;
        
        /**
         * @var array $erros Array com todas as mensagens de erro
         */
        private $erros = [];
        
        /**
         * @var array $sucesso Array com todos as Mensagens de Sucesso
         */
        private $sucessos = [];
        
        public function getIdSessao() : string
        {
            try {
                $sessionCode = Session::create(Configure::getAccountCredentials());
                
                return $sessionCode->getResult();
            } catch (Exception $e) {
                return '';
            }
        }
        
        public function pagarCredito() : bool
        {
            $creditCard = new CreditCard();
            
            /**
             * @todo Change the receiver Email
             */
            $creditCard->setReceiverEmail('financeiro@feralten.com');
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $creditCard->setReference("LIBPHP000001");
            
            // Set the currency
            $creditCard->setCurrency("BRL");
            
            // Add an item for this payment request
            $creditCard->addItems()->withParameters(
                '0001',
                'Notebook prata',
                2,
                10.00
            );
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $creditCard->setSender()->setName('João Comprador');
            $creditCard->setSender()->setEmail('email@comprador.com.br');
            
            $creditCard->setSender()->setPhone()->withParameters(
                11,
                56273440
            );
            
            $creditCard->setSender()->setDocument()->withParameters(
                'CPF',
                'insira um numero de CPF valido'
            );
            
            $creditCard->setSender()->setHash('d94d002b6998ca9cd69092746518e50aded5a54aef64c4877ccea02573694986');
            $creditCard->setSender()->setIp('127.0.0.0');
            
            $creditCard->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            //Set billing information for credit card
            $creditCard->setBilling()->setAddress()->withParameters(
                'Av. Brig. Faria Lima',
                '1384',
                'Jardim Paulistano',
                '01452002',
                'São Paulo',
                'SP',
                'BRA',
                'apto. 114'
            );
            
            // Set credit card token
            $creditCard->setToken('2ed34e61b24d4ea8ae872c66a512525c');
            
            // Set the installment quantity and value (could be obtained using the Installments
            // service, that have an example here in \public\getInstallments.php)
            $creditCard->setInstallment()->withParameters(1, '30.00');
            
            // Set the credit card holder information
            $creditCard->setHolder()->setBirthdate('01/10/1979');
            $creditCard->setHolder()->setName('João Comprador'); // Equals in Credit Card
            
            $creditCard->setHolder()->setPhone()->withParameters(
                11,
                56273440
            );
            
            $creditCard->setHolder()->setDocument()->withParameters(
                'CPF',
                'insira um numero de CPF valido'
            );
            
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
        
        public function pagarBoleto() : bool
        {
            $boleto = new Boleto();
            
            // Set the Payment Mode for this payment request
            $boleto->setMode('DEFAULT');
            
            /**
             * @todo Change the receiver Email
             */
            $boleto->setReceiverEmail('financeiro@feralten.com');
            
            // Set the currency
            $boleto->setCurrency("BRL");
            
            // Add an item for this payment request
            $boleto->addItems()->withParameters(
                '0001',
                'Notebook prata',
                2,
                130.00
            );
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $boleto->setReference("LIBPHP000001-boleto");
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $boleto->setSender()->setName('João Comprador');
            $boleto->setSender()->setEmail('email@comprador.com.br');
            
            $boleto->setSender()->setPhone()->withParameters(
                11,
                56273440
            );
            
            $boleto->setSender()->setDocument()->withParameters(
                'CPF',
                'insira um numero de CPF valido'
            );
            
            $boleto->setSender()->setHash('3dc25e8a7cb3fd3104e77ae5ad0e7df04621caa33e300b27aeeb9ea1adf1a24f');
            $boleto->setSender()->setIp('127.0.0.0');
            
            $boleto->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            try {
                //Get the crendentials and register the boleto payment
                $result = $boleto->register(Configure::getAccountCredentials());
                
                // You can use methods like getCode() to get the transaction code and getPaymentLink() for the Payment's URL.
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        
        public function pagarDebito() : bool
        {
            $onlineDebit = new OnlineDebit();
            
            // Set the Payment Mode for this payment request
            $onlineDebit->setMode('DEFAULT');
            
            // Set bank for this payment request
            $onlineDebit->setBankName('nomedobanco');
            
            /**
             * @todo Change the receiver Email
             */
            $onlineDebit->setReceiverEmail('financeiro@feralten.com');
            
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $onlineDebit->setReference("LIBPHP000001");
            
            // Set the currency
            $onlineDebit->setCurrency("BRL");
            
            // Add an item for this payment request
            $onlineDebit->addItems()->withParameters(
                '0001',
                'Notebook prata',
                2,
                130.00
            );
            
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $onlineDebit->setSender()->setName('João Comprador');
            $onlineDebit->setSender()->setEmail('email@comprador.com.br');
            
            $onlineDebit->setSender()->setPhone()->withParameters(
                11,
                56273440
            );
            
            $onlineDebit->setSender()->setDocument()->withParameters(
                'CPF',
                'insira um numero de CPF valido'
            );
            
            $onlineDebit->setSender()->setHash('3dc25e8a7cb3fd3104e77ae5ad0e7df04621caa33e300b27aeeb9ed5fdf1a24f');
            $onlineDebit->setSender()->setIp('127.0.0.0');
            
            $onlineDebit->setShipping()->setAddressRequired()->withParameters('FALSE');
            
            try {
                //Get the crendentials and register the boleto payment
                $result = $onlineDebit->register(Configure::getAccountCredentials());
                
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }
