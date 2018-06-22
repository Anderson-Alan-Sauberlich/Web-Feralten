<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Caixa_De_Entrada as View_Caixa_De_Entrada;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Controller\Layout\Menu\Orcamento as Controller_Menu_Orcamento;
    use Module\Application\Controller\Layout\Elemento\Orcamento as Controller_Orcamento;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Caixa_De_Entrada
    {
        function __construct()
        {
            
        }
        
        private $indice = 1;
        private $erros = [];
        
        public function set_indice($indice) : void
        {
            try {
                $this->indice = Validador::Orcamento()::validar_indice($indice);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = new View_Caixa_De_Entrada($status);
                    
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    $obj_entidade_bd->Atualizar_Orcamentos();
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::RECEBIDO, $this->indice);
                    if (!empty($orcamentos)) {
                        $controller_orcamento = new Controller_Orcamento();
                        $view_orcamento = $controller_orcamento->Retornar_Pagina();
                        $view_orcamento->set_pagina(Controller_Orcamento::CAIXA_DE_ENTRADA);
                        $view->set_view_orcamento($view_orcamento);
                        $view->set_orcamentos($orcamentos);
                    }
                    
                    $controller_menu_orcamento = new Controller_Menu_Orcamento();
                    $view->set_view_menu_orcamento($controller_menu_orcamento->Retornar_Pagina());
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        public function Carregar_Orcamentos_Recebidos()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = new View_Caixa_De_Entrada($status);
                    
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::RECEBIDO, $this->indice);
                    if (!empty($orcamentos)) {
                        $controller_orcamento = new Controller_Orcamento();
                        $view_orcamento = $controller_orcamento->Retornar_Pagina();
                        $view_orcamento->set_pagina(Controller_Orcamento::CAIXA_DE_ENTRADA);
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
