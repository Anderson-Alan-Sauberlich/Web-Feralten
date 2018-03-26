<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Faturas as View_Faturas;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Controller\Common\Util\GerenciarFaturas;
    use Module\Common\Util\PagSeguro;
    
    class Faturas
    {
        function __construct()
        {
            
        }
        
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
            $pagseguro = new PagSeguro();
            
            $pagseguro->pagarCredito();
        }
        
        public function PagarPagSeguroDebito() : void
        {
            $pagseguro = new PagSeguro();
            
            $pagseguro->pagarDebito();
        }
        
        public function PagarPagSeguroBoleto() : void
        {
            $pagseguro = new PagSeguro();
            
            $pagseguro->pagarBoleto();
        }
    }
