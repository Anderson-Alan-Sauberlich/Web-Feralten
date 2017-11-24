<?php
namespace module\application\controller\common\util;
    
    class Peca
    {
        
        function __construct()
        {
            
        }
        
        public static function Gerar_URL_Peca(string $nome) : ?string
        {
            $valor = null;
            
            if (!empty($nome)) {
                $nome = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $nome);
                $nome = trim($nome);
                $nome = preg_replace('/\s+/', '-', $nome);
                $nome = preg_replace(array('/[ ]/', '/[^A-Za-z0-9\-]/'), array('', ''), $nome);
                
                $valor = $nome;
            }
            
            return $valor;
        }
        
    }
