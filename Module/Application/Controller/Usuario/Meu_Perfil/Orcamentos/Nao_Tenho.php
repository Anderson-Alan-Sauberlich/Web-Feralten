<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Nao_Tenho as View_Nao_Tenho;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Controller\Layout\Menu\Orcamento as Controller_Menu_Orcamento;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Nao_Tenho
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
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = new View_Nao_Tenho($status);
                    
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    $obj_entidade_bd->Atualizar_Orcamentos();
                    
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::NAO_TENHO, $this->indice);
                    
                    if (!empty($orcamentos)) {
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
        
        public function Carregar_Orcamentos_NaoTenho()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::NAO_TENHO, $this->indice);
                    
                    if (!empty($orcamentos)) {
                        View_Nao_Tenho::Incluir_Elemento_Orcamento($orcamentos);
                    }
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
