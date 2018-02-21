<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Endereco as View_Endereco;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\Object\Endereco as Object_Endereco;
    use Module\Application\Model\DAO\Cidade as DAO_Cidade;
    use Module\Application\Model\DAO\Estado as DAO_Estado;
    use Module\Application\Model\Object\Cidade as Object_Cidade;
    use Module\Application\Model\Object\Estado as Object_Estado;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use \Exception;
    
    class Endereco
    {
        function __construct()
        {
            
        }
        
        /**
         * @var int $estado ID do Estado do Endereço
         */
        private $estado;
        
        /**
         * @var int $cidade ID da Cidade do Endereço
         */
        private $cidade;
        
        /**
         * @var string $numero Numero do Endereço
         */
        private $numero;
        
        /**
         * @var string $cep Numero do CEP do Endereço
         */
        private $cep;
        
        /**
         * @var string $bairro Nome do Bairro do Endereço
         */
        private $bairro;
        
        /**
         * @var string $rua Nome da Rua do Endereço
         */
        private $rua;
        
        /**
         * @var string $complemento Descrição do Complemento do Endereço
         */
        private $complemento;
        
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
         * @param int $estado
         */
        public function set_estado($estado) : void
        {
            try {
                $this->estado = Validador::Estado()::validar_id($estado);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['estado'] = 'erro';
                
                $this->estado = Validador::Estado()::filtrar_id($estado);
            }
        }
        
        /**
         * @param int $cidade
         */
        public function set_cidade($cidade) : void
        {
            try {
                $this->cidade = Validador::Cidade()::validar_id($cidade);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['cidade'] = 'erro';
                
                $this->cidade = Validador::Cidade()::filtrar_id($cidade);
            }
        }
        
        /**
         * @param string $numero
         */
        public function set_numero($numero) : void
        {
            try {
                $this->numero = Validador::Endereco()::validar_numero($numero);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['numero'] = 'erro';
                
                $this->numero = Validador::Endereco()::filtrar_numero($numero);
            }
        }
        
        /**
         * @param string $cep
         */
        public function set_cep($cep) : void
        {
            try {
                $this->cep = Validador::Endereco()::validar_cep($cep);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['cep'] = 'erro';
                
                $this->cep = Validador::Endereco()::filtrar_cep($cep);
            }
        }
        
        /**
         * @param string $bairro
         */
        public function set_bairro($bairro) : void
        {
            try {
                $this->bairro = Validador::Endereco()::validar_bairro($bairro);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['bairro'] = 'erro';
                
                $this->bairro = Validador::Endereco()::filtrar_bairro($bairro);
            }
        }
        
        /**
         * @param string $rua
         */
        public function set_rua($rua) : void
        {
            try {
                $this->rua = Validador::Endereco()::validar_rua($rua);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['rua'] = 'erro';
                
                $this->rua = Validador::Endereco()::filtrar_rua($rua);
            }
        }
        
        /**
         * @param string $complemento
         */
        public function set_complemento($complemento = null) : void
        {
            try {
                $this->complemento = Validador::Endereco()::validar_complemento($complemento);
            } catch (Exception $e) {
                $this->erros[] = $e->getMessage();
                $this->campos['complemento'] = 'erro';
                
                $this->complemento = Validador::Endereco()::filtrar_complemento($complemento);
            }
        }
        
        /**
         * Instancia e Abre a View
         *
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
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
         * @return View_Endereco
         */
        public function Retornar_Pagina() : View_Endereco
        {
            $view = new View_Endereco();
            
            $estados = DAO_Estado::BuscarTodos();
            
            if (!empty($estados) && $estados != false) {
                $view->set_estados($estados);
            }
            
            if (Login_Session::Verificar_Entidade()) {
                $obj_endereco = DAO_Endereco::Buscar_Por_Id_Entidade(Login_Session::get_entidade_id());
                
                if ($obj_endereco instanceof Object_Endereco) {
                    $view->set_obj_endereco($obj_endereco);
                    
                    $cidades = DAO_Cidade::BuscarPorCOD($obj_endereco->get_estado()->get_id());
                    
                    if (!empty($cidades) && $cidades != false) {
                        $view->set_cidades($cidades);
                    }
                }
            }
            
            return $view;
        }
        
        /**
         * FUnction chamada por ajax para salvar os valores do form.
         */
        public function SalvarDados() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 1) {
                    if (empty($this->erros)) {
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
                            $this->erros[] = "Erro ao tentar Atualizar Endereço";
                        } else {
                            $this->sucessos[] = "O Endereço do seu Usuario foi Atualizado com Sucesso!";
                        }
                    }
                }
            }
            
            $retorno['erros'] = View_Endereco::CriarListagem($this->erros);
            $retorno['sucessos'] = View_Endereco::CriarListagem($this->sucessos);
            $retorno['campos'] = $this->campos;
            
            echo json_encode($retorno);
        }
        
        /**
         * Function chamada por ajax para recarregar os valores do form.
         */
        public function CarregarDados() : void
        {
            $endereco['cep'] = '';
            $endereco['estado'] = '';
            $endereco['cidade'] = '';
            $endereco['bairro'] = '';
            $endereco['rua'] = '';
            $endereco['numero'] = '';
            $endereco['complemento'] = '';
            
            if (Login_Session::Verificar_Entidade()) {
                $obj_endereco = DAO_Endereco::Buscar_Por_Id_Entidade(Login_Session::get_entidade_id());
                
                if ($obj_endereco instanceof Object_Endereco) {
                    $endereco['cep'] = $obj_endereco->get_cep();
                    $endereco['estado'] = $obj_endereco->get_estado()->get_uf();
                    $endereco['cidade'] = $obj_endereco->get_cidade()->get_id();
                    $endereco['bairro'] = $obj_endereco->get_bairro();
                    $endereco['rua'] = $obj_endereco->get_rua();
                    $endereco['numero'] = $obj_endereco->get_numero();
                    $endereco['complemento'] = $obj_endereco->get_complemento();
                }
            }
            
            echo json_encode($endereco);
        }
        
        /**
         * Function chamada por ajax para carregar novas cidades pelo estado selecionado.
         */
        public function Retornar_Cidades_Por_Estado() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (empty($this->erros)) {
                    $cidades = DAO_Cidade::BuscarPorCOD($this->estado);
                    
                    if (!empty($cidades) && $cidades != false) {
                        View_Endereco::MostrarCidades($cidades);
                    }
                }
            }
        }
    }
