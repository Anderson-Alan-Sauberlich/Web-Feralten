<?php
namespace Module\Application\View\SRC\Usuario;

    class Cadastro
    {
        function __construct()
        {
            
        }
        
        private static $cadastro_erros;
        private static $cadastro_campos;
        private static $cadastro_form;
        
        public function set_cadastro_erros(?array $cadastro_erros = null) : void
        {
            self::$cadastro_erros = $cadastro_erros;
        }
        
        public function set_cadastro_campos(?array $cadastro_campos = null) : void
        {
            self::$cadastro_campos = $cadastro_campos;
        }
        
        public function set_cadastro_form(?array $cadastro_form = null) : void
        {
            self::$cadastro_form = $cadastro_form;
        }
        
        public static function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Cadastro.php';
        }
        
        public static function Mostrar_Erros() : void
        {
            if (!empty(self::$cadastro_erros)) {
                foreach (self::$cadastro_erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
            }
        }

        public static function Manter_Valor(string $campo) : void
        {
            if (!empty(self::$cadastro_form)) {
                if (isset(self::$cadastro_form[$campo])) {
                    echo self::$cadastro_form[$campo];
                }
            }
        }
        
        public static function Incluir_Classe_Erros(string $campo) : void
        {
            if (!empty(self::$cadastro_campos)) {
                switch ($campo) {
                    case "nome":
                        if (isset(self::$cadastro_campos['erro_nome'])) {
                            if (self::$cadastro_campos['erro_nome'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$cadastro_campos['erro_nome'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "sobrenome":
                        if (isset(self::$cadastro_campos['erro_sobrenome'])) {
                            if (self::$cadastro_campos['erro_sobrenome'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$cadastro_campos['erro_sobrenome'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "email":
                        if (isset(self::$cadastro_campos['erro_email'])) {
                            if (self::$cadastro_campos['erro_email'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$cadastro_campos['erro_email'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "senha":
                        if (isset(self::$cadastro_campos['erro_senha'])) {
                            if (self::$cadastro_campos['erro_senha'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$cadastro_campos['erro_senha'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                }
            }
        }
    }
