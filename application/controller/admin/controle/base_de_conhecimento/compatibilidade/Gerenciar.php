<?php
namespace application\controller\admin\controle\base_de_conhecimento\compatibilidade;
    
    use application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Cadastrar as Controller_Cadastrar;
    use application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Alterar as Controller_Alterar;
    use application\controller\admin\controle\base_de_conhecimento\compatibilidade\gerenciar\Deletar as Controller_Deletar;
    use application\controller\include_page\menu\Admin as Controller_Admin;
    use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\Gerenciar as View_Gerenciar;
    
    class Gerenciar {
        
        function __construct() {
            
        }
        
        public function Carregar_Pagina() {
            if (Controller_Admin::Verificar_Autenticacao()) {
                $view = new View_Gerenciar();
                
                $view->Executar();
            } else {
                return false;
            }
        }
        
        public static function Carregar_Pagina_Cadastrar() : void {
            $cadastrar = new Controller_Cadastrar();
            
            $cadastrar->Carregar_Pagina();
        }
        
        public static function Carregar_Pagina_Alterar() : void {
            $alterar = new Controller_Alterar();
            
            $alterar->Carregar_Pagina();
        }
        
        public static function Carregar_Pagina_Deletar() : void {
            $deletar = new Controller_Deletar();
            
            $deletar->Carregar_Pagina();
        }
    }
?>