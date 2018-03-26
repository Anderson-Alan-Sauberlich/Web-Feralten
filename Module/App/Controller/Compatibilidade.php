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
            $obj_categorias = DAO_Categoria_Compativel::BuscarTodos();
            
            foreach ($obj_categorias as $obj_categoria) {
                $categoria = array();
                
                $categoria['id_da_ctg'] = $obj_categoria->get_da_id();
                $categoria['id_com_ctg'] = $obj_categoria->get_com_id();
                
                $categorias[] = $categoria;
            }
            
            echo json_encode($categorias);
        }
        
        public function Retornar_Marcas() : void
        {
            $marcas = array();
            $obj_marcas = DAO_Marca_Compativel::BuscarTodos();
            
            foreach ($obj_marcas as $obj_marca) {
                $marca = array();
                
                $marca['id_da_mrc'] = $obj_marca->get_da_id();
                $marca['id_com_mrc'] = $obj_marca->get_com_id();
                
                $marcas[] = $marca;
            }
            
            echo json_encode($marcas);
        }
        
        public function Retornar_Modelos() : void
        {
            $modelos = array();
            $obj_modelos = DAO_Modelo_Compativel::BuscarTodos();
            
            foreach ($obj_modelos as $obj_modelo) {
                $modelo = array();
                
                $modelo['id_da_mdl'] = $obj_modelo->get_da_id();
                $modelo['id_com_mdl'] = $obj_modelo->get_com_id();
                
                $modelos[] = $modelo;
            }
            
            echo json_encode($modelos);
        }
        
        public function Retornar_Versoes() : void
        {
            $versoes = array();
            $obj_versoes = DAO_Versao_Compativel::BuscarTodos();
            
            foreach ($obj_versoes as $obj_versao) {
                $versao = array();
                
                $versao['id_da_vrs'] = $obj_versao->get_da_id();
                $versao['id_com_vrs'] = $obj_versao->get_com_id();
                
                $versoes[] = $versao;
            }
            
            echo json_encode($versoes);
        }
    }
