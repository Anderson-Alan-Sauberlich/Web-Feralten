<?php
namespace Module\Application\Model\Object;

    class Orcamento
    {
        
        private $id;
        private $usuario_id;
        private $categoria_id;
        private $marca_id;
        private $modelo_id;
        private $versao_id;
        private $ano_de;
        private $ano_ate;
        private $peca_nome;
        private $numero_serie;
        private $estado_uso_id;
        private $preferencia_entrega_id;
        private $descricao;
        private $datahora_solicitacao;
        private $datahora_validade;
                
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
        
        public function set_usuario_id(int $usuario_id) : void
        {
            $this->usuario_id = $usuario_id;
        }
        
        public function get_usuario_id() : ?int
        {
            return $this->usuario_id;
        }
        
        public function set_categoria_id(int $categoria_id) : void
        {
            $this->categoria_id = $categoria_id;
        }
        
        public function get_categoria_id() : ?int
        {
            return $this->categoria_id;
        }
        
        public function set_marca_id(int $marca_id) : void
        {
            $this->marca_id = $marca_id;
        }
        
        public function get_marca_id() : ?int
        {
            return $this->marca_id;
        }
        
        public function set_modelo_id(int $modelo_id) : void
        {
            $this->modelo_id = $modelo_id;
        }
        
        public function get_modelo_id() : ?int
        {
            return $this->modelo_id;
        }
        
        public function set_versao_id(int $versao_id) : void
        {
            $this->versao_id = $versao_id;
        }
        
        public function get_versao_id() : ?int
        {
            return $this->versao_id;
        }
        
        public function set_ano_de(int $ano_de) : void
        {
            $this->ano_de = $ano_de;
        }
        
        public function get_ano_de() : ?int
        {
            return $this->ano_de;
        }
        
        public function set_ano_ate(int $ano_ate) : void
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
        
        public function set_numero_serie(string $numero_serie) : void
        {
            $this->numero_serie = $numero_serie;
        }
        
        public function get_numero_serie() : ?string
        {
            return $this->numero_serie;
        }
        
        public function set_estado_uso_id(int $estado_uso_id) : void
        {
            $this->estado_uso_id = $estado_uso_id;
        }
        
        public function get_estado_uso_id() : ?int
        {
            return $this->estado_uso_id;
        }
        
        public function set_preferencia_entrega_id(int $preferencia_entrega_id) : void
        {
            $this->preferencia_entrega_id = $preferencia_entrega_id;
        }
        
        public function get_preferencia_entrega_id() : ?int
        {
            return $this->preferencia_entrega_id;
        }
        
        public function set_descricao(string $descricao) : void
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
    }
