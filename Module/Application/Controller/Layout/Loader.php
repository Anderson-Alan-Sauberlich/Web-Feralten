<?php
namespace Module\Application\Controller\Layout;
    
    class Loader
    {
        function __construct()
        {
            
        }
        
        public static function Validar_IP() : bool
        {
            if (isset($_SESSION['usr_ip'])) {
                if ($_SESSION['usr_ip'] != $_SERVER['REMOTE_ADDR']) {
                    $_SESSION['usr_ip'] = $_SERVER['REMOTE_ADDR'];
                    
                    return false;
                } else {
                    return true;
                }
            } else {
                $_SESSION['usr_ip'] = $_SERVER['REMOTE_ADDR'];
                
                return false;
            }
        }
        
    }
