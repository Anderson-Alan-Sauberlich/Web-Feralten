<?php
namespace application\model\util;

    use \PDO;
    use \PDOException;

    class Conexao {

        function __construct() {
            $this->Conectar();
        }

        function __destruct() {
            $this->Disconnect();
            foreach ($this as $key => $value) {
                unset($this->$key);
            }
        }
        
        public static $conection;

        private static $DB_TYPE = "mysql";
        private static $DB_HOST = "localhost";
        private static $DB_PORT = "3306";
        private static $DB_USER = "root";
        private static $DB_PASS = "1234";
        private static $DB_NAME = "FERALTEN_BD";
        private static $DB_CHRS = "utf8";

        public static function Conectar() {
            if (!isset(self::$conection)) {
                try
                {
                    self::$conection = new PDO(
                    self::$DB_TYPE.":host=".self::$DB_HOST.";port=".self::$DB_PORT.";dbname=".self::$DB_NAME.";charset=".self::$DB_CHRS, self::$DB_USER, self::$DB_PASS,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    self::$conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //self::$conection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                } 
                catch (PDOException $e)
                {
                    die("Erro: <code>" . $e->getMessage() . "</code>");
                }
            }
            
            return self::$conection;
        }

        public function Disconnect(){
            self::$conection = null;
        }
    }
?>