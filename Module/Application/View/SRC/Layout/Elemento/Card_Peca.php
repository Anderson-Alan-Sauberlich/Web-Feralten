<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    use Module\Application\Model\Common\Util\Login_Session;
        
    class Card_Peca
    {
        function __construct()
        {
            
        }
        
        private static $obj_peca;
        
        public function set_obj_peca(OBJ_Peca $obj_peca) : void
        {
            self::$obj_peca = $obj_peca;
        }
        
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Card_Peca.php';
        }
        
        public static function RetornarPecaID() : ?int
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_id();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaNome() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_nome();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaURL() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_url();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaFabricante() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_fabricante();
            } else {
                return null;
            }
        }
        
        public static function VerificaPecaFabricante() : bool
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                if (empty(self::$obj_peca->get_fabricante())) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        
        public static function RetornarPecaEstadoUso() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_estado_uso()->get_nome();
            } else {
                return null;
            }
        }
        
        public static function VerificaPecaEstadoUso() : bool
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                if (empty(self::$obj_peca->get_estado_uso())) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        
        public static function RetornarPecaPreco() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return number_format(self::$obj_peca->get_preco(), 2, ',', '.');
            } else {
                return null;
            }
        }
        
        public static function VerificarPecaPreco() : bool
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                if (empty(self::$obj_peca->get_preco())) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        
        public static function RetornarPecaStatus() : ?int
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return self::$obj_peca->get_status()->get_id();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaData() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return date('d/m/Y', strtotime(self::$obj_peca->get_data_anuncio()));
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaImagem() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                if (!empty(self::$obj_peca->get_foto(1))) {
                    return str_replace("@", "400x300", self::$obj_peca->get_foto(1)->get_endereco());
                } else if (!empty(self::$obj_peca->get_foto(2))) {
                    return str_replace("@", "400x300", self::$obj_peca->get_foto(2)->get_endereco());
                } else if (!empty(self::$obj_peca->get_foto(3))) {
                    return str_replace("@", "400x300", self::$obj_peca->get_foto(3)->get_endereco());
                } else {
                    return '/resources/img/imagem_indisponivel.png';
                }
            } else {
                return null;
            }
        }
        
        public static function RetonrarStatusPecaImagem() : ?string
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                if (self::$obj_peca->get_status()->get_id() !== 1) {
                    return 'disabled';
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        public static function VerificarUsuarioAutenticado() : bool
        {
            if (self::$obj_peca instanceof OBJ_Peca) {
                return Login_Session::Verificar_Login() AND self::$obj_peca->get_entidade()->get_usuario_id() === Login_Session::get_usuario_id();
            } else {
                return false;
            }
        }
    }
