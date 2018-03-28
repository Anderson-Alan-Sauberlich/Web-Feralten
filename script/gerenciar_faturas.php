<?php
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    use Module\Application\Controller\Common\Util\GerenciarFaturas;
    
    GerenciarFaturas::Gerenciar_Todas_Faturas_Abertas();
    GerenciarFaturas::Gerenciar_Todas_Faturas_Fechadas();
    