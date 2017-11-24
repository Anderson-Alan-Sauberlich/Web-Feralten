<?php
namespace module\administration\controller\admin\controle\base_de_conhecimento\cmmv;
       
    use module\administration\controller\admin\controle\base_de_conhecimento\cmmv\gerenciar\Cadastrar as Controller_Cadastrar;
    use module\administration\controller\admin\controle\base_de_conhecimento\cmmv\gerenciar\Alterar as Controller_Alterar;
    use module\administration\controller\admin\controle\base_de_conhecimento\cmmv\gerenciar\Deletar as Controller_Deletar;
    use module\administration\controller\layout\menu\Admin as Controller_Admin;
    use module\administration\view\src\admin\controle\base_de_conhecimento\cmmv\Gerenciar as View_Gerenciar;
    
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
