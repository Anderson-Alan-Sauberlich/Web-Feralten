<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Object\Endereco as Object_Endereco;
    use Module\Application\Model\Object\Cidade as Object_Cidade;
    use Module\Application\Model\Object\Estado as Object_Estado;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Cidade as DAO_Cidade;
    use Module\Application\Model\DAO\Estado as DAO_Estado;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Enderecos as View_Enderecos;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use \Exception;
    
    class Enderecos
    {
        
        function __construct()
        {
            
        }
        
        private $estado;
        private $cidade;
        private $numero;
        private $cep;
        private $bairro;
        private $rua;
        private $complemento;
        private $enderecos_erros = array();
        private $enderecos_sucesso = array();
        private $enderecos_form = null;
        private $enderecos_campos = array();
        
        public function set_estado($estado) : void
        {
            try {
                $this->estado = Validador::Estado()::validar_id($estado);
                $this->enderecos_campos['erro_estado'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_estado'] = "erro";
                
                $this->estado = Validador::Estado()::filtrar_id($estado);
            }
        }
        
        public function set_cidade($cidade) : void
        {
            try {
                $this->cidade = Validador::Cidade()::validar_id($cidade);
                $this->enderecos_campos['erro_cidade'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_cidade'] = "erro";
                
                $this->cidade = Validador::Cidade()::filtrar_id($cidade);
            }
        }
        
        public function set_numero($numero) : void
        {
            try {
                $this->numero = Validador::Endereco()::validar_numero($numero);
                $this->enderecos_campos['erro_numero'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_numero'] = "erro";
                
                $this->numero = Validador::Endereco()::filtrar_numero($numero);
            }
        }
        
        public function set_cep($cep) : void
        {
            try {
                $this->cep = Validador::Endereco()::validar_cep($cep);
                $this->enderecos_campos['erro_cep'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_'] = "erro";
                
                $this->cep = Validador::Endereco()::filtrar_cep($cep);
            }
        }
        
        public function set_bairro($bairro) : void
        {
            try {
                $this->bairro = Validador::Endereco()::validar_bairro($bairro);
                $this->enderecos_campos['erro_bairro'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_bairro'] = "erro";
                
                $this->bairro = Validador::Endereco()::filtrar_bairro($bairro);
            }
        }
        
        public function set_rua($rua) : void
        {
            try {
                $this->rua = Validador::Endereco()::validar_rua($rua);
                $this->enderecos_campos['erro_rua'] = "certo";
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_rua'] = "erro";
                
                $this->rua = Validador::Endereco()::filtrar_rua($rua);
            }
        }
        
        public function set_complemento($complemento = null) : void
        {
            try {
                $this->complemento = Validador::Endereco()::validar_complemento($complemento);
            } catch (Exception $e) {
                $this->enderecos_erros[] = $e->getMessage();
                $this->enderecos_campos['erro_complemento'] = "erro";
                
                $this->complemento = Validador::Endereco()::filtrar_complemento($complemento);
            }
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    $view = new View_Enderecos($status);
                    
                    $view->set_enderecos_campos($this->enderecos_campos);
                    $view->set_enderecos_erros($this->enderecos_erros);
                    $view->set_enderecos_sucesso($this->enderecos_sucesso);
                    
                    if (!empty($this->enderecos_form)) {
                        $view->set_enderecos_form($this->enderecos_form);
                    } else {
                        $endereco_retorno = DAO_Endereco::Buscar_Por_Id_Entidade(Login_Session::get_entidade_id());
                        
                        if (!empty($endereco_retorno) AND $endereco_retorno != false) {
                            $view->set_enderecos_form($endereco_retorno);
                        } else {
                            $view->set_enderecos_form(new Object_Endereco());
                        }
                    }
                     
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        public function Retornar_Cidades_Por_Estado() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->estado)) {
                    if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
                        View_Enderecos::Mostrar_Cidades($this->estado);
                    }
                }
            }
        }
        
        public function Atualizar_Endereco()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (empty($this->enderecos_erros)) {
                        $endereco = new Object_Endereco();
                        
                        $endereco->set_entidade_id(Login_Session::get_entidade_id());
                        $endereco->set_complemento($this->complemento);
                        $endereco->set_rua($this->rua);
                        $endereco->set_bairro($this->bairro);
                        $endereco->set_cep($this->cep);
                        $endereco->set_numero($this->numero);
                        
                        $object_cidade = new Object_Cidade();
                        $object_cidade->set_id($this->cidade);
                        $endereco->set_cidade($object_cidade);
                        
                        $object_estado = new Object_Estado();
                        $object_estado->set_id($this->estado);
                        $endereco->set_estado($object_estado);
                        
                        if (DAO_Endereco::Atualizar($endereco) === false) {
                            $this->enderecos_erros[] = "Erro ao tentar Atualizar Endereço";
                        } else {
                            $this->enderecos_sucesso[] = "O Endereço do seu Usuario foi Atualizado com Sucesso!";
                            $this->enderecos_form = $endereco;
                        }
                    }
                    
                    $this->Carregar_Pagina();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        public static function Buscar_Estados() : array
        {
            return DAO_Estado::BuscarTodos();
        }
        
        public static function Buscar_Cidades_Por_Estado(?int $id_estado = null) : array
        {
            return DAO_Cidade::BuscarPorCOD($id_estado);
        }
    }
