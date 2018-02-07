<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos_Recebidos as View_Orcamentos_Recebidos;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Orcamentos_Recebidos
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
                    $view = new View_Orcamentos_Recebidos($status);
                    
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    $obj_entidade_bd->Atualizar_Orcamentos();
                    
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::RECEBIDO, $this->indice);
                    
                    if (!empty($orcamentos)) {
                        $view->set_orcamentos($orcamentos);
                    }
                    
                    $view->set_numero_recebidos($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RECEBIDO));
                    $view->set_numero_nao_tenho($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::NAO_TENHO));
                    $view->set_numero_respondido($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RESPONDIDO));
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        public function Carregar_Orcamentos_Recebidos()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
                    $obj_entidade_bd->Atualizar_Orcamentos();
                    
                    $orcamentos = $obj_entidade_bd->RetornaOrcamentosPorStatus(Entidade_BD::RECEBIDO, $this->indice);
                    
                    if (!empty($orcamentos)) {
                        View_Orcamentos_Recebidos::Incluir_Elemento_Orcamento($orcamentos);
                    }
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
