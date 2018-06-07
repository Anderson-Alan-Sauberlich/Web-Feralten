<?php
namespace Module\Application\View\SRC\Usuario;

    class Cadastro
    {
        function __construct()
        {
            
        }
        
        private static $erros;
        private static $campos;
        private static $form;
        
        public function set_erros(?array $erros = null) : void
        {
            self::$erros = $erros;
        }
        
        public function set_campos(?array $campos = null) : void
        {
            self::$campos = $campos;
        }
        
        public function set_form(?array $form = null) : void
        {
            self::$form = $form;
        }
        
        public static function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Cadastro.php';
        }
        
        public static function Mostrar_Erros() : void
        {
            if (!empty(self::$erros)) {
                foreach (self::$erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>$value</div>";
                }
            }
        }

        public static function Manter_Valor(string $campo) : void
        {
            if (!empty(self::$form)) {
                if (isset(self::$form[$campo])) {
                    echo self::$form[$campo];
                }
            }
        }
        
        public static function Incluir_Classe_Erros(string $campo) : void
        {
            if (!empty(self::$campos)) {
                switch ($campo) {
                    case "nome":
                        if (isset(self::$campos['erro_nome'])) {
                            if (self::$campos['erro_nome'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_nome'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "sobrenome":
                        if (isset(self::$campos['erro_sobrenome'])) {
                            if (self::$campos['erro_sobrenome'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_sobrenome'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "telefone":
                        if (isset(self::$campos['erro_telefone'])) {
                            if (self::$campos['erro_telefone'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_telefone'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "email":
                        if (isset(self::$campos['erro_email'])) {
                            if (self::$campos['erro_email'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_email'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "senha":
                        if (isset(self::$campos['erro_senha'])) {
                            if (self::$campos['erro_senha'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_senha'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                }
            }
        }
    }
