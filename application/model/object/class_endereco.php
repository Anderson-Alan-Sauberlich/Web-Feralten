<?php
namespace application\model\object;

    class Endereco {
    	private $id;
		private $cidade_id;
        private $dados_usuario_id;
        private $estado_id;
		private $numero;
		private $cep;
		private $rua;
		private $complemento;
		private $bairro;
		
		function __constructor() {
			
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_id() {
			return $this->id;
		}
		
		public function set_cidade_id($cidade_id) {
			$this->cidade_id = $cidade_id;
		}
		
		public function get_cidade_id() {
			return $this->cidade_id;
		}
        
        public function set_estado_id($estado_id) {
            $this->estado_id = $estado_id;
        }
        
        public function get_estado_id() {
            return $this->estado_id;
        }
		
        public function set_dados_usuario_id($dados_usuario_id) {
            $this->dados_usuario_id = $dados_usuario_id;
        }
        
        public function get_dados_usuario_id() {
            return $this->dados_usuario_id;
        }
        
		public function set_numero($numero) {
			$this->numero = $numero;
		}
		
		public function get_numero() {
			return $this->numero;
		}
		
		public function set_cep($cep) {
			$this->cep = $cep;
		}
		
		public function get_cep() {
			return $this->cep;
		}
		
		public function set_rua($rua) {
			$this->rua = $rua;
		}
		
		public function get_rua() {
			return $this->rua;
		}
		
		public function set_complemento($complemento) {
			$this->complemento = $complemento;
		}
		
		public function get_complemento() {
			return $this->complemento;
		}
		
		public function set_bairro($bairro) {
			$this->bairro = $bairro;
		}
		
		public function get_bairro() {
			return $this->bairro;
		}
    }
?>