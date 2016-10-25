<?php
namespace application\model\object;
	
	require_once RAIZ.'/application/model/object/cidade.php';
	require_once RAIZ.'/application/model/object/estado.php';
	
	use application\model\object\Cidade as Object_Cidade;
	use application\model\object\Estado as Object_Estado;
	
    class Endereco {
    	private $id;
        private $dados_usuario_id;
        private $cidade;
        private $estado;
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
		
		public function set_cidade(Object_Cidade $cidade) {
			$this->cidade = $cidade;
		}
		
		public function get_cidade() {
			return $this->cidade;
		}
        
        public function set_estado(Object_Estado $estado) {
            $this->estado = $estado;
        }
        
        public function get_estado() {
            return $this->estado;
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