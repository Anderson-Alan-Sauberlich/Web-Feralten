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
            $object_categoria = DAO_Categoria::BuscarPorCOD($this->categoria);
            
            if (!empty($object_categoria)) {
                $categoria = array();
                
                $categoria['id'] = $object_categoria->get_id();
                $categoria['nome'] = $object_categoria->get_nome();
                $categoria['url'] = $object_categoria->get_url();
                
                echo json_encode($categoria);
            }
        }
        
        public function Retornar_Marca() : void
        {
            $object_marca = DAO_Marca::BuscarPorCOD($this->marca);
             
            if (!empty($object_marca)) {
                $marca = array();
                
                $marca['id'] = $object_marca->get_id();
                $marca['ctg_id'] = $object_marca->get_categoria_id();
                $marca['nome'] = $object_marca->get_nome();
                $marca['url'] = $object_marca->get_url();
        
                echo json_encode($marca);
            }
        }
        
        public function Retornar_Modelo() : void
        {
            $object_modelo = DAO_Modelo::BuscarPorCOD($this->modelo);
        
            if (!empty($object_modelo)) {
                $modelo = array();
                
                $modelo['id'] = $object_modelo->get_id();
                $modelo['mrc_id'] = $object_modelo->get_marca_id();
                $modelo['nome'] = $object_modelo->get_nome();
                $modelo['url'] = $object_modelo->get_url();
        
                echo json_encode($modelo);
            }
        }
        
        public function Retornar_Versao() : void
        {
            $object_versao = DAO_Versao::BuscarPorCOD($this->versao);
        
            if (!empty($object_versao)) {
                $versao = array();
                
                $versao['id'] = $object_versao->get_id();
                $versao['mdl_id'] = $object_versao->get_modelo_id();
                $versao['nome'] = $object_versao->get_nome();
                $versao['url'] = $object_versao->get_url();
        
                echo json_encode($versao);
            }
        }
        
        public function Retornar_Categorias() : void
        {
            $categorias = array();
            $object_categorias = DAO_Categoria::BuscarTodos();
            
            foreach ($object_categorias as $object_categoria) {
                $categoria = array();
                
                $categoria['id'] = $object_categoria->get_id();
                $categoria['nome'] = $object_categoria->get_nome();
                $categoria['url'] = $object_categoria->get_url();
                
                $categorias[] = $categoria;
            }
            
            echo json_encode($categorias);
        }
        
        public function Retornar_Marcas() : void
        {
            $marcas = array();
            $object_marcas = DAO_Marca::BuscarTodos();
            
            foreach ($object_marcas as $object_marca) {
                $marca = array();
                
                $marca['id'] = $object_marca->get_id();
                $marca['ctg_id'] = $object_marca->get_categoria_id();
                $marca['nome'] = $object_marca->get_nome();
                $marca['url'] = $object_marca->get_url();
                
                $marcas[] = $marca;
            }
            
            echo json_encode($marcas);
        }
        
        public function Retornar_Modelos() : void
        {
            $modelos = array();
            $object_modelos = DAO_Modelo::BuscarTodos();
            
            foreach ($object_modelos as $object_modelo) {
                $modelo = array();
                
                $modelo['id'] = $object_modelo->get_id();
                $modelo['mrc_id'] = $object_modelo->get_marca_id();
                $modelo['nome'] = $object_modelo->get_nome();
                $modelo['url'] = $object_modelo->get_url();
                
                $modelos[] = $modelo;
            }
            
            echo json_encode($modelos);
        }
        
        public function Retornar_Versoes() : void
        {
            $versoes = array();
            $object_versoes = DAO_Versao::BuscarTodos();
            
            foreach ($object_versoes as $object_versao) {
                $versao = array();
                
                $versao['id'] = $object_versao->get_id();
                $versao['mdl_id'] = $object_versao->get_modelo_id();
                $versao['nome'] = $object_versao->get_nome();
                $versao['url'] = $object_versao->get_url();
                
                $versoes[] = $versao;
            }
            
            echo json_encode($versoes);
        }
    }
