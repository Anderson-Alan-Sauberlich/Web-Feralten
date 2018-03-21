<?php
namespace Module\Application\View\SRC\Layout\Menu;
    
    use Module\Application\Controller\Layout\Menu\Pesquisa as Controller_Pesquisa;
    
    class Pesquisa
    {
        function __construct(?array $form_pesquisa = null)
        {
            self::$form_pesquisa = $form_pesquisa;
            
            require_once RAIZ.'/Module/Application/View/HTML/Layout/Menu/Pesquisa.php';
        }
        
        private static $form_pesquisa;
        
        public static function Carregar_Ano_De() : void
        {
            for ($i=2017; $i >= 1900; $i--) {
                if (self::$form_pesquisa['ano_de'] == $i) {
                    echo "<option selected value=\"".$i."\">".$i."</option>";
                } else {
                    echo "<option value=\"".$i."\">".$i."</option>";
                }
            }
        }
        
        public static function Carregar_Ano_Ate() : void
        {
            for ($i=2017; $i >= 1900; $i--) {
                if (self::$form_pesquisa['ano_ate'] == $i) {
                    echo "<option selected value=\"".$i."\">".$i."</option>";
                } else {
                    echo "<option value=\"".$i."\">".$i."</option>";
                }
            }
        }
        
        public static function Carregar_Categorias() : void
        {
            $categorias = Controller_Pesquisa::Buscar_Todas_Categorias();
            
            if (!empty($categorias) AND $categorias !== false) {
                foreach ($categorias as $categoria) {
                    if (isset(self::$form_pesquisa['categoria'])) {
                        if (self::$form_pesquisa['categoria'] == $categoria->get_id()) {
                            echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12\"><div class=\"ui checked slider checkbox\"><input type=\"radio\" onchange=\"Carregar_Categoria(this)\" checked=\"checked\" id=\"".$categoria->get_id()."\" name=\"categoria\" data-nome=\"".$categoria->get_nome()."\" data-url=\"".$categoria->get_url()."\" value=\"".$categoria->get_id()."\" form=\"searschform\"><label>".$categoria->get_nome()."</label></div></div>";
                        } else {
                            echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12\"><div class=\"ui slider checkbox\"><input type=\"radio\" onchange=\"Carregar_Categoria(this)\" id=\"".$categoria->get_id()."\" name=\"categoria\" data-nome=\"".$categoria->get_nome()."\" data-url=\"".$categoria->get_url()."\" value=\"".$categoria->get_id()."\" form=\"searschform\"><label>".$categoria->get_nome()."</label></div></div>";
                        }
                    } else {
                        echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12\"><div class=\"ui slider checkbox\"><input type=\"radio\" onchange=\"Carregar_Categoria(this)\" id=\"".$categoria->get_id()."\" name=\"categoria\" data-nome=\"".$categoria->get_nome()."\" data-url=\"".$categoria->get_url()."\" value=\"".$categoria->get_id()."\" form=\"searschform\"><label>".$categoria->get_nome()."</label></div></div>";
                    }
                }
            } else {
                echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12\">Erro</div>";
            }
        }
        
        public static function Carregar_Marcas(?int $categoria = null) : void
        {
            $marcas = null;
            
            if (!empty($categoria)) {
                $marcas = Controller_Pesquisa::Buscar_Marca_Por_Id_Categoria($categoria);
            } else if (isset(self::$form_pesquisa['categoria'])) {
                if (!empty(self::$form_pesquisa['categoria'])) {
                    $marcas = Controller_Pesquisa::Buscar_Marca_Por_Id_Categoria(self::$form_pesquisa['categoria']);
                }
            }
            
            echo "<option  value=\"0\">Marca</option>";
            
            if ($marcas !== false) {
                if (!empty($marcas)) {
                    foreach ($marcas as $marca) {
                        if (isset(self::$form_pesquisa['marca'])) {
                            if (self::$form_pesquisa['marca'] == $marca->get_id()) {
                                echo "<option selected value=\"".$marca->get_id()."\" data-url=\"".$marca->get_url()."\">".$marca->get_nome()."</option>";
                            } else {
                                echo "<option value=\"".$marca->get_id()."\" data-url=\"".$marca->get_url()."\">".$marca->get_nome()."</option>";
                            }
                        } else {
                            echo "<option value=\"".$marca->get_id()."\" data-url=\"".$marca->get_url()."\">".$marca->get_nome()."</option>";
                        }
                    }
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Modelos(?int $marca = null) : void
        {
            $modelos = null;
            
            if (!empty(!empty($marca))) {
                $modelos = Controller_Pesquisa::Buscar_Modelo_Por_Id_Marca($marca);
            } else if (isset(self::$form_pesquisa['marca'])) {
                if (!empty(self::$form_pesquisa['marca'])) {
                    $modelos = Controller_Pesquisa::Buscar_Modelo_Por_Id_Marca(self::$form_pesquisa['marca']);
                }
            }
            
            echo "<option value=\"0\">Modelo</option>";
            
            if ($modelos !== false) {
                if (!empty($modelos)) {
                    foreach ($modelos as $modelo) {
                        if (isset(self::$form_pesquisa['modelo'])) {
                            if (self::$form_pesquisa['modelo'] == $modelo->get_id()) {
                                echo "<option selected value=\"".$modelo->get_id()."\" data-url=\"".$modelo->get_url()."\">".$modelo->get_nome()."</option>";
                            } else {
                                echo "<option value=\"".$modelo->get_id()."\" data-url=\"".$modelo->get_url()."\">".$modelo->get_nome()."</option>";
                            }
                        } else {
                            echo "<option value=\"".$modelo->get_id()."\" data-url=\"".$modelo->get_url()."\">".$modelo->get_nome()."</option>";
                        }
                    }
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Carregar_Versoes(?int $modelo = null) : void
        {
            $versoes = null;
            
            if (!empty($modelo)) {
                $versoes = Controller_Pesquisa::Buscar_Versoes_Por_Id_Modelo($modelo);
            } else if (isset(self::$form_pesquisa['modelo'])) {
                if (!empty(self::$form_pesquisa['modelo'])) {
                    $versoes = Controller_Pesquisa::Buscar_Versoes_Por_Id_Modelo(self::$form_pesquisa['modelo']);
                }
            }
            
            echo "<option value=\"0\">Versão</option>";
        
            if ($versoes !== false) {
                if (!empty($versoes)) {
                    foreach ($versoes as $versao) {
                        if (isset(self::$form_pesquisa['versao'])) {
                            if (self::$form_pesquisa['versao'] == $versao->get_id()) {
                                echo "<option selected value=\"".$versao->get_id()."\" data-url=\"".$versao->get_url()."\">".$versao->get_nome()."</option>";
                            } else {
                                echo "<option value=\"".$versao->get_id()."\" data-url=\"".$versao->get_url()."\">".$versao->get_nome()."</option>";
                            }
                        } else {
                            echo "<option value=\"".$versao->get_id()."\" data-url=\"".$versao->get_url()."\">".$versao->get_nome()."</option>";
                        }
                    }
                }
            } else {
                echo "<option value=\"\">Erro</option>";
            }
        }
        
        public static function Manter_Valor_Pesquisa() : void
        {
            if (isset(self::$form_pesquisa['peca_nome'])) {
                echo self::$form_pesquisa['peca_nome'];
            }
        }
        
        public static function Mostrar_Status() : void
        {
            if (!isset(self::$form_pesquisa['categoria']) OR empty(self::$form_pesquisa['categoria'])) {
                echo 'active';
            }
        }
    }
