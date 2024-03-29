<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    use Module\Application\Model\OBJ\Fatura as OBJ_Fatura;
    use \DateTime;
    
    class Faturas
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
         * @var OBJ_Fatura
         */
        private static $fatura_aberta;
        
        /**
         * @var OBJ_Fatura
         */
        private static $fatura_fechada;
        
        /**
         * Id da sessão do PagSeguro
         * @var int
         */
        private static $pagseguro_sessao_id;
        
        /**
         * @param OBJ_Fatura $obj_fatura_aberta
         */
        public function set_fatura_aberta(?OBJ_Fatura $obj_fatura_aberta = null) : void
        {
            self::$fatura_aberta = $obj_fatura_aberta;
        }
        
        /**
         * @param OBJ_Fatura $obj_fatura_fechada
         */
        public function set_fatura_fechada(?OBJ_Fatura $obj_fatura_fechada = null) : void
        {
            self::$fatura_fechada = $obj_fatura_fechada;
        }
        
        /**
         * @param string id da sessão do pagseguro
         */
        public function set_pagseguro_sessao_id(string $pagseguro_sessao_id) : void
        {
            self::$pagseguro_sessao_id = $pagseguro_sessao_id;
        }
        
        /**
         * Abre a pagina html
         */
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Financeiro/Faturas.php';
        }
        
        /**
         * Inclui a view do Header Usuario na pagina
         */
        public static function Incluir_Header_Usuario() : void
        {
            new View_Header_Usuario(self::$status_usuario, ['financeiro', 'faturas']);
        }
        
        /**
         * Inclui a view do Menu Usuario na pagina
         */
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Menu_Usuario(self::$status_usuario, ['financeiro', 'faturas']);
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
                echo $data->format('d-m-Y');
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
                echo self::$fatura_fechada->get_obj_status()->get_descricao();
            } else if ($status === 'aberta') {
                echo self::$fatura_aberta->get_obj_status()->get_descricao();
            }
        }
        
        /**
         * @param string $status
         */
        public static function Mostrar_Total(string $status) : void
        {
            if ($status === 'fechada') {
                echo number_format(self::$fatura_fechada->get_valor_total(), 2, ',', '.');
            } else if ($status === 'aberta') {
                echo number_format(self::$fatura_aberta->get_valor_total(), 2, ',', '.');
            }
        }
        
        /**
         * @param string $status
         * @return array
         */
        public static function Retornar_Lista_Fatura_Servicos(string $status) : ?array
        {
            if ($status === 'fechada') {
                return self::$fatura_fechada->get_servicos();
            } else if ($status === 'aberta') {
                return self::$fatura_aberta->get_servicos();
            }
        }
        
        /**
         * @param string $status
         * @return bool
         */
        public static function Verificar_Valor_Fatura(string $status) : bool
        {
            if ($status === 'fechada') {
                if (self::$fatura_fechada->get_valor_total() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else if ($status === 'aberta') {
                if (self::$fatura_aberta->get_valor_total() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        
        /**
         * Deveria verificar qual o ano atual e apartir desde calcular + 10
         */
        public static function Carregar_Ano_Validade() : void
        {
            for ($i=2018; $i <= 2030; $i++) {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
        }
        
        /**
         * Deveria pegar o ano atual e apartir deste adicionar os anos até 1900
         */
        public static function Carregar_Anos() : void
        {
            for ($i=2018; $i >= 1900; $i--) {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
        }
        
        /**
         * Retorna o id do pagseguro para ser setado na inicialização da pagina.
         * 
         * @return string
         */
        public static function RetornarPagSeguroSessaoId() : ?string
        {
            return self::$pagseguro_sessao_id;
        }
        
        /**
         * Retorna um array list adicionando em cada item os elementos html para tornalos listas.
         * 
         * @param array $itens
         * @return array
         */
        public static function CriarListagem(array $itens) : array
        {
            $lista = [];
            
            foreach ($itens as $item) {
                $lista[] = "<li>$item</li>";
            }
            
            return $lista;
        }
        
        /**
         * Verifica se os formularios de cobrança devem ser mostrados.
         * Caso o status seja de 128 "Aguardando Confirmação de Pagamento", e o pagamento foi Credito:
         * Então os formularios não serão mostrados.
         * 
         * @return bool
         */
        public static function VerificaMostrarCobranca() : bool
        {
            if (self::$fatura_fechada->get_obj_status()->get_id() === 128) {
                return false;
            } else {
                return true;
            }
        }
    }
