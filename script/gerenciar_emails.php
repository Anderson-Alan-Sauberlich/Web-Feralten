<?php
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    use Module\Email\Controller\Common\Util\Email;
    
        
    if (Email::Enviar_Mensagem('')) {
        echo 'true';
    }
