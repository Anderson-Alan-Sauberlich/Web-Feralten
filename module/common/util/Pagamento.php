<?php
namespace module\common\util;
    
    use Moip\Moip;
    use Moip\Auth\BasicAuth;
    
    class Pagamento {
        
        function __construct() {
            $token = 'ABWBTTMMNLCVKP0MHE8KMOQNHM0TUSLK';
            $key = 'PDYLVJKURWK0KV3XV7WB3QCVLIQGZVUH4CYRKVHY';
            
            $moip = new Moip(new BasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);
            
            //$moip->
        }
        
        
    }
?>