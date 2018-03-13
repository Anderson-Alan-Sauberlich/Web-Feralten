<?php
namespace Module\Email\View\SRC;
    
    use Module\Application\Model\Object\Contato_Anunciante as Object_Contato_Anunciante;
    
    class Contato_Anunciante
    {
        function __construct()
        {
            
        }
        
        private static $obj_contato_anunciante;
        
        public function set_obj_contato_anunciante(Object_Contato_Anunciante $obj_contato_anunciante) : void
        {
            self::$obj_contato_anunciante = $obj_contato_anunciante;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Contato_Anunciante.php';
        }
        
        public static function RetornarNomeUsuario() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_object_peca()->get_responsavel()->get_nome();
            } else {
                return false;
            }
        }
        
        public static function RetornarPecaNome() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_object_peca()->get_nome();
            } else {
                return false;
            }
        }
        
        public static function RetornarPecaURL() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_object_peca()->get_url();
            } else {
                return false;
            }
        }
        
        public static function RetornarNome() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_nome();
            } else {
                return false;
            }
        }
        
        public static function RetornarEmail() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_email();
            } else {
                return false;
            }
        }
        
        public static function RetornarTelefone() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                $fone = self::$obj_contato_anunciante->get_telefone();
                
                if (strlen($fone) === 11) {
                    return preg_replace("/([0-9]{2})([0-9]{5})([0-9]{4})/", "($1) $2-$3", $fone);
                } else {
                    return preg_replace("/([0-9]{2})([0-9]{4})([0-9]{4})/", "($1) $2-$3", $fone);
                }
            } else {
                return false;
            }
        }
        
        public static function RetornarMensagem() : ?string
        {
            if (self::$obj_contato_anunciante instanceof Object_Contato_Anunciante) {
                return self::$obj_contato_anunciante->get_mensagem();
            } else {
                return false;
            }
        }
    }
