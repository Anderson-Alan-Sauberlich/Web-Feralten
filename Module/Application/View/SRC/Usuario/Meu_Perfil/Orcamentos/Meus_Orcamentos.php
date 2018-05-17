<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento;
    use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Menu_Orcamento;
    use Module\Application\Model\OBJ\Orcamento as OBJ_Orcamento;
    
    class Meus_Orcamentos
    {
        /**
         * Cria uma nova instancia da classe com o parametro requirido status do usuario.
         * 
         * @param int $status
         */
        function __construct(int $status)
        {
            self::$status_usuario = $status;
        }
        
        /**
         * Armazena o codigo do status do usuario.
         * 
         * @var int $status_usuario
         */
        private static $status_usuario;
        
        /**
         * Lista de orçamentos.
         * 
         * @var array $orcamentos
         */
        private static $orcamentos;
        
        /**
         * Instancia da view menu lateral orçamento.
         * 
         * @var View_Menu_Orcamento $view_menu_orcamento
         */
        private static $view_menu_orcamento;
        
        /**
         * Seta a lista de orçamentos.
         * 
         * @param array $orcamentos
         */
        public function set_orcamentos(array $orcamentos) : void
        {
            self::$orcamentos = $orcamentos;
        }
        
        /**
         * Seta o objeto do menu lateral orçamento.
         * 
         * @param View_Menu_Orcamento $view_menu_orcamento
         */
        public function set_view_menu_orcamento(View_Menu_Orcamento $view_menu_orcamento) : void
        {
            self::$view_menu_orcamento = $view_menu_orcamento;
        }
        
        /**
         * Chama o arquivo html que por sua vez chama todas as functions staticas da classe.
         */
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Orcamentos/Meus_Orcamentos.php';
        }
        
        /**
         * Chama o codigo fonte do header usuario.
         */
        public static function Incluir_Header_Usuario() : void
        {
            new View_Header_Usuario(self::$status_usuario, ['orcamentos', 'meus-orcamentos']);
        }
        
        /**
         * Chama o codigo fonte do menu lateral orçamento.
         */
        public static function Incluir_Menu_Orcamento() : void
        {
            if (self::$view_menu_orcamento instanceof View_Menu_Orcamento) {
                self::$view_menu_orcamento->set_pagina(View_Menu_Orcamento::MEUS_ORCAMENTOS);
                self::$view_menu_orcamento->Executar();
            }
        }
        
        /**
         * Chama o codigo fonte dos elementos dos orçamentos.
         * 
         * @param array $orcamentos
         */
        public static function Incluir_Elemento_Orcamento(?array $orcamentos = null) : void
        {
            if (!empty($orcamentos)) {
                self::$orcamentos = $orcamentos;
            }
            
            if (!empty(self::$orcamentos)) {
                foreach (self::$orcamentos as $obj_orcamento) {
                    if ($obj_orcamento instanceof OBJ_Orcamento) {
                        $view_orcamento = new View_Orcamento();
                        
                        $view_orcamento->set_obj_orcamento($obj_orcamento);
                        $view_orcamento->set_pagina(View_Orcamento::MEUS_ORCAMENTOS);
                        
                        $view_orcamento->Executar();
                    }
                }
            } else {
                echo "<div class=\"ui container\"><h2><label class=\"lbPanel\">Nenhum orçamento foi encontrado.</label></h2></div>";
            }
        }
    }
