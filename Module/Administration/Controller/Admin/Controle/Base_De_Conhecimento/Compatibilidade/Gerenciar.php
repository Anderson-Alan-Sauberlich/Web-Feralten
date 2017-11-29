<?php
namespace Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade;
    
    use Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Cadastrar as Controller_Cadastrar;
    use Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Alterar as Controller_Alterar;
    use Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Deletar as Controller_Deletar;
    use Module\Administration\Controller\Layout\Menu\Admin as Controller_Admin;
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar as View_Gerenciar;
    
    class Gerenciar
    {
        
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            if (Controller_Admin::Verificar_Autenticacao()) {
                $view = new View_Gerenciar();
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public static function Carregar_Pagina_Cadastrar() : void
        {
            $cadastrar = new Controller_Cadastrar();
            
            $cadastrar->Carregar_Pagina();
        }
        
        public static function Carregar_Pagina_Alterar() : void
        {
            $alterar = new Controller_Alterar();
            
            $alterar->Carregar_Pagina();
        }
        
        public static function Carregar_Pagina_Deletar() : void
        {
            $deletar = new Controller_Deletar();
            
            $deletar->Carregar_Pagina();
        }
    }
