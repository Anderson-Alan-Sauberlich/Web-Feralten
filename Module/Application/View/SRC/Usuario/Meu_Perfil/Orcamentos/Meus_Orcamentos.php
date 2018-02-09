<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Menu_Orcamento;
    
    class Meus_Orcamentos
    {
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
        private static $view_menu_orcamento;
        
        public function set_view_menu_orcamento(View_Menu_Orcamento $view_menu_orcamento) : void
        {
            self::$view_menu_orcamento = $view_menu_orcamento;
        }
        
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Orcamentos/Meus_Orcamentos.php';
        }
        
        public static function Incluir_Menu_Usuario()
        {
            new View_Usuario(self::$status_usuario, array('meu-perfil', 'meus-orcamentos'));
        }
        
        public static function Incluir_Menu_Orcamento() : void
        {
            if (self::$view_menu_orcamento instanceof View_Menu_Orcamento) {
                self::$view_menu_orcamento->set_pagina(View_Menu_Orcamento::MEUS_ORCAMENTOS);
                self::$view_menu_orcamento->Executar();
            }
        }
    }
