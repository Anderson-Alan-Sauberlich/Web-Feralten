<?php
namespace Module\Application\Controller\Pecas;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\View\SRC\Pecas\Detalhes as View_Detalhes;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Categoria_Pativel as DAO_Categoria_Pativel;
    use Module\Application\Model\DAO\Marca_Pativel as DAO_Marca_Pativel;
    use Module\Application\Model\DAO\Modelo_Pativel as DAO_Modelo_Pativel;
    use Module\Application\Model\DAO\Preferencia_Entrega as DAO_Preferencia_Entrega;
    use Module\Application\Model\DAO\Versao_Pativel as DAO_Versao_Pativel;
    use Module\Application\Model\DAO\Visualizado as DAO_Visualizado;
    use Module\Application\Model\OBJ\Visualizado as OBJ_Visualizado;
    use Module\Application\Controller\Layout\Form\Contato_Anunciante as Controller_Contato_Anunciante;
    use \Exception;
    
    class Detalhes
    {
        function __construct()
        {
            
        }
        
        /**
         * Armazena uma instancia do objeto peça
         * 
         * @var DAO_Peca
         */
        private $obj_peca;
        
        /**
         * Armazena a url da peça.
         * 
         * @var string
         */
        private $peca_url;
        
        /**
         * Armazena o id da peça.
         * 
         * @var int
         */
        private $peca_id;
        
        /**
         * Seta id da peça para a variavel $peca_id.
         * 
         * @param int $peca_id
         */
        public function set_peca_id($peca_id)
        {
            try {
                $this->peca_id = Validador::Peca()::validar_id($peca_id);
                
                $this->obj_peca = DAO_Peca::BuscarPorCOD($this->peca_id);
            } catch (Exception $e) {
                $this->peca_id = null;
            }
        }
        
        /**
         * Seta a url da peça para a variavel $peca_url.
         * 
         * @param string $peca_url
         */
        public function set_peca_url($peca_url)
        {
            try {
                $this->peca_url = Validador::Peca()::validar_url($peca_url);
                
                $this->obj_peca = DAO_Peca::BuscarPorURL($this->peca_url);
            } catch (Exception $e) {
                $this->peca_url = null;
            }
        }
        
        /**
         * Instancia um novo objeto view src e o executa.
         */
        public function Carregar_Pagina()
        {
            if (!empty($this->obj_peca) AND $this->obj_peca != false) {
                $obj_visualizado = new OBJ_Visualizado();
                $obj_visualizado->set_obj_entidade($this->obj_peca->get_entidade());
                $obj_visualizado->set_obj_usuario($this->obj_peca->get_responsavel());
                $obj_visualizado->set_datahora(date('Y-m-d H:i:s'));
                
                DAO_Visualizado::Inserir($obj_visualizado);
                
                DAO_Peca::Incrementar_Mais1_Visualizados($this->obj_peca->get_id());
                
                $categorias_pativeis = DAO_Categoria_Pativel::BuscarPorCOD($this->obj_peca->get_id());
                $marcas_pativeis = DAO_Marca_Pativel::BuscarPorCOD($this->obj_peca->get_id());
                $modelos_pativeis = DAO_Modelo_Pativel::BuscarPorCOD($this->obj_peca->get_id());
                $versoes_pativeis = DAO_Versao_Pativel::BuscarPorCOD($this->obj_peca->get_id());
                
                $view = new View_Detalhes();
                
                $view->set_obj_peca($this->obj_peca);
                
                if (!empty($categorias_pativeis) AND $categorias_pativeis != false) {
                    $view->set_categorias_pativeis($categorias_pativeis);
                }
                
                if (!empty($marcas_pativeis) AND $marcas_pativeis != false) {
                   $view->set_marcas_pativeis($marcas_pativeis);
                }
                
                if (!empty($modelos_pativeis) AND $modelos_pativeis != false) {
                   $view->set_modelos_pativeis($modelos_pativeis);
                }
                
                if (!empty($versoes_pativeis) AND $versoes_pativeis != false) {
                   $view->set_versoes_pativeis($versoes_pativeis);
                }
                
                $controller_contato_anunciante = new Controller_Contato_Anunciante();
                
                $view->set_view_contato_anunciante($controller_contato_anunciante->Retornar_Pagina());
                
                $view->Executar();
            } else {
                $view = new View_Detalhes();
                
                $view->Executar();
            }
        }
        
        /**
         * @return boolean|array|\Module\Application\Model\OBJ\Preferencia_Entrega[]
         */
        public static function Retornar_Preferencias_Entrega()
        {
            return DAO_Preferencia_Entrega::Buscar_Todos_Masivos();
        }
    }
