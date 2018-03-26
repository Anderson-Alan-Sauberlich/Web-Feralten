<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\OBJ\Entidade as OBJ_Entidade;
    
    class Vendedor
    {
        function __construct()
        {
            
        }
        
        /**
         * Armazena o objeto da entidade a sermostrado na view html.
         *
         * @var OBJ_Entidade $obj_entidade
         */
        private static $obj_entidade;
        
        /**
         * Seta o objeto entidade.
         *
         * @param OBJ_Entidade $obj_orcamento
         */
        public function set_obj_entidade(OBJ_Entidade $obj_entidade) : void
        {
            self::$obj_entidade = $obj_entidade;
        }
        
        /**
         * Chama a pagina html que por sua vez chama todas as function estaticas.
         */
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Vendedor.php';
        }
        
        /**
         * Retorna a imagem/logo da entidade.
         * 
         * @return string|NULL
         */
        public static function RetornarImagem() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                if (!empty(self::$obj_entidade->get_imagem())) {
                    return str_replace("@", "200x150", self::$obj_entidade->get_imagem());
                } else {
                    return '/resources/img/imagem_indisponivel.png';
                }
            }
        }
        
        /**
         * Retorna o nome da entidade|nome comercial se estiver setado, senão retorna nome do usuario.
         * 
         * @return string|NULL
         */
        public static function RetornaNome() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                if (!empty(self::$obj_entidade->get_nome_comercial())) {
                    return self::$obj_entidade->get_nome_comercial();
                } else {
                    return self::$obj_entidade->get_usuario()->get_nome();
                }
            } else {
                return null;
            }
        }
        
        /**
         * Retorna string com a junção de cidade e estado.
         * 
         * @return string|NULL
         */
        public static function RetornaCidadeEstado() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                $retorno = '';
                
                foreach (self::$obj_entidade->get_enderecos() as $obj_endereco) {
                    $retorno = $obj_endereco->get_estado()->get_uf().' - '.$obj_endereco->get_cidade()->get_nome();
                }
                
                return $retorno;
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o Site da Entidade se estiver informado.
         * 
         * @return string|NULL
         */
        public static function RetornaSite() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                return '<a href="'.self::$obj_entidade->get_site().'">'.self::$obj_entidade->get_site().'</a>';
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o e-mail do usuario.
         * 
         * @return string
         */
        public static function RetornarEmail() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                return self::$obj_entidade->get_usuario()->get_email();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o telefone do usuario.
         * 
         * @return string
         */
        public static function RetornaTelefone() : ?string
        {
            if (self::$obj_entidade instanceof OBJ_Entidade) {
                $fone = self::$obj_entidade->get_usuario()->get_fone();
                
                if (strlen($fone) === 11) {
                    return preg_replace("/([0-9]{2})([0-9]{5})([0-9]{4})/", "($1) $2-$3", $fone);
                } else {
                    return preg_replace("/([0-9]{2})([0-9]{4})([0-9]{4})/", "($1) $2-$3", $fone);
                }
            } else {
                return null;
            }
        }
    }
