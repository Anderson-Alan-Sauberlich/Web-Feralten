<?php
namespace Module\Application\Controller;
    
    use Module\Application\View\SRC\Inicio as View_Inicio;
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use Module\Application\Controller\Layout\Elemento\Orcamento as Controller_Orcamento;
    
    class Inicio
    {
        function __construct()
        {
            
        }
        
        public function Carregar_Pagina()
        {
            $view = new View_Inicio();
            
            $pecas_vip = DAO_Peca::BuscarVips();
            if (!empty($pecas_vip) && $pecas_vip != false) {
                $view->set_pecas_vip($pecas_vip);
            }
            
            $ultimos_orcamentos = DAO_Orcamento::BuscarUltimos();
            if (!empty($ultimos_orcamentos) && $ultimos_orcamentos != false) {
                $controller_orcamento = new Controller_Orcamento();
                $view_orcamento = $controller_orcamento->Retornar_Pagina();
                $view_orcamento->set_pagina(Controller_Orcamento::ORCAMENTOS);
                $view->set_view_orcamento($view_orcamento);
                $view->set_ultimos_orcamentos($ultimos_orcamentos);
            }
            
            $view->Executar();
        }
    }
