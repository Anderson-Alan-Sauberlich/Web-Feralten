<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados;
    
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Object\Endereco as OBJ_Endereco;
    
    class Endereco
    {
        function __construct()
        {
            
        }
        
        private static $obj_endereco;
        private static $estados = [];
        private static $cidades = [];
        
        public function set_obj_endereco(OBJ_Endereco $obj_endereco) : void
        {
            self::$obj_endereco = $obj_endereco;
        }
        
        public function set_estados(array $estados) : void
        {
            self::$estados = $estados;
        }
        
        public function set_cidades(array $cidades) : void
        {
            self::$cidades = $cidades;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Dados/Editar_Dados/Endereco.php';
        }
        
        public static function VerificaLoginEntidade() : bool
        {
            return Login_Session::Verificar_Entidade();
        }
        
        public static function MostrarCEP() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_cep();
            }
            
            return null;
        }
        
        public static function MostrarBairro() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_bairro();
            }
            
            return null;
        }
        
        public static function MostrarRua() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_rua();
            }
            
            return null;
        }
        
        public static function MostrarNumero() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_numero();
            }
            
            return null;
        }
        
        public static function MostrarComplemento() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_complemento();
            }
            
            return null;
        }
        
        public static function MostrarNomeEstado() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_estado()->get_uf().' - '.
                       self::$obj_endereco->get_estado()->get_nome();
            }
            
            return null;
        }
        
        public static function MostrarIDEstado() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_estado()->get_id();
            }
            
            return null;
        }
        
        public static function MostrarNomeCidade() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_cidade()->get_nome();
            }
            
            return null;
        }
        
        public static function MostrarIDCidade() : ?string
        {
            if (self::$obj_endereco instanceof OBJ_Endereco) {
                return self::$obj_endereco->get_cidade()->get_id();
            }
            
            return null;
        }
        
        public static function MostrarEstados() : void
        {
            foreach (self::$estados as $estado) {
                echo "<div class=\"item\" id=\"".$estado->get_uf()."\" data-text=\"".$estado->get_uf()." - ".$estado->get_nome()."\" data-value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</div>";
            }
        }
        
        public static function MostrarCidades(?array $cidades = null) : void
        {
            if (!empty($cidades)) {
                self::set_cidades($cidades);
            }
            
            foreach (self::$cidades as $cidade) {
                echo "<div class=\"item\" id=\"item_".$cidade->get_id()."\" data-text=\"".$cidade->get_nome()."\" data-value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</div>";
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
