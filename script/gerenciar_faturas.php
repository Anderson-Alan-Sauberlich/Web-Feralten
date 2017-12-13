<?php
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Fatura::Gerenciar_Todas_Faturas_Abertas();
    
    Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Fatura::Gerenciar_Todas_Faturas_Fechadas();