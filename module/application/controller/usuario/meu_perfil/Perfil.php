<?php
namespace module\application\controller\usuario\meu_perfil;
	
	use module\application\view\src\usuario\meu_perfil\Perfil as View_Perfil;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	use module\application\model\common\util\Login_Session;
	use module\application\model\dao\Contador_Clique as DAO_Contador_Clique;
	use \DateTime;
	
    class Perfil {

        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
        	if (Controller_Usuario::Verificar_Autenticacao()) {
        		$status = Controller_Usuario::Verificar_Status_Usuario();
        		
        		$view = new View_Perfil($status);
        		
        		$view->Executar();
        	} else {
        		return false;
        	}
        }
        
        public function Retornar_Valores_Visualizacoes() {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $valor = array('jan' => 0, 'fev' => 0, 'mar' => 0, 'abr' => 0, 'mai' => 0, 'jun' => 0, 'jul' => 0, 'ago' => 0, 'set' => 0, 'out' => 0, 'nov' => 0, 'dez' => 0);
                
                $contador_cliques = DAO_Contador_Clique::BuscarPorCOD_Usuario(Login_Session::get_usuario_id());
                
                if (!empty($contador_cliques)) {
                    foreach ($contador_cliques as $contador_clique) {
                        $data = new DateTime($contador_clique->get_datahora());
                        $mes = $data->format('m');
                        
                        if ($mes == '1') {
                            $valor['jan'] += 1;
                        } else if ($mes == '2') {
                            $valor['fev'] += 1;
                        } else if ($mes == '3') {
                            $valor['mar'] += 1;
                        } else if ($mes == '4') {
                            $valor['abr'] += 1;
                        } else if ($mes == '5') {
                            $valor['mai'] += 1;
                        } else if ($mes == '6') {
                            $valor['jun'] += 1;
                        } else if ($mes == '7') {
                            $valor['jul'] += 1;
                        } else if ($mes == '8') {
                            $valor['ago'] += 1;
                        } else if ($mes == '9') {
                            $valor['set'] += 1;
                        } else if ($mes == '10') {
                            $valor['out'] += 1;
                        } else if ($mes == '11') {
                            $valor['nov'] += 1;
                        } else if ($mes == '12') {
                            $valor['dez'] += 1;
                        }
                    }
                }
                
                echo json_encode($valor);
            } else {
                return false;
            }
        }
    }
?>