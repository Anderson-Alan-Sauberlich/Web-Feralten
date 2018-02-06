<?php
namespace Module\Application\Model\Common\Util;
    
    use \SQLite3;
    
    class Usuario_BD extends SQLite3
    {
        function __construct(int $id_usuario)
        {
            $this->open(RAIZ."/data/usuario/$id_usuario.db");
        }
        
        function __destruct()
        {
            $this->close();
        }
        
        
    }