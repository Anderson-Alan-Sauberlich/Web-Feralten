<?php
namespace Module\Application\View\SRC\Pecas;
    
    use Module\Application\Controller\Pecas\Detalhes as Controller_Detalhes;
    use Module\Application\Model\Object\Peca as Object_Peca;
    use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante;
    
    class Detalhes
    {

        function __construct()
        {
        	
        }
        
        private static $object_peca;
        private static $categorias_pativeis;
        private static $marcas_pativeis;
        private static $modelos_pativeis;
        private static $versoes_pativeis;
        
        public function set_object_peca(Object_Peca $object_peca) : void
        {
            self::$object_peca = $object_peca;
        }
        
        public function set_categorias_pativeis(array $categorias_pativeis) : void
        {
            self::$categorias_pativeis = $categorias_pativeis;
        }
        
        public function set_marcas_pativeis(array $marcas_pativeis) : void
        {
            self::$marcas_pativeis = $marcas_pativeis;
        }
        
        public function set_modelos_pativeis(array $modelos_pativeis) : void
        {
            self::$modelos_pativeis = $modelos_pativeis;
        }
        
        public function set_versoes_pativeis(array $versoes_pativeis) : void
        {
            self::$versoes_pativeis = $versoes_pativeis;
        }
        
        public function Executar()
        {
        	require_once RAIZ.'/Module/Application/View/HTML/Pecas/Detalhes.php';
        }
        
        public static function Incluir_Form_Contato_Anunciante() : void
        {
            $view_contato_anunciante = new View_Contato_Anunciante();
            
            $view_contato_anunciante->set_peca_id(self::$object_peca->get_id());
            
            $view_contato_anunciante->Executar();
        }
        
        public static function Mostrar_Nome() : void
        {
            echo self::$object_peca->get_nome();
        }
        
        public static function Mostrar_Fabricante() : void
        {
            if (empty(self::$object_peca->get_fabricante()) OR self::$object_peca->get_fabricante() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_fabricante();
            }
        }
        
        public static function Mostrar_Preco() : void
        {
            if (empty(self::$object_peca->get_preco()) OR self::$object_peca->get_preco() == false) {
                echo 'a negociar';
            } else {
                echo self::$object_peca->get_preco();
            }
        }
        
        public static function Mostrar_Estado_Uso() : void
        {
            if (empty(self::$object_peca->get_estado_uso()) OR self::$object_peca->get_estado_uso() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_estado_uso()->get_nome();
            }
        }
        
        public static function Mostrar_Serie() : void
        {
            if (empty(self::$object_peca->get_serie()) OR self::$object_peca->get_serie() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_serie();
            }
        }
        
        public static function Mostrar_Descricao() : void
        {
            if (empty(self::$object_peca->get_descricao()) OR self::$object_peca->get_descricao() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_descricao();
            }
        }
        
        public static function Mostrar_Preferencia_Entrega() : void
        {
            if (empty(self::$object_peca->get_preferencia_entrega()) OR self::$object_peca->get_preferencia_entrega() == false) {
                echo 'não informado';
            } else {
                $preferencias_entrega = Controller_Detalhes::Retornar_Preferencias_Entrega();
                
                foreach (self::$object_peca->get_preferencias_entrega(self::$object_peca->get_preferencia_entrega()) as $valor) {
                    foreach ($preferencias_entrega as $valor2) {
                        if ($valor2->get_id() == $valor) {
                            echo ' - <label>'.$valor2->get_nome().'</label>';
                        }
                    }
                }
            }
        }
        
        public static function Verificar_Preferencia_Entrega(int $preferencia) : bool
        {
            if (empty(self::$object_peca->get_preferencia_entrega()) OR self::$object_peca->get_preferencia_entrega() == false) {
                return false;
            } else {
                return in_array($preferencia, self::$object_peca->get_preferencias_entrega(self::$object_peca->get_preferencia_entrega()));
            }
        }
        
        public static function Mostrar_Foto_Peca(int $numero, string $tamanho) : void
        {
            if (empty(self::$object_peca->get_foto($numero)) OR self::$object_peca->get_foto($numero) == false) {
                echo '/resources/img/imagem_indisponivel.png';
            } else {
                echo str_replace('@', $tamanho, self::$object_peca->get_foto($numero)->get_endereco());
            }
        }
        
        public static function Mostrar_Estado() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_estado()->get_nome()) OR self::$object_peca->get_endereco()->get_estado()->get_nome() == false) {
                echo 'erro, estado';
            } else {
                echo self::$object_peca->get_endereco()->get_estado()->get_nome();
            }
        }
        
        public static function Mostrar_Cidade() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_cidade()->get_nome()) OR self::$object_peca->get_endereco()->get_cidade()->get_nome() == false) {
                echo 'erro, cidade';
            } else {
                echo self::$object_peca->get_endereco()->get_cidade()->get_nome();
            }
        }
        
        public static function Mostrar_Bairro() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_bairro()) OR self::$object_peca->get_endereco()->get_bairro() == false) {
                echo 'erro, bairro';
            } else {
                echo self::$object_peca->get_endereco()->get_bairro();
            }
        }
        
        public static function Mostrar_Rua() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_rua()) OR self::$object_peca->get_endereco()->get_rua() == false) {
                echo 'erro, rua';
            } else {
                echo self::$object_peca->get_endereco()->get_rua();
            }
        }
        
        public static function Mostrar_Numero() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_numero()) OR self::$object_peca->get_endereco()->get_numero() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_endereco()->get_numero();
            }
        }
        
        public static function Mostrar_Cep() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_cep()) OR self::$object_peca->get_endereco()->get_cep() == false) {
                echo 'erro, cep';
            } else {
                echo self::$object_peca->get_endereco()->get_cep();
            }
        }
        
        public static function Mostrar_Complemento() : void
        {
            if (empty(self::$object_peca->get_endereco()->get_complemento()) OR self::$object_peca->get_endereco()->get_complemento() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_endereco()->get_complemento();
            }
        }
        
        public static function Mostrar_Nome_Comercial() : void
        {
            if (empty(self::$object_peca->get_entidade()->get_nome_comercial()) OR self::$object_peca->get_entidade()->get_nome_comercial() == false) {
                if (empty(self::$object_peca->get_responsavel()->get_nome()) OR self::$object_peca->get_responsavel()->get_nome() == false) {
                    echo 'erro, nome usuario';
                } else {
                    echo self::$object_peca->get_responsavel()->get_nome();
                }
            } else {
                echo self::$object_peca->get_entidade()->get_nome_comercial();
            }
        }
        
        public static function Mostrar_Site() : void
        {
            if (empty(self::$object_peca->get_entidade()->get_site()) OR self::$object_peca->get_entidade()->get_site() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_entidade()->get_site();
            }
        }
        
        public static function Mostrar_Foto_Entidade() : void
        {
            if (empty(self::$object_peca->get_entidade()->get_imagem()) OR self::$object_peca->get_entidade()->get_imagem() == false) {
                echo '/resources/img/imagem_indisponivel.png';
            } else {
                echo str_replace('@', '100x75', self::$object_peca->get_entidade()->get_imagem());
            }
        }
        
        public static function Mostrar_Email_Responsavel() : void
        {
            if (empty(self::$object_peca->get_responsavel()->get_email()) OR self::$object_peca->get_responsavel()->get_email() == false) {
                echo 'erro, e-mail responsavel';
            } else {
                echo self::$object_peca->get_responsavel()->get_email();
            }
        }
        
        public static function Mostrar_Email_Alternativo_Responsavel() : void
        {
            if (empty(self::$object_peca->get_responsavel()->get_email_alternativo()) OR self::$object_peca->get_responsavel()->get_email_alternativo() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_responsavel()->get_email_alternativo();
            }
        }
        
        public static function Mostrar_Fone_Responsavel() : void
        {
            if (empty(self::$object_peca->get_responsavel()->get_fone()) OR self::$object_peca->get_responsavel()->get_fone() == false) {
                echo 'erro, telefone 1';
            } else {
                echo self::$object_peca->get_responsavel()->get_fone();
            }
        }
        
        public static function Mostrar_Fone_Alternativo_Responsavel() : void
        {
            if (empty(self::$object_peca->get_responsavel()->get_fone_alternativo()) OR self::$object_peca->get_responsavel()->get_fone_alternativo() == false) {
                echo 'não informado';
            } else {
                echo self::$object_peca->get_responsavel()->get_fone_alternativo();
            }
        }
        
        public static function Mostrar_Pativeis() : void
        {
            if (!empty(self::$categorias_pativeis) AND self::$categorias_pativeis != false) {
                echo '<div class="ui divider"></div>';
                
                foreach (self::$categorias_pativeis as $categoria_pativel) {
                    echo '<label>'.$categoria_pativel->get_object_categoria()->get_nome().' </label>';
                    
                    if (!empty($categoria_pativel->get_anos())) {
                        foreach ($categoria_pativel->get_anos() as $ano) {
                            echo ' - '.$ano;
                        }
                    }
                    
                    if (!empty(self::$marcas_pativeis) AND self::$marcas_pativeis != false) {
                        foreach (self::$marcas_pativeis as $marca_pativel) {
                            if ($categoria_pativel->get_object_categoria()->get_id() == $marca_pativel->get_object_marca()->get_categoria_id()) {
                                echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$marca_pativel->get_object_marca()->get_nome().' </label>';
                                
                                if (!empty($marca_pativel->get_anos())) {
                                    foreach ($marca_pativel->get_anos() as $ano) {
                                        echo ' - '.$ano;
                                    }
                                }
                                
                                if (!empty(self::$modelos_pativeis) AND self::$modelos_pativeis != false) {
                                    foreach (self::$modelos_pativeis as $modelo_pativel) {
                                        if ($marca_pativel->get_object_marca()->get_id() == $modelo_pativel->get_object_modelo()->get_marca_id()) {
                                            echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$modelo_pativel->get_object_modelo()->get_nome().' </label>';
                                            
                                            if (!empty($modelo_pativel->get_anos())) {
                                                foreach ($modelo_pativel->get_anos() as $ano) {
                                                    echo ' - '.$ano;
                                                }
                                            }
                                            
                                            if (!empty(self::$versoes_pativeis) AND self::$versoes_pativeis != false) {
                                                foreach (self::$versoes_pativeis as $versao_pativel) {
                                                    if ($modelo_pativel->get_object_modelo()->get_id() == $versao_pativel->get_object_versao()->get_modelo_id()) {
                                                        echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$versao_pativel->get_object_versao()->get_nome().'</label>';
                                                        
                                                        if (!empty($versao_pativel->get_anos())) {
                                                            foreach ($versao_pativel->get_anos() as $ano) {
                                                                echo ' - '.$ano;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    echo '<div class="ui divider"></div>';
                }
            }
        }
    }
