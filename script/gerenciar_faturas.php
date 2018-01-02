<?php
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas::Gerenciar_Todas_Faturas_Abertas();
    
    Module\Application\Controller\Usuario\Meu_Perfil\Financeiro\Faturas::Gerenciar_Todas_Faturas_Fechadas();
    
    //new Module\Common\Util\Pagamento(); //teste class Pagamento