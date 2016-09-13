<?php
namespace application\model\object;

    class Contato {
        private $id;
        private $dados_usuario_id;
        private $telefone1;
        private $telefone2;
        private $email;
        
        function __constructor() {
            
        }

        public function set_id($id) {
            $this->id = $id;
        }
        
        public function get_id() {
            return $this->id;
        }

        public function set_dados_usuario_id($dados_usuario_id) {
            $this->dados_usuario_id = $dados_usuario_id;
        }
        
        public function get_dados_usuario_id() {
            return $this->dados_usuario_id;
        }

        public function set_telefone1($telefone1) {
            $this->telefone1 = $telefone1;
        }
        
        public function get_telefone1() {
            return $this->telefone1;
        }
        
        public function set_telefone2($telefone2) {
            $this->telefone2 = $telefone2;
        }
        
        public function get_telefone2() {
            return $this->telefone2;
        }
        
        public function set_email($email) {
            $this->email = $email;
        }
        
        public function get_email() {
            return $this->email;
        }
    }
?>