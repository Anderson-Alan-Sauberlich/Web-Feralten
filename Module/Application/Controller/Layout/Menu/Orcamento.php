<?php
namespace Module\Application\Controller\Layout\Menu;
    
    use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Orcamento;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\Common\Util\Entidade_BD;
    use Module\Application\Model\Common\Util\Login_Session;
    
    class Orcamento
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = $this->Retornar_Pagina();
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        public function Retornar_Pagina() : View_Orcamento
        {
            $view = new View_Orcamento();
            
            $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
            $obj_entidade_bd->Atualizar_Orcamentos();
            
            $view->set_numero_meus(DAO_Orcamento::Buscar_Numero_Por_ID_Usuario(Login_Session::get_usuario_id()));
            $view->set_numero_recebidos($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RECEBIDO));
            $view->set_numero_nao_tenho($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::NAO_TENHO));
            $view->set_numero_respondido($obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RESPONDIDO));
            
            return $view;
        }
        
        public function Atualizar_Numeros() : void
        {
            $obj_entidade_bd = new Entidade_BD(Login_Session::get_entidade_id());
            
            $retorno = [];
            
            $retorno['meus_orcamentos'] = DAO_Orcamento::Buscar_Numero_Por_ID_Usuario(Login_Session::get_usuario_id());
            $retorno['caixa_de_entrada'] = $obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RECEBIDO);
            $retorno['nao_tenho'] = $obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::NAO_TENHO);
            $retorno['respondidos'] = $obj_entidade_bd->RetornaContagemPorStatus(Entidade_BD::RESPONDIDO);
            
            echo json_encode($retorno);
        }
    }
