<?php
namespace application\controller\usuario;
	
	require_once RAIZ.'/application/model/common/util/validador.php';
    require_once RAIZ.'/application/model/dao/usuario.php';
    require_once RAIZ.'/application/model/object/usuario.php';
    require_once RAIZ.'/application/controller/usuario/login.php';
    require_once RAIZ.'/application/view/src/usuario/cadastro.php';
	
    use application\model\common\util\Validador;
    use application\model\dao\Usuario as DAO_Usuario;
    use application\model\object\Usuario as Object_Usuario;
    use application\controller\usuario\Login;
    use application\view\src\usuario\Cadastro as View_Cadastro;
    use \Exception;
    
    class Cadastro {
		
        function __construct() {
            
        }
        
        private $nome;
        private $email;
        private $confemail;
        private $senha;
        private $cadastro_erros = array();
        private $cadastro_campos = array();
        private $cadastro_form = array();
        
        public function set_nome($nome) {
        	try {
        		$this->nome = Validador::Usuario()::validar_nome($nome);
        		$this->cadastro_campos['erro_nome'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_nome'] = "erro";
        		
        		$this->nome = Validador::Usuario()::filtrar_nome($nome);
        	}
        }
        
        public function set_email($email) {
        	try {
        		$this->email = Validador::Usuario()::validar_email($email);
        		$this->cadastro_campos['erro_email'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_email'] = "erro";
        		
        		$this->email = Validador::Usuario()::filtrar_email($email);
        	}
        }
        
        public function set_confemail($confemail) {
        	try {
        		$this->confemail= Validador::Usuario()::validar_confemail($confemail, $this->email);
        		$this->cadastro_campos['erro_confemail'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_confemail'] = "erro";
        		
        		$this->confemail = Validador::Usuario()::filtrar_confemail($confemail);
        	}
        }
        
        public function set_senha($senha) {
        	try {
        		$this->senha = Validador::Usuario()::validar_senha($senha);
        		$this->cadastro_campos['erro_senha'] = "certo";
        	} catch (Exception $e) {
        		$this->cadastro_erros[] = $e->getMessage();
        		$this->cadastro_campos['erro_senha'] = "erro";
        		
        		$this->senha = Validador::Usuario()::filtrar_senha($senha);
        	}
        }
        
        public function Carregar_Pagina() : void {
        	$view = new View_Cadastro();
        	
        	$view->set_cadastro_campos($this->cadastro_campos);
        	$view->set_cadastro_erros($this->cadastro_erros);
        	$view->set_cadastro_form($this->cadastro_form);
        	 
        	$view->Executar();
        }

        public function Cadastrar_Usuario() {
            if (empty($this->cadastro_erros)) {
            	$usuario = new Object_Usuario();
            	$usuario->set_id(0);
            	$usuario->set_ultimo_login(date("Y-m-d H:i:s"));
            	$usuario->set_status_id(2);
            	$usuario->set_fone1('00000000');
            	$usuario->set_nome($this->nome);
            	$usuario->set_email($this->email);
            	$usuario->set_senha($this->senha);
            	
            	$usuario->set_senha(password_hash($usuario->get_senha(), PASSWORD_DEFAULT));
            	
                $retorno = DAO_Usuario::Inserir($usuario);
				
                if ($retorno !== false) {
                	$retorno = Login::Autenticar_Usuario_Logado($usuario->get_email(), $usuario->get_senha());
                	
                	if ($retorno === false) {
                		$this->cadastro_erros[] = "Usuario Cadastrado com Sucesso, porem Autenticação Falhou";
                	}
                } else {
                	$this->cadastro_erros[] = "Erro ao tentar Cadastrar Usuario";
                }
            }
            
            if (empty($this->cadastro_erros)) {
            	return true;
            } else {
                $this->cadastro_form['nome'] = $this->nome;
                $this->cadastro_form['email'] = $this->email;
                $this->cadastro_form['confemail'] = $this->confemail;
                $this->cadastro_form['senha'] = $this->senha;
                
                $this->Carregar_Pagina();
            }
        }
    }
?>