<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Usuario as View_Usuario;
    use Module\Application\Controller\Layout\Header\Usuario as Controller_Header_Usuario;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use \Exception;
    
    class Usuario
    {
        function __construct()
        {
            
        }
        
        /**
         * @var string $nome, Nome do Usuario
         */
        private $nome;
        
        /**
         * @var string $sobrenome, Sobrenome do Usuario
         */
        private $sobrenome;
        
        /**
         * @var string $fone Numero de telefone principal do Usuario
         */
        private $fone;
        
        /**
         * @var string $fone_alternativo Numero de telefone alternativo do Usuario
         */
        private $fone_alternativo;
        
        /**
         * @var string $email Endereço de E-mail Usuario
         */
        private $email;
        
        /**
         * @var string $email_alternativo Endereço de E-mail alternativo do Usuario
         */
        private $email_alternativo;
        
        /**
         * @var array $erros Array com todos os erros
         */
        private $erros = [];
        
        /**
         * @var array $sucesso Array com todos as Mensagens de Sucesso
         */
        private $sucessos = [];
        
        /**
         * @var array $campos Array com todos os Status dos Campos do Formulario
         */
        private $campos = [];
        
        /**
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            try {
                $this->nome = Validador::Usuario()::validar_nome($nome);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['nome'] = 'erro';
                
                $this->nome = Validador::Usuario()::filtrar_nome($nome);
            }
        }
        
        /**
         * @param string $sobrenome
         */
        public function set_sobrenome($sobrenome) : void
        {
            try {
                $this->sobrenome = Validador::Usuario()::validar_sobrenome($sobrenome);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['sobrenome'] = 'erro';
                
                $this->sobrenome = Validador::Usuario()::filtrar_sobrenome($sobrenome);
            }
        }
        
        /**
         * @param string $fone
         */
        public function set_fone($fone) : void
        {
            try {
                $this->fone = Validador::Usuario()::validar_fone($fone);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['fone'] = 'erro';
                
                $this->fone = Validador::Usuario()::filtrar_fone($fone);
            }
        }
        
        /**
         * @param string $email
         */
        public function set_email($email) : void
        {
            try {
                $this->email = Validador::Usuario()::validar_email($email);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email'] = 'erro';
                
                $this->email = Validador::Usuario()::filtrar_email($email);
            }
        }
        
        /**
         * @param string $fone_alternativo
         */
        public function set_fone_alternativo($fone_alternativo = null) : void
        {
            try {
                $this->fone_alternativo = Validador::Usuario()::validar_fone_alternativo($fone_alternativo);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['fone_alternativo'] = 'erro';
                
                $this->fone_alternativo = Validador::Usuario()::filtrar_fone_alternativo($fone_alternativo);
            }
        }
        
        /**
         * @param string $email_alternativo
         */
        public function set_email_alternativo($email_alternativo = null) : void
        {
            try {
                $this->email_alternativo = Validador::Usuario()::validar_email_alternativo($email_alternativo);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['email_alternativo'] = 'erro';
                
                $this->email_alternativo = Validador::Usuario()::filtrar_email_alternativo($email_alternativo);
            }
        }
        
        /**
         * Retorna todass as Mensagens de Erro em lista.
         * 
         * @return array
         */
        public function get_erros() : array
        {
            return $this->erros;
        }
        
        /**
         * Retorna todas as Mensagens de Sucesso em lista.
         * 
         * @return array
         */
        public function get_sucessos() : array
        {
            return $this->sucessos;
        }
        
        /**
         * Retorna todos os campos do formulario com estatus de erro.
         * 
         * @return array
         */
        public function get_campos() : array
        {
            return $this->campos;
        }
        
        /**
         * Instancia e Abre a View
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Header_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Header_Usuario::Verificar_Status_Usuario();
                
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
         * @return View_Usuario
         */
        public function Retornar_Pagina() : View_Usuario
        {
            $view = new View_Usuario();
            
            if (Login_Session::Verificar_Login()) {
                $obj_usuario = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
                
                if ($obj_usuario instanceof OBJ_Usuario) {
                    $view->set_obj_usuario($obj_usuario);
                }
            }
            
            return $view;
        }
        
        /**
         * Function chamada por ajax para salvar os valores do form.
         * Retorna um Json com as mensagens de erro, sucesso e os campos respectivos.
         */
        public function SalvarDados() : void
        {
            if (empty($this->erros) && Login_Session::Verificar_Login()) {
                $usuario = new OBJ_Usuario();
                
                $usuario->set_nome($this->nome);
                $usuario->set_sobrenome($this->sobrenome);
                $usuario->set_email($this->email);
                $usuario->set_fone($this->fone);
                $usuario->set_fone_alternativo($this->fone_alternativo);
                $usuario->set_email_alternativo($this->email_alternativo);
                $usuario->set_id(Login_Session::get_usuario_id());
                
                if (DAO_Usuario::Atualizar($usuario)) {
                    Login_Session::set_usuario_nome($usuario->get_nome());
                    
                    $this->sucessos[] = "Usuario atualizado com sucesso";
                } else {
                    $this->erros[] = "Erro ao tentar atualizar usuario";
                }
            }
            
            $retorno['erros'] = View_Usuario::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Usuario::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            
            echo json_encode($retorno);
        }
        
        /**
         * Function chamada no controller Editar_Dados para salvar os valores do form usuario.
         * 
         * @return bool true para sucesso e false para erro ao salvar os dados.
         */
        public function ConcluirCadastro() : bool
        {
            if (empty($this->erros) && Login_Session::Verificar_Login()) {
                $usuario = new OBJ_Usuario();
                
                $usuario->set_nome($this->nome);
                $usuario->set_sobrenome($this->sobrenome);
                $usuario->set_email($this->email);
                $usuario->set_fone($this->fone);
                $usuario->set_fone_alternativo($this->fone_alternativo);
                $usuario->set_email_alternativo($this->email_alternativo);
                $usuario->set_id(Login_Session::get_usuario_id());
                
                if (DAO_Usuario::Atualizar($usuario)) {
                    Login_Session::set_usuario_nome($usuario->get_nome());
                    
                    $this->sucessos[] = "Usuario atualizado com sucesso";
                    
                    return true;
                } else {
                    $this->erros[] = "Erro ao tentar atualizar usuario";
                    return false;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Function chamada por ajax para recarregar os valores do form.
         */
        public function CarregarDados() : void
        {
            $usuario['nome'] = '';
            $usuario['sobrenome'] = '';
            $usuario['email'] = '';
            $usuario['email_alternativo'] = '';
            $usuario['fone'] = '';
            $usuario['fone_alternativo'] = '';
            
            if (Login_Session::Verificar_Login()) {
                $obj_usuario = DAO_Usuario::Buscar_Usuario(Login_Session::get_usuario_id());
                
                if ($obj_usuario instanceof OBJ_Usuario) {
                    $usuario['nome'] = $obj_usuario->get_nome();
                    $usuario['sobrenome'] = $obj_usuario->get_sobrenome();
                    $usuario['email'] = $obj_usuario->get_email();
                    $usuario['email_alternativo'] = $obj_usuario->get_email_alternativo();
                    $usuario['fone'] = $obj_usuario->get_fone();
                    $usuario['fone_alternativo'] = $obj_usuario->get_fone_alternativo();
                }
            }
            
            echo json_encode($usuario);
        }
    }
