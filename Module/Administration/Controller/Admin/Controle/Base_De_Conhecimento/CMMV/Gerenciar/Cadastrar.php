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
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Cadastrar as View_Cadastrar;
    
    class Cadastrar
    {
        function __construct()
        {
            
        }
        
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $nome;
        private $url;
        
        public function set_categoria($categoria) : void
        {
            if (filter_var($categoria, FILTER_VALIDATE_INT) !== false) {
                $this->categoria = $categoria;
            }
        }
        
        public function set_marca($marca) : void
        {
            if (filter_var($marca, FILTER_VALIDATE_INT) !== false) {
                $this->marca = $marca;
            }
        }
        
        public function set_modelo($modelo) : void
        {
            if (filter_var($modelo, FILTER_VALIDATE_INT) !== false) {
                $this->modelo = $modelo;
            }
        }
        
        public function set_versao($versao) : void
        {
            if (filter_var($versao, FILTER_VALIDATE_INT) !== false) {
                $this->versao = $versao;
            }
        }
        
        public function set_nome($nome) : void
        {
            $this->nome = $nome;
        }
        
        public function set_url($url) : void
        {
            $this->url = $url;
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Admin::Verificar_Autenticacao()) {
                $view = new View_Cadastrar();
                
                $view->set_categorias(DAO_Categoria::BuscarTodos());
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public function Cadastrar_CMMV() : void
        {
            if (!empty($this->modelo)) {
                $this->Cadastrar_Versao();
            } else if (!empty($this->marca)) {
                $this->Cadastrar_Modelo();
            } else if (!empty($this->categoria)) {
                $this->Cadastrar_Marca();
            } else {
                $this->Cadastrar_Categoria();
            }
        }
        
        private function Cadastrar_Versao() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_versao = new OBJ_Versao();
                
                $obj_versao->set_modelo_id($this->modelo);
                $obj_versao->set_nome($this->nome);
                $obj_versao->set_url($this->url);
                
                if (DAO_Versao::Verificar_Versao_Repetida($obj_versao)) {
                    DAO_Versao::Inserir($obj_versao);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Versão Nome/URL Já Estão Cadastrados Para Este Modelo</b></div>";
                }
            }
        }
        
        private function Cadastrar_Modelo() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_modelo = new OBJ_Modelo();
                
                $obj_modelo->set_marca_id($this->marca);
                $obj_modelo->set_nome($this->nome);
                $obj_modelo->set_url($this->url);
                
                if (DAO_Modelo::Verificar_Modelo_Repetido($obj_modelo)) {
                    DAO_Modelo::Inserir($obj_modelo);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Modelo Nome/URL Já Estão Cadastrados Para Está Marca</b></div>";
                }
            }
        }
        
        private function Cadastrar_Marca() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_marca = new OBJ_Marca();
                
                $obj_marca->set_categoria_id($this->categoria);
                $obj_marca->set_nome($this->nome);
                $obj_marca->set_url($this->url);
                
                if (DAO_Marca::Verificar_Marca_Repetida($obj_marca)) {
                    DAO_Marca::Inserir($obj_marca);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Marca Nome/URL Já Estão Cadastrados Para Está Categoria</b></div>";
                }
            }
        }
        
        private function Cadastrar_Categoria() : void
        {
            if ($this->Validar_Nome_URL()) {
                $obj_categoria = new OBJ_Categoria();
                
                $obj_categoria->set_nome($this->nome);
                $obj_categoria->set_url($this->url);
                
                if (DAO_Categoria::Verificar_Categoria_Repetida($obj_categoria)) {
                    DAO_Categoria::Inserir($obj_categoria);
                } else {
                    echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Categoria Nome/URL Já Estão Cadastrados</b></div>";
                }
            }
        }
        
        private function Validar_Nome_URL() : bool
        {
            if (!empty($this->nome) AND !empty($this->url)) {
                return true;
            } else {
                echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><b>Erro: Nome/URL Não Informado</b></div>";
                
                return false;
            }
        }
        
        public function Retornar_Categorias() : void
        {
            View_Cadastrar::Carregar_Categorias(DAO_Categoria::BuscarTodos());
        }
        
        public function Retornar_Marcas_Por_Categoria() : void
        {
            View_Cadastrar::Carregar_Marcas($this->Buscar_Marca_Por_Id_Categoria($this->categoria));
        }
        
        public function Retornar_Modelos_Por_Marca() : void
        {
            View_Cadastrar::Carregar_Modelos($this->Buscar_Modelo_Por_Id_Marca($this->marca));
        }
        
        public function Retornar_Versoes_Por_Modelo() : void
        {
            View_Cadastrar::Carregar_Versoes($this->Buscar_Versoes_Por_Id_Modelo($this->modelo));
        }
        
        private function Buscar_Marca_Por_Id_Categoria(?int $categoria)
        {
            if (!empty($categoria)) {
                return DAO_Marca::Buscar_Por_ID_Categorai($categoria);
            } else {
                return null;
            }
        }
        
        private function Buscar_Modelo_Por_Id_Marca(?int $marca)
        {
            if (!empty($marca)) {
                return DAO_Modelo::Buscar_Por_ID_Marca($marca);
            } else {
                return null;
            }
        }
        
        private function Buscar_Versoes_Por_Id_Modelo(?int $modelo)
        {
            if (!empty($modelo)) {
                return DAO_Versao::Buscar_Por_ID_Modelo($modelo);
            } else {
                return null;
            }
        }
    }
