<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos\Meus_Orcamentos as View_Meus_Orcamentos;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Controller\Layout\Menu\Orcamento as Controller_Menu_Orcamento;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Meus_Orcamentos
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
                
                $view = new View_Meus_Orcamentos($status);
                
                $orcamentos = DAO_Orcamento::Buscar_Por_ID_Usuario(Login_Session::get_usuario_id(), $this->indice);
                
                if (!empty($orcamentos)) {
                    $view->set_orcamentos($orcamentos);
                }
                
                $controller_menu_orcamento = new Controller_Menu_Orcamento();
                
                $view->set_view_menu_orcamento($controller_menu_orcamento->Retornar_Pagina());
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public function Carregar_Meus_Orcamentos()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $orcamentos = DAO_Orcamento::Buscar_Por_ID_Usuario(Login_Session::get_usuario_id(), $this->indice);
                    
                    if (!empty($orcamentos)) {
                        View_Meus_Orcamentos::Incluir_Elemento_Orcamento($orcamentos);
                    }
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
