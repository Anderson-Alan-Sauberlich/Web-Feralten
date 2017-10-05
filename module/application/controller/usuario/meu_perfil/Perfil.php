<?php
namespace module\application\controller\usuario\meu_perfil;
	
	use module\application\view\src\usuario\meu_perfil\Perfil as View_Perfil;
	use module\application\controller\layout\menu\Usuario as Controller_Usuario;
	use module\application\model\common\util\Login_Session;
	use module\application\model\dao\Visualizado as DAO_Visualizado;
	use module\application\model\dao\Adicionado as DAO_Adicionado;
	use module\application\model\dao\Removido as DAO_Removido;
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
        
        public function Retornar_Valores_Visualizados() {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $valor = array('jan' => 0, 'fev' => 0, 'mar' => 0, 'abr' => 0, 'mai' => 0, 'jun' => 0, 'jul' => 0, 'ago' => 0, 'set' => 0, 'out' => 0, 'nov' => 0, 'dez' => 0);
                
                $visualizados = DAO_Visualizado::BuscarPorCOD_Entidade(Login_Session::get_entidade_id());
                
                if (!empty($visualizados)) {
                    foreach ($visualizados as $visualizado) {
                        $data = new DateTime($visualizado->get_datahora());
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
        
        public function Retornar_Valores_Adicionados() {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $valor = array('jan' => 0, 'fev' => 0, 'mar' => 0, 'abr' => 0, 'mai' => 0, 'jun' => 0, 'jul' => 0, 'ago' => 0, 'set' => 0, 'out' => 0, 'nov' => 0, 'dez' => 0);
                
                $adicionados = DAO_Adicionado::BuscarPorCOD_Entidade(Login_Session::get_entidade_id());
                
                if (!empty($adicionados)) {
                    foreach ($adicionados as $adicionado) {
                        $data = new DateTime($adicionado->get_datahora());
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
        
        public function Retornar_Valores_Removidos() {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $valor = array('jan' => 0, 'fev' => 0, 'mar' => 0, 'abr' => 0, 'mai' => 0, 'jun' => 0, 'jul' => 0, 'ago' => 0, 'set' => 0, 'out' => 0, 'nov' => 0, 'dez' => 0);
                
                $removidos = DAO_Removido::BuscarPorCOD_Entidade(Login_Session::get_entidade_id());
                
                if (!empty($removidos)) {
                    foreach ($removidos as $removido) {
                        $data = new DateTime($removido->get_datahora());
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