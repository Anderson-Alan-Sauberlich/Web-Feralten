<?php
namespace Module\Administration\Controller\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar;
	
    use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\Compatibilidade\Gerenciar\Cadastrar as View_Cadastrar;
	
    class Cadastrar
    {

        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
        	$view = new View_Cadastrar();
        	
        	$view->Executar();
        }
    }
