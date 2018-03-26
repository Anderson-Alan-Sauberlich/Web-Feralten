<?php
namespace Module\Application\Model\OBJ;
    
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    
    class Contato_Anunciante
    {
        private $id;
        private $obj_peca;
        private $nome;
        private $email;
        private $aprovacao;
        private $lido;
        private $telefone;
        private $whatsapp;
        private $mensagem;
        private $datahora_envio;
        
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
        
        public function set_obj_peca(OBJ_Peca $obj_peca) : void
        {
            $this->obj_peca = $obj_peca;
        }
        
        public function get_obj_peca() : ?OBJ_Peca
        {
            return $this->obj_peca;
        }
        
        public function set_nome(string $nome) : void
        {
            $this->nome = $nome;
        }
        
        public function get_nome() : ?string
        {
            return $this->nome;
        }
        
        public function set_email(string $email) : void
        {
            $this->email = $email;
        }
        
        public function get_email() : ?string
        {
            return $this->email;
        }
        
        public function set_aprovacao(?bool $aprovacao) : void
        {
            $this->aprovacao = $aprovacao;
        }
        
        public function get_aprovacao() : ?bool
        {
            return $this->aprovacao;
        }
        
        public function set_lido(bool $lido) : void
        {
            $this->lido = $lido;
        }
        
        public function get_lido() : ?bool
        {
            return $this->lido;
        }
        
        public function set_telefone(string $telefone) : void
        {
            $this->telefone = $telefone;
        }
        
        public function get_telefone() : ?string
        {
            return $this->telefone;
        }
        
        public function set_whatsapp(?bool $whatsapp) : void
        {
            $this->whatsapp = $whatsapp;
        }
        
        public function get_whatsapp() : ?bool
        {
            return $this->whatsapp;
        }
        
        public function set_mensagem(string $mensagem) : void
        {
            $this->mensagem = $mensagem;
        }
        
        public function get_mensagem() : ?string
        {
            return $this->mensagem;
        }
        
        public function set_datahora_envio(string $datahora_envio) : void
        {
            $this->datahora_envio = $datahora_envio;
        }
        
        public function get_datahora_envio() : ?string
        {
            return $this->datahora_envio;
        }
    }
