<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Orcamentos as View_Orcamentos;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Orcamentos
    {
        function __construct()
        {
            
        }
        
        /**
         * Armazena o indice da paginação por demanda, inicia com 1 pois ao carregar a pagina já deve vir com valores.
         *
         * @var integer
         */
        private $indice = 1;
        
        /**
         * Lista de mensagens de erro.
         *
         * @var array
         */
        private $erros = [];
        
        /**
         * Seta o numero do indice da paginação por demanda.
         *
         * @param int $indice
         */
        public function set_indice($indice) : void
        {
            try {
                $this->indice = Validador::Orcamento()::validar_indice($indice);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        /**
         * Chama e retorna a pagina.
         *
         * @return boolean
         */
        public function Carregar_Pagina()
        {
            $view = new View_Orcamentos();
            
            $orcamentos = DAO_Orcamento::BuscarIndiceTodos($this->indice);
            
            if (!empty($orcamentos)) {
                $view->set_orcamentos($orcamentos);
            }
            
            $view->Executar();
        }
        
        /**
         * Function chamada por ajax para carregar novos elementos de orçamento.
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Orcamentos()
        {
            $orcamentos = DAO_Orcamento::BuscarIndiceTodos($this->indice);
            
            if (!empty($orcamentos)) {
                View_Orcamentos::Incluir_Elemento_Orcamento($orcamentos);
            }
        }
    }
