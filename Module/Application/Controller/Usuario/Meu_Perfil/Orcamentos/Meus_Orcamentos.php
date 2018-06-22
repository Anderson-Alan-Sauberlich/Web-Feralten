<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos as View_Meus_Orcamentos;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Controller\Layout\Menu\Orcamento as Controller_Menu_Orcamento;
    use Module\Application\Controller\Layout\Elemento\Orcamento as Controller_Orcamento;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Meus_Orcamentos
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
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Meus_Orcamentos($status);
                $orcamentos = DAO_Orcamento::Buscar_Por_ID_Usuario(Login_Session::get_usuario_id(), $this->indice);
                if (!empty($orcamentos)) {
                    $controller_orcamento = new Controller_Orcamento();
                    $view_orcamento = $controller_orcamento->Retornar_Pagina();
                    $view_orcamento->set_pagina(Controller_Orcamento::MEUS_ORCAMENTOS);
                    $view->set_view_orcamento($view_orcamento);
                    $view->set_orcamentos($orcamentos);
                }
                
                $controller_menu_orcamento = new Controller_Menu_Orcamento();
                $view->set_view_menu_orcamento($controller_menu_orcamento->Retornar_Pagina());
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        /**
         * Function chamada por ajax para carregar novos elementos de orçamento.
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Meus_Orcamentos()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = new View_Meus_Orcamentos($status);
                    
                    $orcamentos = DAO_Orcamento::Buscar_Por_ID_Usuario(Login_Session::get_usuario_id(), $this->indice);
                    if (!empty($orcamentos)) {
                        $controller_orcamento = new Controller_Orcamento();
                        $view_orcamento = $controller_orcamento->Retornar_Pagina();
                        $view_orcamento->set_pagina(Controller_Orcamento::MEUS_ORCAMENTOS);
                        $view->set_view_orcamento($view_orcamento);
                        $view->set_orcamentos($orcamentos);
                        $view::Incluir_Elemento_Orcamento();
                    }
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
