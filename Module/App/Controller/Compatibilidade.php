<?php
namespace Module\App\Controller;
    
    use Module\Application\Model\DAO\Categoria_Compativel as DAO_Categoria_Compativel;
    use Module\Application\Model\DAO\Marca_Compativel as DAO_Marca_Compativel;
    use Module\Application\Model\DAO\Modelo_Compativel as DAO_Modelo_Compativel;
    use Module\Application\Model\DAO\Versao_Compativel as DAO_Versao_Compativel;
    
    class Compatibilidade
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
        
        public function Retornar_Categorias() : void
        {
            $categorias = array();
            $object_categorias = DAO_Categoria_Compativel::BuscarTodos();
            
            foreach ($object_categorias as $object_categoria) {
                $categoria = array();
                
                $categoria['id_da_ctg'] = $object_categoria->get_da_id();
                $categoria['id_com_ctg'] = $object_categoria->get_com_id();
                
                $categorias[] = $categoria;
            }
            
            echo json_encode($categorias);
        }
        
        public function Retornar_Marcas() : void
        {
            $marcas = array();
            $object_marcas = DAO_Marca_Compativel::BuscarTodos();
            
            foreach ($object_marcas as $object_marca) {
                $marca = array();
                
                $marca['id_da_mrc'] = $object_marca->get_da_id();
                $marca['id_com_mrc'] = $object_marca->get_com_id();
                
                $marcas[] = $marca;
            }
            
            echo json_encode($marcas);
        }
        
        public function Retornar_Modelos() : void
        {
            $modelos = array();
            $object_modelos = DAO_Modelo_Compativel::BuscarTodos();
            
            foreach ($object_modelos as $object_modelo) {
                $modelo = array();
                
                $modelo['id_da_mdl'] = $object_modelo->get_da_id();
                $modelo['id_com_mdl'] = $object_modelo->get_com_id();
                
                $modelos[] = $modelo;
            }
            
            echo json_encode($modelos);
        }
        
        public function Retornar_Versoes() : void
        {
            $versoes = array();
            $object_versoes = DAO_Versao_Compativel::BuscarTodos();
            
            foreach ($object_versoes as $object_versao) {
                $versao = array();
                
                $versao['id_da_vrs'] = $object_versao->get_da_id();
                $versao['id_com_vrs'] = $object_versao->get_com_id();
                
                $versoes[] = $versao;
            }
            
            echo json_encode($versoes);
        }
    }
