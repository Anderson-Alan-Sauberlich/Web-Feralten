<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Menu_Orcamento;
    
    class Respondidos
    {
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $orcamentos;
        private static $view_menu_orcamento;
        
        public function set_orcamentos(array $orcamentos) : void
        {
            self::$orcamentos = $orcamentos;
        }
        
        public function set_view_menu_orcamento(View_Menu_Orcamento $view_menu_orcamento) : void
        {
            self::$view_menu_orcamento = $view_menu_orcamento;
        }
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Orcamentos/Respondidos.php';
        }
        
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Usuario(self::$status_usuario, ['meu-perfil', 'orcamentos-recebidos']);
        }
        
        public static function Incluir_Menu_Orcamento() : void
        {
            if (self::$view_menu_orcamento instanceof View_Menu_Orcamento) {
                self::$view_menu_orcamento->set_pagina(View_Menu_Orcamento::RESPONDIDOS);
                self::$view_menu_orcamento->Executar();
            }
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
                    $view_orcamento->set_pagina(View_Orcamento::RESPONDIDOS);
                    
                    $view_orcamento->Executar();
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum orçamento foi encontrado.</label></h2></div>";
            }
        }
    }
