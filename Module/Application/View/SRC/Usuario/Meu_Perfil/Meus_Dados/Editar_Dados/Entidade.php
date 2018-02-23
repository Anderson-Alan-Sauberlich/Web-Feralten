<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Object\Entidade as OBJ_Entidade;
    
    class Entidade
    {
        function __construct()
        {
            
        }
        
        private static $obj_entidade;
        
        public function set_obj_entidade(OBJ_Entidade $obj_entidade) : void
        {
            self::$obj_entidade = $obj_entidade;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Dados/Editar_Dados/Entidade.php';
        }
        
        public static function VerificaLoginEntidade() : bool
        {
            return Login_Session::Verificar_Entidade();
        }
        
        public static function BloquearCPF_CNPJ() : ?string
        {
            if (Login_Session::Verificar_Entidade()) {
                return 'disabled="disabled"';
            }
            
            return null;
        }
        
        public static function MostrarCPF_CNPJ() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                return self::$obj_entidade->get_cpf_cnpj();
            }
            
            return null;
        }
        
        public static function MostrarNomeComercial() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                return self::$obj_entidade->get_nome_comercial();
            }
            
            return null;
        }
        
        public static function MostrarSite() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                return self::$obj_entidade->get_site();
            }
            
            return null;
        }
        
        public static function Manter_Imagem() : void
        {
            if (isset($_SESSION['imagem_tmp'])) {
                if ($_SESSION['imagem_tmp'] == "del") {
                    echo "/resources/img/imagem_indisponivel.png";
                } else {
                    echo self::$obj_entidade->get_imagem();
                }
            } else {
                //if (!empty(self::$obj_entidade->get_imagem())) {
                //    echo str_replace("@", "200x150", self::$obj_entidade->get_imagem());
                //} else {
                //    echo "/resources/img/imagem_indisponivel.png";
                //}
            }
        }
        
        public static function CriarListagem(array $itens) : array
        {
            $lista = [];
            
            foreach ($itens as $item) {
                $lista[] = "<li>$item</li>";
            }
            
            return $lista;
        }
    }
