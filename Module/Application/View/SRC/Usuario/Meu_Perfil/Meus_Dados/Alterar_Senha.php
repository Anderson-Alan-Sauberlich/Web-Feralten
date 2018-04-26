<?php
namespace Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados;
    
    use Module\Application\View\SRC\Layout\Header\Usuario as View_Header_Usuario;
    use Module\Application\View\SRC\Layout\Menu\Usuario as View_Menu_Usuario;
    
    class Alterar_Senha
    {
        function __construct(?int $status = null)
        {
            self::$status_usuario = $status;
        }
        
        private static $status_usuario;
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
        
        public function Executar() : void
        {
            require_once RAIZ.'/Module/Application/View/HTML/Usuario/Meu_Perfil/Meus_Dados/Alterar_Senha.php';
        }
        
        public static function Incluir_Header_Usuario() : void
        {
            new View_Header_Usuario(self::$status_usuario, ['meus-dados', 'alterar-senha']);
        }
        
        public static function Incluir_Menu_Usuario() : void
        {
            new View_Menu_Usuario(self::$status_usuario, ['meus-dados', 'alterar-senha']);
        }
        
        public static function Manter_Valor(string $campo) : void
        {
            if (!empty(self::$form)) {
                if (isset(self::$form[$campo])) {
                    echo self::$form[$campo];
                }
            }
        }
        
        public static function Mostrar_Erros() : void
        {
            if (!empty(self::$erros)) {
                echo "<div class=\"container-fluid\"><div class=\"row\">";
                foreach (self::$erros as $value) {
                    echo "<div class=\"alert alert-danger col-sm-6 col-md-4 fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" . $value . "</div>";
                }
                echo "</div></div>";
            }
        }
        
        public function Incluir_Classe_Erros(string $campo) : void
        {
            if (!empty(self::$campos)) {
                switch ($campo) {
                    case "senha_antiga":
                        if (isset(self::$campos['erro_senha_antiga'])) {
                            if (self::$campos['erro_senha_antiga'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_senha_antiga'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "senha_nova":
                        if (isset(self::$campos['erro_senha_nova'])) {
                            if (self::$campos['erro_senha_nova'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_senha_nova'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                        
                    case "senha_confnova":
                        if (isset(self::$campos['erro_senha_confnova'])) {
                            if (self::$campos['erro_senha_confnova'] == "erro") {
                                echo "has-error has-feedback";
                            } else if (self::$campos['erro_senha_confnova'] == "certo") {
                                echo "has-success has-feedback";
                            }
                        }
                        break;
                }
            }
        }
    }
