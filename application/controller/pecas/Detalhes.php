<?php
namespace application\controller\pecas;
	
    use application\model\common\util\Validador;
	use application\view\src\pecas\Detalhes as View_Detalhes;
	use application\model\dao\Peca as DAO_Peca;
	use application\model\dao\Categoria_Pativel as DAO_Categoria_Pativel;
	use application\model\dao\Marca_Pativel as DAO_Marca_Pativel;
	use application\model\dao\Modelo_Pativel as DAO_Modelo_Pativel;
	use application\model\dao\Preferencia_Entrega as DAO_Preferencia_Entrega;
	use application\model\dao\Versao_Pativel as DAO_Versao_Pativel;
	use \Exception;
	
    class Detalhes {

        function __construct() {
            
        }
        
        private $object_peca;
        private $peca_url;
        private $peca_id;
        
        public function set_peca_id($peca_id) {
            try {
                $this->peca_id = Validador::Peca()::validar_id($peca_id);
                
                $this->object_peca = DAO_Peca::BuscarPorCOD($this->peca_id);
            } catch (Exception $e) {
                $this->peca_id = null;
            }
        }
        
        public function set_peca_url($peca_url) {
            try {
                $this->peca_url = Validador::Peca()::validar_url($peca_url);
                
                $this->object_peca = DAO_Peca::BuscarPorURL($this->peca_url);
            } catch (Exception $e) {
                $this->peca_url = null;
            }
        }
        
        public function Carregar_Pagina() {
            if (!empty($this->object_peca) AND $this->object_peca != false) {
                $categorias_pativeis = DAO_Categoria_Pativel::BuscarPorCOD($this->object_peca->get_id());
                $marcas_pativeis = DAO_Marca_Pativel::BuscarPorCOD($this->object_peca->get_id());
                $modelos_pativeis = DAO_Modelo_Pativel::BuscarPorCOD($this->object_peca->get_id());
                $versoes_pativeis = DAO_Versao_Pativel::BuscarPorCOD($this->object_peca->get_id());
                
            	$view = new View_Detalhes();
            	
            	$view->set_object_peca($this->object_peca);
            	
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
            	
            	$view->Executar();
            } else {
                return 'erro';
            }
        }
        
        public static function Retornar_Preferencias_Entrega() {
            return DAO_Preferencia_Entrega::Buscar_Todos_Masivos();
        }
    }
?>