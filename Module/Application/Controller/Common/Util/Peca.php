<?php
namespace Module\Application\Controller\Common\Util;
    
    class Peca
    {
        function __construct()
        {
            
        }
        
        /**
         * Converte o nome da peça para URL amigavel, onde é usado para salvar no nome do arquivo e na url
         * 
         * @param string $nome
         * @return string|NULL
         */
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
