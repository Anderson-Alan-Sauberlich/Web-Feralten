<?php
namespace Module\App\Controller;
    
    use Module\Application\Model\DAO\Categoria as DAO_Categoria;
    use Module\Application\Model\DAO\Marca as DAO_Marca;
    use Module\Application\Model\DAO\Modelo as DAO_Modelo;
    use Module\Application\Model\DAO\Versao as DAO_Versao;
    
    class CMMV
    {
        function __construct()
        {
            
        }
        
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        
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
        
        public function Carregar_Pagina()
        {
            
        }
        
        public function Retornar_Categoria() : void
        {
            $obj_categoria = DAO_Categoria::BuscarPorCOD($this->categoria);
            
            if (!empty($obj_categoria)) {
                $categoria = array();
                
                $categoria['id'] = $obj_categoria->get_id();
                $categoria['nome'] = $obj_categoria->get_nome();
                $categoria['url'] = $obj_categoria->get_url();
                
                echo json_encode($categoria);
            }
        }
        
        public function Retornar_Marca() : void
        {
            $obj_marca = DAO_Marca::BuscarPorCOD($this->marca);
             
            if (!empty($obj_marca)) {
                $marca = array();
                
                $marca['id'] = $obj_marca->get_id();
                $marca['ctg_id'] = $obj_marca->get_categoria_id();
                $marca['nome'] = $obj_marca->get_nome();
                $marca['url'] = $obj_marca->get_url();
        
                echo json_encode($marca);
            }
        }
        
        public function Retornar_Modelo() : void
        {
            $obj_modelo = DAO_Modelo::BuscarPorCOD($this->modelo);
        
            if (!empty($obj_modelo)) {
                $modelo = array();
                
                $modelo['id'] = $obj_modelo->get_id();
                $modelo['mrc_id'] = $obj_modelo->get_marca_id();
                $modelo['nome'] = $obj_modelo->get_nome();
                $modelo['url'] = $obj_modelo->get_url();
        
                echo json_encode($modelo);
            }
        }
        
        public function Retornar_Versao() : void
        {
            $obj_versao = DAO_Versao::BuscarPorCOD($this->versao);
        
            if (!empty($obj_versao)) {
                $versao = array();
                
                $versao['id'] = $obj_versao->get_id();
                $versao['mdl_id'] = $obj_versao->get_modelo_id();
                $versao['nome'] = $obj_versao->get_nome();
                $versao['url'] = $obj_versao->get_url();
        
                echo json_encode($versao);
            }
        }
        
        public function Retornar_Categorias() : void
        {
            $categorias = array();
            $obj_categorias = DAO_Categoria::BuscarTodos();
            
            foreach ($obj_categorias as $obj_categoria) {
                $categoria = array();
                
                $categoria['id'] = $obj_categoria->get_id();
                $categoria['nome'] = $obj_categoria->get_nome();
                $categoria['url'] = $obj_categoria->get_url();
                
                $categorias[] = $categoria;
            }
            
            echo json_encode($categorias);
        }
        
        public function Retornar_Marcas() : void
        {
            $marcas = array();
            $obj_marcas = DAO_Marca::BuscarTodos();
            
            foreach ($obj_marcas as $obj_marca) {
                $marca = array();
                
                $marca['id'] = $obj_marca->get_id();
                $marca['ctg_id'] = $obj_marca->get_categoria_id();
                $marca['nome'] = $obj_marca->get_nome();
                $marca['url'] = $obj_marca->get_url();
                
                $marcas[] = $marca;
            }
            
            echo json_encode($marcas);
        }
        
        public function Retornar_Modelos() : void
        {
            $modelos = array();
            $obj_modelos = DAO_Modelo::BuscarTodos();
            
            foreach ($obj_modelos as $obj_modelo) {
                $modelo = array();
                
                $modelo['id'] = $obj_modelo->get_id();
                $modelo['mrc_id'] = $obj_modelo->get_marca_id();
                $modelo['nome'] = $obj_modelo->get_nome();
                $modelo['url'] = $obj_modelo->get_url();
                
                $modelos[] = $modelo;
            }
            
            echo json_encode($modelos);
        }
        
        public function Retornar_Versoes() : void
        {
            $versoes = array();
            $obj_versoes = DAO_Versao::BuscarTodos();
            
            foreach ($obj_versoes as $obj_versao) {
                $versao = array();
                
                $versao['id'] = $obj_versao->get_id();
                $versao['mdl_id'] = $obj_versao->get_modelo_id();
                $versao['nome'] = $obj_versao->get_nome();
                $versao['url'] = $obj_versao->get_url();
                
                $versoes[] = $versao;
            }
            
            echo json_encode($versoes);
        }
    }
