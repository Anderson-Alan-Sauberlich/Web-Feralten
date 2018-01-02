<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Gerenciar_Imagens;
    use Module\Application\Model\Object\Usuario as Object_Usuario;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Object\Endereco as Object_Endereco;
    use Module\Application\Model\Object\Cidade as Object_Cidade;
    use Module\Application\Model\Object\Estado as Object_Estado;
    use Module\Application\Model\DAO\Usuario as DAO_Usuario;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Endereco as DAO_Endereco;
    use Module\Application\Model\DAO\Estado as DAO_Estado;
    use Module\Application\Model\DAO\Cidade as DAO_Cidade;
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Concluir as View_Concluir;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Controller\Usuario\Login as Controller_Login;
    use Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas as Controller_Faturas;
    use \Exception;
    
    class Concluir
    {
        
        function __construct()
        {
            
        }
        
        /**
         * @var string $fone Numero de telefone principal do Usuario
         */
        private $fone;
        
        /**
         * @var string $fone_alternativo Numero de telefone alternativo do Usuario
         */
        private $fone_alternativo;
        
        /**
         * @var string $email_alternativo Endereço de E-mail alternativo do Usuario
         */
        private $email_alternativo;
        
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
         * @var string $cpf_cnpj Numero do CPF ou CPNJ da Entidade
         */
        private $cpf_cnpj;
        
        /**
         * @var string $site Endereço do Site da Entidade
         */
        private $site;
        
        /**
         * @var string $nome_comercial Nome Comercial da Entidade
         */
        private $nome_comercial;
        
        /**
         * @var array $concluir_erros Array com todos os erros
         */
        private $concluir_erros = array();
        
        /**
         * @var array $concluir_campos Array com todos os Status dos Campos do Formulario
         */
        private $concluir_campos = array();
        
        /**
         * @var array $concluir_form Array com todos os Valores dos Campos do Formulario
         */
        private $concluir_form = array();
        
        /**
         * @param string $fone
         */
        public function set_fone($fone) : void
        {
            try {
                $this->fone = Validador::Usuario()::validar_fone($fone);
                $this->concluir_campos['erro_fone'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_fone'] = 'erro';
                
                $this->fone = Validador::Usuario()::filtrar_fone($fone);
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
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_fone_alternativo'] = 'erro';
                
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
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_email_alternativo'] = 'erro';
                
                $this->email_alternativo = Validador::Usuario()::filtrar_email_alternativo($email_alternativo);
            }
        }
        
        /**
         * @param int $estado
         */
        public function set_estado($estado) : void
        {
            try {
                $this->estado = Validador::Estado()::validar_id($estado);
                $this->concluir_campos['erro_estado'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_estado'] = 'erro';
                
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
                $this->concluir_campos['erro_cidade'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_cidade'] = 'erro';
                
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
                $this->concluir_campos['erro_numero'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_numero'] = 'erro';
                
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
                $this->concluir_campos['erro_cep'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_cep'] = 'erro';
                
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
                $this->concluir_campos['erro_bairro'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_bairro'] = 'erro';
                
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
                $this->concluir_campos['erro_rua'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_rua'] = 'erro';
                
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
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_complemento'] = 'erro';
                
                $this->complemento = Validador::Endereco()::filtrar_complemento($complemento);
            }
        }
        
        /**
         * @param string $cpf_cnpj
         */
        public function set_cpf_cnpj($cpf_cnpj) : void
        {
            try {
                $this->cpf_cnpj = Validador::Entidade()::validar_cpf_cnpj($cpf_cnpj);
                $this->concluir_campos['erro_cpf_cnpj'] = 'certo';
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_cpf_cnpj'] = 'erro';
                
                $this->cpf_cnpj = Validador::Entidade()::filtrar_cpf_cnpj($cpf_cnpj);
            }
        }
        
        /**
         * @param string $site
         */
        public function set_site($site = null) : void
        {
            try {
                $this->site = Validador::Entidade()::validar_site($site);
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_site'] = 'erro';
                
                $this->site = Validador::Entidade()::filtrar_site($site);
            }
        }
        
        /**
         * @param string $nome_comercial
         */
        public function set_nome_comercial($nome_comercial = null) : void
        {
            try {
                $this->nome_comercial = Validador::Entidade()::validar_nome_comercial($nome_comercial);
            } catch (Exception $e) {
                $this->concluir_erros[] = $e->getMessage();
                $this->concluir_campos['erro_nome_comercial'] = 'erro';
                
                $this->nome_comercial = Validador::Entidade()::filtrar_nome_comercial($nome_comercial);
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
                
                if ($status == 0) {
                    $view = new View_Concluir($status);
                    
                    $view->set_concluir_campos($this->concluir_campos);
                    $view->set_concluir_erros($this->concluir_erros);
                    $view->set_concluir_form($this->concluir_form);
                     
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Salva os dados do usuario
         * 
         * @return string|number|NULL|boolean
         */
        public function Concluir_Cadastro()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status == 0) {
                    if (empty($this->concluir_erros)) {
                        $usuario = new Object_Usuario();
                        $usuario->set_fone($this->fone);
                        $usuario->set_fone_alternativo($this->fone_alternativo);
                        $usuario->set_email_alternativo($this->email_alternativo);
                        $usuario->set_id(Login_Session::get_usuario_id());
                        
                        if (DAO_Usuario::Atualizar_Contato($usuario) !== false) {
                            $entidade = new Object_Entidade();
                            $entidade->set_usuario_id(Login_Session::get_usuario_id());
                            $entidade->set_status_id(1);
                            $entidade->set_intervalo_pagamento_id(1);
                            $entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                            $entidade->set_plano_id(1);
                            $entidade->set_data(date('Y-m-d H:i:s'));
                            $entidade->set_cpf_cnpj($this->cpf_cnpj);
                            $entidade->set_site($this->site);
                            $entidade->set_nome_comercial($this->nome_comercial);
                            
                            $id_entidade = DAO_Entidade::Inserir($entidade);
                            
                            if ($id_entidade != false) {
                                Login_Session::set_entidade_id($id_entidade);
                                
                                if (Controller_Faturas::Criar_Fatura($id_entidade, 1)) {
                                    Login_Session::set_entidade_plano(1);
                                } else {
                                    $this->concluir_erros[] = 'Erro ao tentar gerar fatura';
                                }
                                
                                $imagem = $this->Salvar_Imagem();
                                
                                if (!empty($imagem)) {
                                    DAO_Entidade::Atualizar_Imagem($imagem, $id_entidade);
                                }
                                
                                $object_estado = new Object_Estado();
                                $object_estado->set_id($this->estado);
                                
                                $object_cidade = new Object_Cidade();
                                $object_cidade->set_id($this->cidade);
                                
                                $endereco = new Object_Endereco();
                                $endereco->set_id(0);
                                $endereco->set_entidade_id($id_entidade);
                                $endereco->set_cidade($object_cidade);
                                $endereco->set_estado($object_estado);
                                $endereco->set_numero($this->numero);
                                $endereco->set_cep($this->cep);
                                $endereco->set_bairro($this->bairro);
                                $endereco->set_rua($this->rua);
                                $endereco->set_complemento($this->complemento);
                                
                                if (DAO_Endereco::Inserir($endereco) === false) {
                                    $this->concluir_erros[] = "Erro ao tentar Inserir Endereço do Usuario";
                                }
                            } else {
                                $this->concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
                            }
                        } else {
                            $this->concluir_erros[] = "Erro ao tentar Inserir Dados do Usuario";
                        }
                    }
                    
                    if (empty($this->concluir_erros)) {
                        Controller_Login::ReAutenticar_Usuario_Logado(Login_Session::get_usuario_id());
                        
                        return 'certo';
                    } else {
                        $this->concluir_form['fone'] = $this->fone;
                        $this->concluir_form['fone_alternativo'] = $this->fone_alternativo;
                        $this->concluir_form['cidade'] = $this->cidade;
                        $this->concluir_form['estado'] = $this->estado;
                        $this->concluir_form['numero'] = $this->numero;
                        $this->concluir_form['cep'] = $this->cep;
                        $this->concluir_form['rua'] = $this->rua;
                        $this->concluir_form['complemento'] = $this->complemento;
                        $this->concluir_form['bairro'] = $this->bairro;
                        $this->concluir_form['cpf_cnpj'] = $this->cpf_cnpj;
                        $this->concluir_form['nome_comercial'] = $this->nome_comercial;
                        $this->concluir_form['email_alternativo'] = $this->email_alternativo;
                        $this->concluir_form['site'] = $this->site;
                        
                        $this->Carregar_Pagina();
                    }
                } else {
                    return $status;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Retorna por Ajax as Cidades quando o usuario seleciona um Estado
         */
        public function Retornar_Cidades_Por_Estado() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (!empty($this->estado)) {
                    if (filter_var($this->estado, FILTER_VALIDATE_INT)) {
                        View_Concluir::Mostrar_Cidades($this->estado);
                    }
                }
            }
        }
        
        /**
         * Salva as Imagens em uma pasta temporaria até o usuario concluir o cadastro
         */
        public function Salvar_Imagem_TMP() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (isset($_FILES['imagem']) AND $_FILES['imagem']['error'] === 0) {
                    $imagens = new Gerenciar_Imagens();
                        
                    $imagens->Armazenar_Imagem_Temporaria($_FILES['imagem']);
                        
                    $_SESSION['imagem_tmp'] = $imagens->get_nome();
                        
                    echo $imagens::Gerar_Data_URL($imagens->get_caminho()."-200x150.".$imagens->get_extensao());
                } else {
                    echo "/resources/img/imagem_indisponivel.png";
                }
            }
        }
        
        /**
         * Remove as imagens da pasta temporaria
         */
        public function Deletar_Imagem() : void
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                if (isset($_SESSION['imagem_tmp'])) {
                    $imagens = new Gerenciar_Imagens();
                    
                    $imagens->Deletar_Imagem_Temporaria($_SESSION['imagem_tmp']);
                    
                    unset($_SESSION['imagem_tmp']);
                }
            }
        }
        
        /**
         * Retorna a imagem em formato Base64
         * function usada após carregar as imagens no servidor
         * 
         * @param string $nome_imagem
         * @return string
         */
        public static function Pegar_Imagem_URL(?string $nome_imagem = null) : string
        {
            $imagens = new Gerenciar_Imagens();
            
            $caminho_imagem = $imagens->Pegar_Caminho_Por_Nome_Imagem($nome_imagem."-200x150");
            
            if (isset($caminho_imagem)) {
                return $imagens::Gerar_Data_URL($caminho_imagem);
            } else {
                return "/resources/img/imagem_indisponivel.png";
            }
        }

        /**
         * Salva as imagens da pasta temporaria para a pasta real do usuario
         * Function chamada ao Concluir Cadastro
         * 
         * @return string|NULL
         */
        private function Salvar_Imagem() : ?string
        {
            if (isset($_SESSION['imagem_tmp']) AND !empty($_SESSION['imagem_tmp'])) {
                $img_nome = null;
                $imagens = new Gerenciar_Imagens();
                
                if (!empty($this->nome_comercial)) {
                    $img_nome = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp'], Validador::Entidade()::filtrar_descricao_imagem($this->nome_comercial));
                } else {
                    $img_nome = $imagens->Arquivar_Imagem_Entidade($_SESSION['imagem_tmp']);
                }
                
                unset($_SESSION['imagem_tmp']);
                
                if (!empty($img_nome)) {
                    return $img_nome;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        /**
         * Retorna um array com todos os estados
         * Function chamada na View Concluir Cadastro
         * 
         * @return array
         */
        public static function Buscar_Todos_Estados() : array
        {
            return DAO_Estado::BuscarTodos();
        }
        
        /**
         * Retorna todas as cidades do estado celecionado
         * Function chamada na View Concluir Cadastro
         * 
         * @param int $id_estado
         * @return array
         */
        public static function Buscar_Cidades_Por_Estado(?int $id_estado = null) : array
        {
            return DAO_Cidade::BuscarPorCOD($id_estado);
        }
    }
