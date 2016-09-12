<?php
namespace application\view\src\include_page;

    require_once(RAIZ.'/application/controller/include_page/menu_usuario.php');
    require_once(RAIZ.'/application/model/object/class_usuario.php');
    
    use application\controller\include_page\Menu_Usuario as Controller_Menu_Usuario;
    use application\model\object\Usuario;
    
    @session_start();

    new Menu_Usuario();

    class Menu_Usuario {

        function __construct() {
            Controller_Menu_Usuario::Verificar_Autenticacao();
			
			$_SESSION['menu']['status'] = Controller_Menu_Usuario::Pegar_Status_Usuario();
        }
        
        public static function Mostrar_Nome() {
            echo unserialize($_SESSION['usuario'])->get_nome();
        }
		
		public static function Verificar_Status_Usuario() {
			$status = $_SESSION['menu']['status'];
            
			if ($status == null) {
				if (empty($_SESSION['menu']['cadastro_incompleto'])) {
			    	include_once($_SERVER['DOCUMENT_ROOT']."/include-page/mensagens/cadastro-incompleto.php");
				}
				
				unset($_SESSION['menu']);
			} else if ($status == 1) {
				unset($_SESSION['menu']);
			} else if ($status == 2) {
				include_once($_SERVER['DOCUMENT_ROOT']."/include-page/mensagens/pagamento-atrasado.php");
			} else if ($status == 3) {
				include_once($_SERVER['DOCUMENT_ROOT']."/include-page/mensagens/conta-desativada.php");
			}
			
			
		}
        
        public static function Verificar_URL_Ativa($id_tab, $id_pill = null) {
        	$status = $_SESSION['menu']['status'];
            $dir_list = explode("/", $_SERVER['SCRIPT_NAME']);
            $class = "";
            
            switch($id_tab) {
                case "perfil":
                    if ($dir_list[2] == "perfil") {
                        $class = "active";
                        
                        if (isset($id_pill)) {
                            if ($dir_list[3] == $id_pill) {
                                if (empty($status)) {
                                	$_SESSION['menu']['cadastro_incompleto'] = "0";
                                    header("location: /usuario/meu-perfil/meus-dados/concluir/");
                                }
                            } else {
                                unset($class);
                            }
                        }
                    }
                    break;
                
                case "pecas":
                    if ($dir_list[3] == "auto-pecas") {
                        $class = "active";
                        
                        if (isset($id_pill)) {
                            if ($dir_list[4] == $id_pill) {
                                if (empty($status)) {
                                	$_SESSION['menu']['cadastro_incompleto'] = "0";
                                    header("location: /usuario/meu-perfil/meus-dados/concluir/");
                                }
                            } else {
                                unset($class);
                            }
                        }
                    }
                    break;
                
                case "dados":
                    if ($dir_list[3] == "meus-dados") {
                        $class = "active";
                        
                        if (isset($id_pill)) {
                            if ($dir_list[4] == $id_pill) {
                                if (empty($status)) {
                                    if ($id_pill != "concluir" AND $id_pill != "alterar-senha") {
                                    	$_SESSION['menu']['cadastro_incompleto'] = "0";
                                        header("location: /usuario/meu-perfil/meus-dados/concluir/");
                                    } else if (isset($_SESSION['menu']['cadastro_incompleto'])) {
                                    	if ($_SESSION['menu']['cadastro_incompleto'] == "0") {
                                    		unset($_SESSION['menu']['cadastro_incompleto']);
                                    	}
                                	} else {
                                		$_SESSION['menu']['cadastro_incompleto'] = true;
                                	}
                                } else if ($id_pill == "concluir") {
                                    header("location: /usuario/meu-perfil/");
                                }
                            } else {
                                unset($class);
                            }
                        }
                    }
		            if ($id_pill == "concluir" AND isset($status)) {
		                $class = "disabled";
		            }
                    break;
                
                case "financeiro":
                    if ($dir_list[3] == "financeiro") {
                        $class = "active";
                        
                        if (isset($id_pill)) {
                            if ($dir_list[4] == $id_pill) {
                                if (empty($status)) {
                                	$_SESSION['menu']['cadastro_incompleto'] = "0";
                                    header("location: /usuario/meu-perfil/meus-dados/concluir/");
                                }
                            } else {
                                unset($class);
                            }
                        }
                    }
                    break;
                
                case "pacotes":
                    if ($dir_list[3] == "pacotes") {
                        $class = "active";
                        
                        if (isset($id_pill)) {
                            if ($dir_list[4] == $id_pill) {
                                if (empty($_SESSION['menu']['status'])) {
                                	$_SESSION['menu']['cadastro_incompleto'] = "0";
                                    header("location: /usuario/meu-perfil/meus-dados/concluir/");
                                }
                            } else {
                                unset($class);
                            }
                        }
                    }
                    break;
            }
			
            if (isset($class)) {
            	echo $class;
            }
        }
    }
?>