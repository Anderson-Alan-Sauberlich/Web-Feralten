<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Perfil as View_Perfil;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Model\DAO\Visualizado as DAO_Visualizado;
    use Module\Application\Model\DAO\Adicionado as DAO_Adicionado;
    use Module\Application\Model\DAO\Removido as DAO_Removido;
    use \DateTime;
    
    class Perfil
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
                $view = new View_Perfil($status);
                
                if (Login_Session::Verificar_Entidade()) {
                    $num_pecas = DAO_Peca::Buscar_Quantidade_Pecas_Por_Entidade(Login_Session::get_entidade_id());
                    
                    if (!empty($num_pecas) && $num_pecas != false) {
                        $view->set_num_pecas($num_pecas);
                    }
                    
                    $num_plano = DAO_Plano::Buscar_Limite_Por_Id(Login_Session::get_entidade_plano());
                    
                    if (!empty($num_plano) && $num_plano != false) {
                        $view->set_num_limite_plano($num_plano);
                    }
                }
                
                $num_meus_orcamentos = DAO_Orcamento::Buscar_Numero_Por_ID_Usuario(Login_Session::get_usuario_id());
                
                if (!empty($num_meus_orcamentos) && $num_meus_orcamentos != false) {
                    $view->set_num_meus_orcamentos($num_meus_orcamentos);
                }
                
                $num_orcamentos_recebidos = DAO_Orcamento::Buscar_Numero_Todos();
                
                if (!empty($num_orcamentos_recebidos) && $num_orcamentos_recebidos != false) {
                    $view->set_num_orcamentos_recebidos($num_orcamentos_recebidos);
                }
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public function Retornar_Valores_Visualizados()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao() AND Login_Session::Verificar_Entidade()) {
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
        
        public function Retornar_Valores_Adicionados()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao() AND Login_Session::Verificar_Entidade()) {
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
        
        public function Retornar_Valores_Removidos()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao() AND Login_Session::Verificar_Entidade()) {
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
