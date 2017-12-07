<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    use Module\Application\Model\Object\Fatura as Object_Fatura;
    use Module\Application\Model\Object\Fatura_Servico as Object_Fatura_Servico;
    use \DateTime;
    
    class Fatura
    {
        
        /**
         * @param number|NULL $status
         */
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        /**
         * @var number|NULL
         */
        private static $status_usuario;
        
        /**
         * @var Object_Fatura
         */
        private static $fatura_aberta;
        
        /**
         * @var Object_Fatura
         */
        private static $fatura_fechada;
        
        /**
         * @var Object_Fatura_Servico
         */
        private static $fatura_servicos_aberta;
        
        /**
         * @var Object_Fatura_Servico
         */
        private static $fatura_servicos_fechada;
        
        /**
         * @param Object_Fatura $object_fatura_aberta
         */
        public function set_fatura_aberta(?Object_Fatura $object_fatura_aberta = null) : void
        {
            self::$fatura_aberta = $object_fatura_aberta;
        }
        
        /**
         * @param array $fatura_servicos_aberta
         */
        public function set_fatura_servicos_aberta(?array $fatura_servicos_aberta = null) : void
        {
            self::$fatura_servicos_aberta = $fatura_servicos_aberta;
        }
        
        /**
         * @param Object_Fatura $object_fatura_fechada
         */
        public function set_fatura_fechada(?Object_Fatura $object_fatura_fechada = null) : void
        {
            self::$fatura_fechada = $object_fatura_fechada;
        }
        
        /**
         * @param array $fatura_servicos_fechada
         */
        public function set_fatura_servicos_fechada(?array $fatura_servicos_fechada = null) : void
        {
            self::$fatura_servicos_fechada = $fatura_servicos_fechada;
        }
        
        /**
         * Abre a pagina html
         */
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Fatura.php';
        }
        
        /**
         * Inclui a view do Menu Usuario na pagina
         */
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Usuario(self::$status_usuario, array('financeiro', 'fatura'));
        }
        
        /**
         * @param string $status
         * @return bool
         */
        public static function Verificar_Fatura(string $status) : bool
        {
            if ($status === 'fechada') {
                if (empty(self::$fatura_fechada)) {
                    return false;
                } else {
                    return true;
                }
            } else if ($status === 'aberta') {
                if (empty(self::$fatura_aberta)) {
                    return false;
                } else {
                    return true;
                }
            } else {
                false;
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_ID(string $status) : void
        {
            if ($status === 'fechada') {
                echo self::$fatura_fechada->get_id();
            } else if ($status === 'aberta') {
                echo self::$fatura_aberta->get_id();
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Abertura(string $status) : void
        {
            if ($status === 'fechada') {
                $data = new DateTime(self::$fatura_fechada->get_data_emissao());
                echo $data->format('d/m/Y');
            } else if ($status === 'aberta') {
                $data = new DateTime(self::$fatura_aberta->get_data_emissao());
                echo $data->format('d-m-Y');
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Vencimento(string $status) : void
        {
            if ($status === 'fechada') {
                $data = new DateTime(self::$fatura_fechada->get_data_vencimento());
                echo $data->format('d-m-Y');
            } else if ($status === 'aberta') {
                $data = new DateTime(self::$fatura_aberta->get_data_vencimento());
                echo $data->format('d-m-Y');
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Fechamento(string $status) : void
        {
            if ($status === 'fechada') {
                $data = new DateTime(self::$fatura_fechada->get_data_fechamento());
                echo $data->format('d-m-Y');
            } else if ($status === 'aberta') {
                $data = new DateTime(self::$fatura_aberta->get_data_fechamento());
                echo $data->format('d-m-Y');
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Status(string $status) : void
        {
            if ($status === 'fechada') {
                echo self::$fatura_fechada->get_object_status()->get_descricao();
            } else if ($status === 'aberta') {
                echo self::$fatura_aberta->get_object_status()->get_descricao();
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Total(string $status) : void
        {
            if ($status === 'fechada') {
                echo self::$fatura_fechada->get_valor_total();
            } else if ($status === 'aberta') {
                echo self::$fatura_aberta->get_valor_total();
            }
        }
    }
