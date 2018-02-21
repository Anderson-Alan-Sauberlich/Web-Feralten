<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as View_Entidade;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use \Exception;
    
    class Entidade
    {
        function __construct()
        {
            
        }
        
        /**
         * @var string $cpf_cnpj Numero do CPF ou CPNJ da Entidade
         */
        private $cpf_cnpj;
        
        /**
         * @var string $site Endereço do Site da Entidade
         */
        private $site;
        
        /**
         * @var string $nome_comercial Nome Comercial da Entidade
         */
        private $nome_comercial;
        
        /**
         * @var array $erros Array com todos os erros
         */
        private $erros = [];
        
        /**
         * @var array $campos Array com todos os Status dos Campos do Formulario
         */
        private $campos = [];
        
        /**
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj($cpf_cnpj) : void
        {
            try {
                $this->cpf_cnpj = Validador::Entidade()::validar_cpf_cnpj($cpf_cnpj);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['cpf_cnpj'] = 'erro';
                
                $this->cpf_cnpj = Validador::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
            }
        }
        
        /**
         * @param string $site
         */
        public function set_site($site = null) : void
        {
            try {
                $this->site = Validador::Entidade()::validar_site($site);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['site'] = 'erro';
                
                $this->site = Validador::Entidade()::filtrar_site($site);
            }
        }
        
        /**
         * @param string $nome_comercial
         */
        public function set_nome_comercial($nome_comercial = null) : void
        {
            try {
                $this->nome_comercial = Validador::Entidade()::validar_nome_comercial($nome_comercial);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome_comercial'] = 'erro';
                
                $this->nome_comercial = Validador::Entidade()::filtrar_nome_comercial($nome_comercial);
            }
        }
        
        /**
         * Instancia e Abre a View
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status != 0) {
                    $view = $this->Retornar_Pagina();
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Instancia e Retorna a View
         *
         * @return View_Entidade
         */
        public function Retornar_Pagina() : View_Entidade
        {
            $view = new View_Entidade();
            
            if (Login_Session::Verificar_Entidade()) {
                $obj_entidade = DAO_Entidade::BuscarPorCOD(Login_Session::get_entidade_id());
                
                if ($obj_entidade instanceof Object_Entidade) {
                    $view->set_obj_entidade($obj_entidade);
                }
            }
            
            return $view;
        }
        
        public function SalvarDados() : void
        {
            
        }
    }
