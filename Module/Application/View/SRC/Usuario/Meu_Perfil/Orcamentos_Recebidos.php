<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    
    class Orcamentos_Recebidos
    {
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $numero_recebido;
        private static $numero_nao_tenho;
        private static $numero_respondido;
        private static $orcamentos;
        
        public function set_numero_recebidos(int $numero_recebidos) : void
        {
            self::$numero_recebido = $numero_recebidos;
        }
        
        public function set_numero_nao_tenho(int $numero_nao_tenho) : void
        {
            self::$numero_nao_tenho = $numero_nao_tenho;
        }
        
        public function set_numero_respondido(int $numero_respondido) : void
        {
            self::$numero_respondido = $numero_respondido;
        }
        
        public function set_orcamentos(array $orcamentos) : void
        {
            self::$orcamentos = $orcamentos;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Orcamentos_Recebidos.php';
        }
        
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Usuario(self::$status_usuario, ['meu-perfil', 'orcamentos-recebidos']);
        }
        
        public static function MostrarNumeroRecebido() : void
        {
            echo self::$numero_recebido;
        }
        
        public static function MostrarNumeroNaoTenho() : void
        {
            echo self::$numero_nao_tenho;
        }
        
        public static function MostrarNumeroRespondido() : void
        {
            echo self::$numero_respondido;
        }
        
        public static function Incluir_Elemento_Orcamento(?array $orcamentos = null) : void
        {
            if (!empty($orcamentos)) {
                self::$orcamentos = $orcamentos;
            }
            
            if (!empty(self::$orcamentos)) {
                foreach (self::$orcamentos as $obj_orcamento) {
                    $view_orcamento = new View_Orcamento();
                    
                    $view_orcamento->set_obj_orcamento($obj_orcamento);
                    
                    $view_orcamento->Executar();
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum orçamento foi encontrado.</label></h2></div>";
            }
        }
    }
