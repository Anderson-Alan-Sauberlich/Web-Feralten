<?php
namespace Module\Application\Controller\Layout\Menu;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Validador;
    use Module\Application\View\SRC\Layout\Menu\Filtro as View_Filtro;
    use Module\Application\Model\DAO\Cidade as DAO_Cidade;
    use Module\Application\Model\DAO\Estado as DAO_Estado;
    use Module\Application\Model\Object\Cidade as Object_Cidade;
    use Module\Application\Model\Object\Estado as Object_Estado;
    use Module\Application\Model\DAO\Status_Peca as DAO_Status_Peca;
    use Module\Application\Model\DAO\Estado_Uso_Peca as DAO_Estado_Uso_Peca;
    use Module\Application\Model\Object\Status_Peca as Object_Status_Peca;
    use Module\Application\Model\Object\Estado_Uso_Peca as Object_Estado_Uso_Peca;
    use Module\Application\Model\Object\Preferencia_Entrega as Object_Preferencia_Entrega;
    use Module\Application\Model\DAO\Preferencia_Entrega as DAO_Preferencia_Entrega;
    use \Exception;
    
    class Filtro
    {
        function __construct()
        {
            
        }
        
        private $estado;
        private $cidade;
        private $estado_uso;
        private $ordem_preco;
        private $ordem_data;
        private $preferencia_entrega;
        private $status_peca;
        
        public function set_estado($estado) : void
        {
            try {
                $this->estado = Validador::Estado()::validar_id($estado);
            } catch (Exception $e) {
                $this->estado = Validador::Estado()::filtrar_id($estado);
            }
        }
        
        public function set_cidade($cidade) : void
        {
            try {
                $this->cidade = Validador::Cidade()::validar_id($cidade);
            } catch (Exception $e) {
                $this->cidade = Validador::Cidade()::filtrar_id($cidade);
            }
        }
        
        public function set_estado_uf($estado_uf) : void
        {
            try {
                $this->set_estado(DAO_Estado::Buscar_Id_Por_Uf(Validador::Estado()::validar_uf($estado_uf)));
            } catch (Exception $e) {
                $this->estado = null;
            }
        }
        
        public function set_cidade_url($cidade_url) : void
        {
            try {
                if ($cidade_url != 'estoque') {
                    $this->set_cidade(DAO_Cidade::Buscar_Id_Por_Url(Validador::Cidade()::validar_url($cidade_url)));
                }
            } catch (Exception $e) {
                $this->cidade = null;
            }
        }
        
        public function set_ordem_preco($ordem_preco) : void
        {
            try {
                $this->ordem_preco = Validador::Peca()::validar_ordem_preco($ordem_preco);
            } catch (Exception $e) {
                $this->ordem_preco = null;
            }
        }
        
        public function set_ordem_data($ordem_data) : void
        {
            try {
                $this->ordem_data = Validador::Peca()::validar_ordem_data($ordem_data);
            } catch (Exception $e) {
                $this->ordem_data = null;
            }
        }
        
        public function set_estado_uso($estado_uso) : void
        {
            try {
                $this->estado_uso = Validador::Peca()::validar_estado_uso($estado_uso);
            } catch (Exception $e) {
                $this->estado_uso = null;
            }
        }
        
        public function set_estado_uso_url($estado_uso) : void
        {
            try {
                $this->estado_uso = DAO_Estado_Uso_Peca::Buscar_Id_Por_Url(Validador::Estado_Uso_Peca()::validar_url($estado_uso));
            } catch (Exception $e) {
                $this->estado_uso = null;
            }
        }
        
        public function set_preferencia_entrega($preferencia_entrega) : void
        {
            try {
                $this->preferencia_entrega = Validador::Preferencia_Entrega()::validar_id($preferencia_entrega);
            } catch (Exception $e) {
                $this->preferencia_entrega = null;
            }
        }
        
        public function set_preferencia_entrega_url($preferencia_entrega) : void
        {
            try {
                $this->preferencia_entrega = DAO_Preferencia_Entrega::Buscar_Id_Por_Url(Validador::Preferencia_Entrega()::validar_url($preferencia_entrega));
            } catch (Exception $e) {
                $this->preferencia_entrega = null;
            }
        }
        
        public function set_status_peca($status_peca) : void
        {
            try {
                if (self::Verificar_Login()) {
                  $this->status_peca = Validador::Status_Peca()::validar_id($status_peca);
                }
            } catch (Exception $e) {
                $this->status_peca = null;
            }
        }
        
        public function set_status_peca_url($status_peca) : void
        {
            try {
                if (self::Verificar_Login()) {
                  $this->status_peca = DAO_Status_Peca::Buscar_Id_Por_Url(Validador::Status_Peca()::validar_url($status_peca));
                }
            } catch (Exception $e) {
                $this->status_peca = null;
            }
        }
        
        public function get_estado() : ?int
        {
            return $this->estado;
        }
        
        public function get_cidade() : ?int
        {
            return $this->cidade;
        }
        
        public function get_estado_uso() : ?int
        {
            return $this->estado_uso;
        }
        
        public function get_preferencia_entrega() : ?int
        {
            return $this->preferencia_entrega;
        }
        
        public function get_status_peca() : ?int
        {
            return $this->status_peca;
        }
        
        public function get_object_estado() : ?Object_Estado
        {
            if (!empty($this->estado)) {
                $object_estado = new Object_Estado();
                
                $object_estado->set_id($this->estado);
                
                return $object_estado;
            } else {
                return null;
            }
        }
        
        public function get_object_cidade() : ?Object_Cidade
        {
            if (!empty($this->cidade)) {
                $object_cidade = new Object_Cidade();
                
                $object_cidade->set_id($this->cidade);
                
                return $object_cidade;
            } else {
                return null;
            }
        }
        
        public function get_object_estado_uso() : ?Object_Estado_Uso_Peca
        {
            if (!empty($this->estado_uso)) {
                $object_estado_uso_peca = new Object_Estado_Uso_Peca();
                
                $object_estado_uso_peca->set_id($this->estado_uso);
                
                return $object_estado_uso_peca;
            } else {
                return null;
            }
        }
        
        public function get_object_preferencia_entrega() : ?Object_Preferencia_Entrega
        {
            if (!empty($this->preferencia_entrega)) {
                $object_preferencia_entrega = new Object_Preferencia_Entrega();
                
                $object_preferencia_entrega->set_id($this->preferencia_entrega);
                
                return $object_preferencia_entrega;
            } else {
                return null;
            }
        }
        
        public function get_object_status_peca() : ?Object_Status_Peca
        {
            if (!empty($this->status_peca)) {
                $object_status_peca = new Object_Status_Peca();
                
                $object_status_peca->set_id($this->status_peca);
                
                return $object_status_peca;
            } else {
                return null;
            }
        }
        
        public function get_form() : ?array
        {
            $form_filtro = array();
            
            $form_filtro['estado'] = $this->estado;
            $form_filtro['cidade'] = $this->cidade;
            $form_filtro['ordem_preco'] = $this->ordem_preco;
            $form_filtro['ordem_data'] = $this->ordem_data;
            $form_filtro['estado_uso'] = $this->estado_uso;
            $form_filtro['preferencia_entrega'] = $this->preferencia_entrega;
            $form_filtro['status_peca'] = $this->status_peca;
            
            return $form_filtro;
        }
        
        public function Retornar_Cidades_Por_Estado() : void
        {
            if (!empty($this->estado)) {
                View_Filtro::Mostrar_Cidades($this->estado);
            }
        }
        
        public static function Verificar_Login() : bool
        {
            return Login_Session::Verificar_Login();
        }
        
        public static function Buscar_Estados()
        {
            return DAO_Estado::BuscarTodos();
        }
        
        public static function Buscar_Cidade_Por_Estado(int $id_estado)
        {
            return DAO_Cidade::BuscarPorCOD($id_estado);
        }
        
        public static function Buscar_Estado_Uso_Pecas()
        {
            return DAO_Estado_Uso_Peca::BuscarTodos();
        }
        
        public static function Buscar_Preferencia_Entrega()
        {
            return DAO_Preferencia_Entrega::Buscar_Todos_Masivos();
        }
        
        public static function Buscar_Status_Peca()
        {
            return DAO_Status_Peca::Buscar_Todos();
        }
    }
