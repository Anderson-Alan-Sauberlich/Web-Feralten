<?php
namespace application\controller\usuario\meu_perfil\meus_dados;

	require_once(RAIZ.'/application/model/object/endereco.php');
    require_once(RAIZ.'/application/model/dao/cidade.php');
	require_once(RAIZ.'/application/model/dao/endereco.php');
    require_once(RAIZ.'/application/model/dao/estado.php');
    require_once(RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/enderecos.php');
	
	use application\model\object\Endereco as Object_Endereco;
	use application\model\dao\Endereco as DAO_Endereco;
    use application\model\dao\Cidade as DAO_Cidade;
    use application\model\dao\Estado as DAO_Estado;
    use application\view\src\usuario\meu_perfil\meus_dados\Enderecos as View_Enderecos;

    @session_start();

    class Enderecos {

        function __construct() {
            
        }
        
        public static function Carregar_Pagina() {
        	new View_Enderecos();
        }
        
        public static function Retornar_Cidades_Por_Estado() {
        	if (isset($_GET['estado'])) {
        		View_Enderecos::Mostrar_Cidades($_GET['estado']);
        	}
        }
		
        public static function Atualizar_Endereco() {
            $erros_enderecos = array();
            $enderecos_campos = array('erro_cidade' => "certo", 'erro_estado' => "certo", 'erro_numero' => "certo", 'erro_cep' => "certo", 'erro_bairro' => "certo", 'erro_rua' => "certo");
            
            $endereco = new Object_Endereco();
            
            $endereco->set_dados_usuario_id(unserialize($_SESSION['usuario'])->get_id());
            $endereco->set_cidade_id($_POST['cidade']);
            $endereco->set_estado_id($_POST['estado']);
            $endereco->set_numero($_POST['numero']);
            $endereco->set_cep($_POST['cep']);
            $endereco->set_rua($_POST['rua']);
            $endereco->set_complemento($_POST['complemento']);
            $endereco->set_bairro($_POST['bairro']);
            
            if ($endereco->get_cidade_id() <= 0) {
                $erros_enderecos[] = "Seleciona sua Cidade";
                $enderecos_campos['erro_cidade'] = "erro";
            }
            if ($endereco->get_estado_id() <= 0) {
                $erros_enderecos[] = "Seleciona seu Estado";
                $enderecos_campos['erro_estado'] = "erro";
            }
            if (empty($endereco->get_numero())) {
                $erros_enderecos[] = "Informe o Numero do seu Endereço";
                $enderecos_campos['erro_numero'] = "erro";
            }
            if (empty($endereco->get_cep())) {
                $erros_enderecos[] = "Informe seu CEP";
                $enderecos_campos['erro_cep'] = "erro";
            }
            if (empty($endereco->get_bairro())) {
                $erros_enderecos[] = "Informe seu Bairro";
                $enderecos_campos['erro_bairro'] = "erro";
            }
            if (empty($endereco->get_rua())) {
                $erros_enderecos[] = "Informe sua Rua";
                $enderecos_campos['erro_rua'] = "erro";
            }
            
            if (empty($erros_enderecos)) {
                DAO_Endereco::Atualizar($endereco);
				
				$_SESSION['success_enderecos'][] = "O Endereço do seu Usuario foi Atualizado com Sucesso!";
            } else {
                $_SESSION['erros_enderecos'] = $erros_enderecos;
            }
            
            $_SESSION['enderecos_campos'] = $enderecos_campos;
        }

        public static function Pegar_Endereco_Cidade() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_cidade_id() != null) {
                    return $endereco->get_cidade_id();
                }
            } else {                
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_cidade_id() != null){
                    return $endereco->get_cidade_id();
                }
            }
        }

        public static function Pegar_Endereco_Numero() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_numero() != null) {
                    return $endereco->get_numero();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_numero() != null){
                    return $endereco->get_numero();
                }
            }
        }

        public static function Pegar_Endereco_Estado() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_estado_id() != null) {
                    return $endereco->get_estado_id();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_estado_id() != null) {
                     return $endereco->get_estado_id();
                }
            }
        }

        public static function Pegar_Endereco_CEP() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_cep() != null) {
                    return $endereco->get_cep();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_cep() != null){
                    return $endereco->get_cep();
                }
            }
        }

        public static function Pegar_Endereco_Bairro() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_bairro() != null) {
                    return $endereco->get_bairro();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_bairro() != null){
                    return $endereco->get_bairro();
                }
            }
        }

        public static function Pegar_Endereco_Complemento() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_complemento() != null) {
                    return $endereco->get_complemento();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_complemento() != null){
                    return $endereco->get_complemento();
                }
            }
        }

        public static function Pegar_Endereco_Rua() {
            $endereco = new Object_Endereco();
            
            if (isset($_SESSION['endereco'])) {
                $endereco = $_SESSION['endereco'];
                
                if ($endereco->get_rua() != null) {
                    return $endereco->get_rua();
                }
            } else {
                $endereco = self::Pegar_Endereco($endereco);
                
                if ($endereco->get_rua() != null){
                    return $endereco->get_rua();
                }
            }
        }

        private function Pegar_Endereco(Object_Endereco $endereco) {
            $endereco = DAO_Endereco::Buscar_Por_Id_Usuario(unserialize($_SESSION['usuario'])->get_id());
            
            $_SESSION['endereco'] = $endereco;
            
            return $endereco;
        }
		
		public static function Buscar_Estados() {
			return DAO_Estado::BuscarTodos();
		}
		
		public static function Buscar_Cidade_Por_Estado($id_estado) {
			return DAO_Cidade::BuscarPorCOD($id_estado);
		}
		
		public static function Buscar_Cidade_Por_Estado_Usuario() {
			return DAO_Cidade::BuscarPorCOD(self::Pegar_Endereco_Estado());
		}
	}
?>