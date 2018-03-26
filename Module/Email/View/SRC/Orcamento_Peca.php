<?php
namespace Module\Email\View\SRC;
    
    use Module\Application\Model\OBJ\Orcamento_Peca as OBJ_Orcamento_Peca;
    
    class Orcamento_Peca
    {
        function __construct()
        {
            
        }
        
        private static $obj_orcamento_peca;
        
        public function set_obj_orcamento_peca(OBJ_Orcamento_Peca $obj_orcamento_peca) : void
        {
            self::$obj_orcamento_peca = $obj_orcamento_peca;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Email/View/HTML/Orcamento_Peca.php';
        }
        
        public static function RetornarNomeUsuario() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_orcamento()->get_usuario()->get_nome();
            } else {
                return null;
            }
        }
        
        public static function RetornarOrcamentoNome() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_orcamento()->get_peca_nome();
            } else {
                return null;
            }
        }
        
        public static function RetornarOrcamentoCMMV() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_orcamento()->get_categoria()->get_nome().', '.
                       self::$obj_orcamento_peca->get_orcamento()->get_marca()->get_nome().', '.
                       self::$obj_orcamento_peca->get_orcamento()->get_modelo()->get_nome().', '.
                       self::$obj_orcamento_peca->get_orcamento()->get_versao()->get_nome();
            } else {
                return null;
            }
        }
        
        public static function RetornarOrcamentoAnos() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return 'Ano: de '.self::$obj_orcamento_peca->get_orcamento()->get_ano_de().' até '.self::$obj_orcamento_peca->get_orcamento()->get_ano_ate();
            } else {
                return null;
            }
        }
        
        public static function RetornarOrcamentoDescricao() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_orcamento()->get_descricao();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaURL() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_peca()->get_url();
            } else {
                return null;
            }
        }
        
        public static function RetornarPecaNome() : ?string
        {
            if (self::$obj_orcamento_peca instanceof OBJ_Orcamento_Peca) {
                return self::$obj_orcamento_peca->get_peca()->get_nome();
            } else {
                return null;
            }
        }
    }
