<?php
namespace application\controller\pecas;
	
    use application\model\common\util\Validador;
	use application\view\src\pecas\Detalhes as View_Detalhes;
	use application\model\dao\Peca as DAO_Peca;
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
            	$view = new View_Detalhes();
            	
            	$view->set_object_peca($this->object_peca);
            	
            	$view->Executar();
            } else {
                return 'erro';
            }
        }
    }
?>