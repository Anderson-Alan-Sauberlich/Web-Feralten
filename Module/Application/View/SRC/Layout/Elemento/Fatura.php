<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\OBJ\Fatura as OBJ_Fatura;
    use \DateTime;
        
    class Fatura
    {
        /** 
         * @const Parametro Funcionalidade
         */
        public const FECHADA = 2;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const ABERTA = 1;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const PAGA = 4;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const CANCELADA = 8;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const PARCIALMENTE_PAGA = 16;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const ATRASADA = 32;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const REEMBOLSADA = 64;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const AGUARDANDO_CNF_PGM = 128;
        
        /**
         * @const Parametro Funcionalidade
         */
        public const FATURAS = 'faturas';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const HISTORICO = 'historico';
        
        function __construct()
        {
            
        }
        
        /**
         * Armazena o objeto da fatura a ser mostrado na view html.
         * 
         * @var OBJ_Fatura $obj_fatura
         */
        private static $obj_fatura;
        
        /**
         * Armazena o nome da pagina aberta, onde será mostrado o elemento fatura.
         * 
         * @var string $pagina
         */
        private static $pagina;
        
        /**
         * Seta o objeto fatura.
         * 
         * @param OBJ_Fatura $obj_fatura
         */
        public function set_obj_fatura(OBJ_Fatura $obj_fatura) : void
        {
            self::$obj_fatura = $obj_fatura;
        }
        
        /**
         * Seta a variavel pagina.
         * 
         * @param string $pagina
         */
        public function set_pagina(string $pagina) : void
        {
            self::$pagina = $pagina;
        }
        
        /**
         * Chama a pagina html que por sua vez chama todas as function estaticas.
         */
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Fatura.php';
        }
        
        /**
         * Retorna o ID da fatura.
         * 
         * @return int|NULL
         */
        public static function MostrarID() : ?int
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                return self::$obj_fatura->get_id();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna a data da abertura da fatura.
         * 
         * @return string|NULL
         */
        public static function MostrarDataAbertura() : ?string
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                $data = new DateTime(self::$obj_fatura->get_data_emissao());
                return $data->format('d-m-Y');
            } else {
                return null;
            }
        }
        
        /**
         * Retorna a data da fechamento da fatura.
         *
         * @return string|NULL
         */
        public static function MostrarDataFechamento() : ?string
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                $data = new DateTime(self::$obj_fatura->get_data_fechamento());
                return $data->format('d-m-Y');
            } else {
                return null;
            }
        }
        
        /**
         * Retorna a data da vencimento da fatura.
         *
         * @return string|NULL
         */
        public static function MostrarDataVencimento() : ?string
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                $data = new DateTime(self::$obj_fatura->get_data_vencimento());
                return $data->format('d-m-Y');
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o status da fatura.
         * 
         * @return string|NULL
         */
        public static function MostrarStatus() : ?string
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                return self::$obj_fatura->get_obj_status()->get_descricao();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o valor total da fatura.
         * 
         * @return string|NULL
         */
        public static function MostrarValorTotal() : ?string
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                return number_format(self::$obj_fatura->get_valor_total(), 2, ',', '.');
            } else {
                return null;
            }
        }
        
        /**
         * Retorna lista com todos os serviços da fatura.
         * 
         * @return array
         */
        public static function RetornarListaFaturaServicos() : ?array
        {
            if (self::$obj_fatura instanceof OBJ_Fatura) {
                return self::$obj_fatura->get_servicos();
            } else {
                return null;
            }
        }
    }
