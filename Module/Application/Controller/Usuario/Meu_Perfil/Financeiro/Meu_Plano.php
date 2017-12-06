<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Meu_Plano as View_Meu_Plano;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Fatura as Controller_Fatura;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use \Exception;
    
    class Meu_Plano
    {
        
        function __construct()
        {
            
        }
        
        /**
         * @var int $plano_id Plano escolhido pelo usuario
         */
        private $plano_id;
        
        /**
         * @var array $erros Array com todas as mensagens de erro
         */
        private $erros;
        
        /**
         * @param int $plano_id
         */
        public function set_plano_id($plano_id) : void
        {
            try {
                $this->plano_id = Validador::Plano()::validar_id($plano_id);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                
                $this->plano_id = Validador::Plano()::filtrar_id($plano_id);
            }
        }
        
        /**
         * Instancia e abre a View
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $view = new View_Meu_Plano($status, DAO_Plano::BuscarTodos(), Login_Session::get_entidade_plano());
                    
                    $view->Executar();
                }
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Salvar novo plano escolhido pelo usuario
         * 
         * @return number|NULL|boolean
         */
        public function Salvar_Novo_Plano()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                if ($status != 0) {
                    $retorno = array();
                    $retorno['status'] = 'certo';
                    $retorno['erros'] = array();
                    
                    if (empty($this->erros)) {
                        try {
                            Controller_Fatura::Alterar_Plano($this->plano_id);
                        } catch (Exception $e) {
                            $this->erros[] = $e->getMessage();
                        }
                    }
                    
                    if (!empty($this->erros)) {
                        $retorno['erros'] = $this->erros;
                        $retorno['status'] = 'erro';
                    }
                    
                    echo json_encode($retorno);
                }
                
                return $status;
            } else {
                return false;
            }
        }
    }
