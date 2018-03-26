<?php
namespace Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar;
    
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    use Module\Application\Model\OBJ\Modelo as OBJ_Modelo;
    use Module\Application\Model\OBJ\Marca as OBJ_Marca;
    use Module\Application\Model\OBJ\Categoria as OBJ_Categoria;
    use Module\Administration\Controller\Layout\Menu\Admin as Controller_Admin;
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Alterar as View_Alterar;
    
    class Alterar
    {
        function __construct()
        {
            
        }
        
        /**
         * @var int $categoria ID da Categoria
         */
        private $categoria;
        
        /**
         * @var int $marca ID da Marca
         */
        private $marca;
        
        /**
         * @var int $modelo ID do Modelo
         */
        private $modelo;
        
        /**
         * @var int $versao ID da Versão
         */
        private $versao;
        
        /**
         * @var string $nome Nome do Elemento
         */
        private $nome;
        
        /**
         * @var string $url URL do Elemento
         */
        private $url;
        
        /**
         * @param int $categoria
         */
        public function set_categoria($categoria) : void
        {
            if (filter_var($categoria, FILTER_VALIDATE_INT) !== false) {
                $this->categoria = $categoria;
            }
        }
        
        /**
         * @param int $marca
         */
        public function set_marca($marca) : void
        {
            if (filter_var($marca, FILTER_VALIDATE_INT) !== false) {
                $this->marca = $marca;
            }
        }
        
        /**
         * @param int $modelo
         */
        public function set_modelo($modelo) : void
        {
            if (filter_var($modelo, FILTER_VALIDATE_INT) !== false) {
                $this->modelo = $modelo;
            }
        }
        
        /**
         * @param int $versao
         */
        public function set_versao($versao) : void
        {
            if (filter_var($versao, FILTER_VALIDATE_INT) !== false) {
                $this->versao = $versao;
            }
        }
        
        /**
         * @param string $nome
         */
        public function set_nome($nome) : void
        {
            $this->nome = $nome;
        }
        
        /**
         * @param string $url
         */
        public function set_url($url) : void
        {
            $this->url = $url;
        }
        
        /**
         * Instancia e Chama View
         * 
         * @return boolean|void
         */
        public function Carregar_Pagina()
        {
            if (Controller_Admin::Verificar_Autenticacao()) {
                $view = new View_Alterar();
                
                $view->set_categorias(DAO_Categoria::BuscarTodos());
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        /**
         * Alterar informações do elemento selecionado pelo usuario
         */
        public function Alterar_CMMV() : void
        {
            if (!empty($this->versao)) {
                $this->Alterar_Versao();
            } else if (!empty($this->modelo)) {
                $this->Alterar_Modelo();
            } else if (!empty($this->marca)) {
                $this->Alterar_Marca();
            } else if (!empty($this->categoria)) {
                $this->Alterar_Categoria();
            }
        }
        
        /**
         * Altera as informações da Versão
         */
        private function Alterar_Versao() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_versao = new OBJ_Versao();
                
                $obj_versao->set_id($this->versao);
                $obj_versao->set_modelo_id($this->modelo);
                $obj_versao->set_nome($this->nome);
                $obj_versao->set_url($this->url);
        
                if (DAO_Versao::Verificar_Versao_Repetida($obj_versao)) {
                    DAO_Versao::Atualizar($obj_versao);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
                }
            }
        }
        
        /**
         * Altera as informações do Modelo
         */
        private function Alterar_Modelo() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_modelo = new OBJ_Modelo();
                
                $obj_modelo->set_id($this->modelo);
                $obj_modelo->set_marca_id($this->marca);
                $obj_modelo->set_nome($this->nome);
                $obj_modelo->set_url($this->url);
        
                if (DAO_Modelo::Verificar_Modelo_Repetido($obj_modelo)) {
                    DAO_Modelo::Atualizar($obj_modelo);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
                }
            }
        }
        
        /**
         * Altera as informações da Marca
         */
        private function Alterar_Marca() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_marca = new OBJ_Marca();
                
                $obj_marca->set_id($this->marca);
                $obj_marca->set_categoria_id($this->categoria);
                $obj_marca->set_nome($this->nome);
                $obj_marca->set_url($this->url);
        
                if (DAO_Marca::Verificar_Marca_Repetida($obj_marca)) {
                    DAO_Marca::Atualizar($obj_marca);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
                }
            }
        }
        
        /**
         * Altera as informações da Categoria
         */
        private function Alterar_Categoria() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_categoria = new OBJ_Categoria();
        
                $obj_categoria->set_id($this->categoria);
                $obj_categoria->set_nome($this->nome);
                $obj_categoria->set_url($this->url);
        
                if (DAO_Categoria::Verificar_Categoria_Repetida($obj_categoria)) {
                    DAO_Categoria::Atualizar($obj_categoria);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Categoria Nome/URL Já Estão Cadastrados</b></div>";
                }
            }
        }
        
        /**
         * Valida as informações a serem alterdas no Elemento selecionado pelo usuario
         * 
         * @return bool
         */
        private function Validar_Nome_URL() : bool
        {
            if (!empty($this->nome) AND !empty($this->url)) {
                return true;
            } else {
                echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Nome/URL Não Informado</b></div>";
        
                return false;
            }
        }
        
        /**
         * Retorna por Ajax as informações da Categoria em formato json
         */
        public function Retornar_Categoria() : void
        {
            $obj_categoria = $this->Buscar_Categoria_Por_Id($this->categoria);
            
            if (!empty($obj_categoria)) {
                $categoria = array();
                
                $categoria['nome'] = $obj_categoria->get_nome();
                $categoria['url'] = $obj_categoria->get_url();
                
                echo json_encode($categoria);
            }
        }
        
        /**
         * Retorna por Ajax as informações da Marca em formato json
         */
        public function Retornar_Marca() : void
        {
            $obj_marca = $this->Buscar_Marca_Por_Id($this->marca);
             
            if (!empty($obj_marca)) {
                $marca = array();
        
                $marca['nome'] = $obj_marca->get_nome();
                $marca['url'] = $obj_marca->get_url();
        
                echo json_encode($marca);
            }
        }
        
        /**
         * Retorna por Ajax as informações do Modelo em formato json
         */
        public function Retornar_Modelo() : void
        {
            $obj_modelo = $this->Buscar_Modelo_Por_Id($this->modelo);
        
            if (!empty($obj_modelo)) {
                $modelo = array();
        
                $modelo['nome'] = $obj_modelo->get_nome();
                $modelo['url'] = $obj_modelo->get_url();
        
                echo json_encode($modelo);
            }
        }
        
        /**
         * Retorna por Ajax as informações da Versão em formato json
         */
        public function Retornar_Versao() : void
        {
            $obj_versao = $this->Buscar_Versao_Por_Id($this->versao);
        
            if (!empty($obj_versao)) {
                $versao = array();
        
                $versao['nome'] = $obj_versao->get_nome();
                $versao['url'] = $obj_versao->get_url();
        
                echo json_encode($versao);
            }
        }
        
        /**
         * Carrega todas as categorias
         */
        public function Retornar_Categorias() : void
        {
            View_Alterar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        /**
         * Carrega todas as Marcas da Categoria selecionada
         */
        public function Retornar_Marcas_Por_Categoria() : void
        {
            View_Alterar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($this->categoria));
        }
        
        /**
         * Carrega todos os Modelos da Marca selecionada
         */
        public function Retornar_Modelos_Por_Marca() : void
        {
            View_Alterar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($this->marca));
        }
        
        /**
         * Carrega todas as Versões do Modelo selecionado
         */
        public function Retornar_Versoes_Por_Modelo() : void
        {
            View_Alterar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($this->modelo));
        }
        
        /**
         * @param int $categoria
         * @return boolean|array|NULL
         */
        private function Buscar_Marca_Por_Id_Categoria(?int $categoria)
        {
            if (!empty($categoria)) {
                return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $marca
         * @return boolean|array|NULL
         */
        private function Buscar_Modelo_Por_Id_Marca(?int $marca)
        {
            if (!empty($marca)) {
                return DAO_Modelo::Buscar_Por_ID_Marca($marca);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $modelo
         * @return boolean|array|NULL
         */
        private function Buscar_Versoes_Por_Id_Modelo(?int $modelo)
        {
            if (!empty($modelo)) {
                return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $categoria
         * @return boolean|OBJ_Categoria|NULL
         */
        private function Buscar_Categoria_Por_Id(?int $categoria)
        {
            if (!empty($categoria)) {
                return DAO_Categoria::Buscar_Nome_URL_Por_ID($categoria);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $marca
         * @return boolean|OBJ_Marca|NULL
         */
        private function Buscar_Marca_Por_Id(?int $marca)
        {
            if (!empty($marca)) {
                return DAO_Marca::Buscar_Nome_URL_Por_ID($marca);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $modelo
         * @return boolean|OBJ_Modelo|NULL
         */
        private function Buscar_Modelo_Por_Id(?int $modelo)
        {
            if (!empty($modelo)) {
                return DAO_Modelo::Buscar_Nome_URL_Por_ID($modelo);
            } else {
                return null;
            }
        }
        
        /**
         * @param int $versao
         * @return boolean|OBJ_Versao|NULL
         */
        private function Buscar_Versao_Por_Id(?int $versao)
        {
            if (!empty($versao)) {
                return DAO_Versao::Buscar_Nome_URL_Por_ID($versao);
            } else {
                return null;
            }
        }
    }
