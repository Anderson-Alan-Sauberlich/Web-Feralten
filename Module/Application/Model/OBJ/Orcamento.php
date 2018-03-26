<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Usuario as OBJ_Usuario;
    use Module\Application\Model\OBJ\Categoria as OBJ_Categoria;
    use Module\Application\Model\OBJ\Marca as OBJ_Marca;
    use Module\Application\Model\OBJ\Modelo as OBJ_Modelo;
    use Module\Application\Model\OBJ\Versao as OBJ_Versao;
    
    class Orcamento
    {
        private $id;
        private $usuario;
        private $categoria;
        private $marca;
        private $modelo;
        private $versao;
        private $ano_de;
        private $ano_ate;
        private $peca_nome;
        private $numero_serie;
        private $estado_uso_id;
        private $preferencia_entrega_id;
        private $descricao;
        private $datahora_solicitacao;
        private $datahora_validade;
        private $pecas = [];
        
        function __constructor()
        {
            
        }
        
        public function set_id(int $id) : void
        {
            $this->id = $id;
        }
        
        public function get_id() : ?int
        {
            return $this->id;
        }
        
        public function set_usuario(OBJ_Usuario $usuario) : void
        {
            $this->usuario = $usuario;
        }
        
        public function get_usuario() : ?OBJ_Usuario
        {
            return $this->usuario;
        }
        
        public function set_usuario_id(int $usuario_id) : void
        {
            if (!$this->usuario instanceof OBJ_Usuario) {
                $this->usuario = new OBJ_Usuario();
            }
            
            $this->usuario->set_id($usuario_id);
        }
        
        public function get_usuario_id() : ?int
        {
            if ($this->usuario instanceof OBJ_Usuario) {
                return $this->usuario->get_id();
            } else {
                return null;
            }
        }
        
        public function set_categoria(OBJ_Categoria $categoria) : void
        {
            $this->categoria = $categoria;
        }
        
        public function get_categoria() : ?OBJ_Categoria
        {
            return $this->categoria;
        }
        
        public function set_categoria_id(int $categoria_id) : void
        {
            if (!$this->categoria instanceof OBJ_Categoria) {
                $this->categoria = new OBJ_Categoria();
            }
            
            $this->categoria->set_id($categoria_id);
        }
        
        public function get_categoria_id() : ?int
        {
            if ($this->categoria instanceof OBJ_Categoria) {
                return $this->categoria->get_id();
            } else {
                return null;
            }
        }
        
        public function set_marca(OBJ_Marca $marca) : void
        {
            $this->marca = $marca;
        }
        
        public function get_marca() : ?OBJ_Marca
        {
            return $this->marca;
        }
        
        public function set_marca_id(int $marca_id) : void
        {
            if (!$this->marca instanceof OBJ_Marca) {
                $this->marca = new OBJ_Marca();
            }
            
            $this->marca->set_id($marca_id);
        }
        
        public function get_marca_id() : ?int
        {
            if ($this->marca instanceof OBJ_Marca) {
                return $this->marca->get_id();
            } else {
                return null;
            }
        }
        
        public function set_modelo(OBJ_Modelo $modelo) : void
        {
            $this->modelo = $modelo;
        }
        
        public function get_modelo() : ?OBJ_Modelo
        {
            return $this->modelo;
        }
        
        public function set_modelo_id(int $modelo_id) : void
        {
            if (!$this->modelo instanceof OBJ_Modelo) {
                $this->modelo = new OBJ_Modelo();
            }
            
            $this->modelo->set_id($modelo_id);
        }
        
        public function get_modelo_id() : ?int
        {
            if ($this->modelo instanceof OBJ_Modelo) {
                return $this->modelo->get_id();
            } else {
                return null;
            }
        }
        
        public function set_versao(?OBJ_Versao $versao) : void
        {
            $this->versao = $versao;
        }
        
        public function get_versao() : ?OBJ_Versao
        {
            return $this->versao;
        }
        
        public function set_versao_id(?int $versao_id) : void
        {
            if (!$this->versao instanceof OBJ_Versao) {
                $this->versao = new OBJ_Versao();
            }
            
            $this->versao->set_id($versao_id);
        }
        
        public function get_versao_id() : ?int
        {
            if ($this->versao instanceof OBJ_Versao) {
                return $this->versao->get_id();
            } else {
                return null;
            }
        }
        
        public function set_ano_de(?int $ano_de) : void
        {
            $this->ano_de = $ano_de;
        }
        
        public function get_ano_de() : ?int
        {
            return $this->ano_de;
        }
        
        public function set_ano_ate(?int $ano_ate) : void
        {
            $this->ano_ate = $ano_ate;
        }
        
        public function get_ano_ate() : ?int
        {
            return $this->ano_ate;
        }
        
        public function set_peca_nome(string $peca_nome) : void
        {
            $this->peca_nome = $peca_nome;
        }
        
        public function get_peca_nome() : ?string
        {
            return $this->peca_nome;
        }
        
        public function set_numero_serie(?string $numero_serie) : void
        {
            $this->numero_serie = $numero_serie;
        }
        
        public function get_numero_serie() : ?string
        {
            return $this->numero_serie;
        }
        
        public function set_estado_uso_id(?int $estado_uso_id) : void
        {
            $this->estado_uso_id = $estado_uso_id;
        }
        
        public function get_estado_uso_id() : ?int
        {
            return $this->estado_uso_id;
        }
        
        public function set_preferencia_entrega_id(?int $preferencia_entrega_id) : void
        {
            $this->preferencia_entrega_id = $preferencia_entrega_id;
        }
        
        public function get_preferencia_entrega_id() : ?int
        {
            return $this->preferencia_entrega_id;
        }
        
        public function set_descricao(?string $descricao) : void
        {
            $this->descricao = $descricao;
        }
        
        public function get_descricao() : ?string
        {
            return $this->descricao;
        }
        
        public function set_datahora_solicitacao(string $datahora_solicitacao) : void
        {
            $this->datahora_solicitacao = $datahora_solicitacao;
        }
        
        public function get_datahora_solicitacao() : ?string
        {
            return $this->datahora_solicitacao;
        }
        
        public function set_datahora_validade(string $datahora_validade) : void
        {
            $this->datahora_validade = $datahora_validade;
        }
        
        public function get_datahora_validade() : ?string
        {
            return $this->datahora_validade;
        }
        
        public function set_pecas(?array $pecas) : void
        {
            $this->pecas = $pecas;
        }
        
        public function get_pecas() : ?array
        {
            return $this->pecas;
        }
    }
