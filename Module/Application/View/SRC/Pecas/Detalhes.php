<?php
namespace Module\Application\View\SRC\Pecas;
    
    use Module\Application\Controller\Pecas\Detalhes as Controller_Detalhes;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    use Module\Application\View\SRC\Layout\Form\Contato_Anunciante as View_Contato_Anunciante;
    use Module\Application\View\SRC\Layout\Menu\Pesquisa as View_Pesquisa;
    
    class Detalhes
    {
        function __construct()
        {
            
        }
        
        /**
         * 
         * @var OBJ_Peca
         */
        private static $obj_peca;
        
        /**
         * 
         * @var View_Contato_Anunciante
         */
        private static $view_contato_anunciante;
        
        /**
         * 
         * @var array
         */
        private static $categorias_pativeis;
        
        /**
         * 
         * @var array
         */
        private static $marcas_pativeis;
        
        /**
         * 
         * @var array
         */
        private static $modelos_pativeis;
        
        /**
         * 
         * @var array
         */
        private static $versoes_pativeis;
        
        /**
         * 
         * @param OBJ_Peca $obj_peca
         */
        public function set_obj_peca(OBJ_Peca $obj_peca) : void
        {
            self::$obj_peca = $obj_peca;
        }
        
        /**
         * Seta o objeto do form contato anunciante.
         *
         * @param View_Contato_Anunciante $view_contato_anunciante
         */
        public function set_view_contato_anunciante(View_Contato_Anunciante $view_contato_anunciante) : void
        {
            self::$view_contato_anunciante = $view_contato_anunciante;
        }
        
        /**
         * 
         * @param array $categorias_pativeis
         */
        public function set_categorias_pativeis(array $categorias_pativeis) : void
        {
            self::$categorias_pativeis = $categorias_pativeis;
        }
        
        /**
         * 
         * @param array $marcas_pativeis
         */
        public function set_marcas_pativeis(array $marcas_pativeis) : void
        {
            self::$marcas_pativeis = $marcas_pativeis;
        }
        
        /**
         * 
         * @param array $modelos_pativeis
         */
        public function set_modelos_pativeis(array $modelos_pativeis) : void
        {
            self::$modelos_pativeis = $modelos_pativeis;
        }
        
        /**
         * 
         * @param array $versoes_pativeis
         */
        public function set_versoes_pativeis(array $versoes_pativeis) : void
        {
            self::$versoes_pativeis = $versoes_pativeis;
        }
        
        /**
         * Executa o html que puxa todas as variaveis staticas.
         */
        public function Executar()
        {
            require_once RAIZ.'/Module/Application/View/HTML/Pecas/Detalhes.php';
        }
        
        /**
         * 
         * @return bool
         */
        public static function Verificar_Peca() : bool
        {
            return self::$obj_peca instanceof OBJ_Peca;
        }
        
        public static function Incluir_Menu_Pesquisa()
        {
            new View_Pesquisa();
        }
        
        public static function Incluir_Form_Contato_Anunciante() : void
        {
            if (self::$view_contato_anunciante instanceof View_Contato_Anunciante) {
                self::$view_contato_anunciante->set_peca_id(self::$obj_peca->get_id());
            
                self::$view_contato_anunciante->Executar();
            }
        }
        
        public static function Mostrar_Nome() : void
        {
            echo self::$obj_peca->get_nome();
        }
        /**
         * 
         * @return int|NULL
         */
        public static function Mostrar_Visualizacoes() : ?int
        {
            return self::$obj_peca->get_num_visualizado();
        }
        
        public static function Mostrar_Preco() : void
        {
            if (empty(self::$obj_peca->get_preco()) OR self::$obj_peca->get_preco() == false) {
                echo 'R$ A Negociar';
            } else {
                echo 'R$ '.number_format(self::$obj_peca->get_preco(), 2, ',', '.');
            }
        }
        
        public static function Mostrar_Fabricante() : void
        {
            if (empty(self::$obj_peca->get_fabricante()) OR self::$obj_peca->get_fabricante() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_fabricante();
            }
        }
        
        public static function Verificar_Fabricante() : bool
        {
            return !empty(self::$obj_peca->get_fabricante()) OR self::$obj_peca->get_fabricante() != false;
        }
        
        public static function Mostrar_Estado_Uso() : void
        {
            if (empty(self::$obj_peca->get_estado_uso()) OR self::$obj_peca->get_estado_uso() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_estado_uso()->get_nome();
            }
        }
        
        public static function Verificar_Estado_Uso() : bool
        {
            return !empty(self::$obj_peca->get_estado_uso()) OR self::$obj_peca->get_estado_uso() != false;
        }
        
        public static function Mostrar_Serie() : void
        {
            if (empty(self::$obj_peca->get_serie()) OR self::$obj_peca->get_serie() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_serie();
            }
        }
        
        public static function Verificar_Serie() : bool
        {
            return !empty(self::$obj_peca->get_serie()) OR self::$obj_peca->get_serie() != false;
        }
        
        public static function Mostrar_Descricao() : void
        {
            if (empty(self::$obj_peca->get_descricao()) OR self::$obj_peca->get_descricao() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_descricao();
            }
        }
        
        public static function Verificar_Descricao() : bool
        {
            return !empty(self::$obj_peca->get_descricao()) OR self::$obj_peca->get_descricao() != false;
        }
        
        public static function Mostrar_Preferencia_Entrega() : void
        {
            if (empty(self::$obj_peca->get_preferencia_entrega()) OR self::$obj_peca->get_preferencia_entrega() == false) {
                echo 'não informado';
            } else {
                $preferencias_entrega = Controller_Detalhes::Retornar_Preferencias_Entrega();
                
                foreach (self::$obj_peca->get_preferencias_entrega(self::$obj_peca->get_preferencia_entrega()) as $valor) {
                    foreach ($preferencias_entrega as $valor2) {
                        if ($valor2->get_id() == $valor) {
                            echo '<label class="ui large basic horizontal label"> '.$valor2->get_nome().' </label> ';
                        }
                    }
                }
            }
        }
        
        public static function Verificar_Preferencia_Entrega() : bool
        {
            return !empty(self::$obj_peca->get_preferencia_entrega()) OR self::$obj_peca->get_preferencia_entrega() != false;
        }
        
        public static function Validar_Preferencia_Entrega(int $preferencia) : bool
        {
            if (empty(self::$obj_peca->get_preferencia_entrega()) OR self::$obj_peca->get_preferencia_entrega() == false) {
                return false;
            } else {
                return in_array($preferencia, self::$obj_peca->get_preferencias_entrega(self::$obj_peca->get_preferencia_entrega()));
            }
        }
        
        public static function Mostrar_Foto_Peca(int $numero, string $tamanho) : void
        {
            if (empty(self::$obj_peca->get_foto($numero)) OR self::$obj_peca->get_foto($numero) == false) {
                echo '/resources/img/imagem_indisponivel.png';
            } else {
                echo str_replace('@', $tamanho, self::$obj_peca->get_foto($numero)->get_endereco());
            }
        }
        
        public static function Mostrar_Estado() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_estado()->get_nome()) OR self::$obj_peca->get_endereco()->get_estado()->get_nome() == false) {
                echo 'erro, estado';
            } else {
                echo self::$obj_peca->get_endereco()->get_estado()->get_nome();
            }
        }
        
        public static function Mostrar_Cidade() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_cidade()->get_nome()) OR self::$obj_peca->get_endereco()->get_cidade()->get_nome() == false) {
                echo 'erro, cidade';
            } else {
                echo self::$obj_peca->get_endereco()->get_cidade()->get_nome();
            }
        }
        
        public static function Mostrar_Bairro() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_bairro()) OR self::$obj_peca->get_endereco()->get_bairro() == false) {
                echo 'erro, bairro';
            } else {
                echo self::$obj_peca->get_endereco()->get_bairro();
            }
        }
        
        public static function Mostrar_Rua() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_rua()) OR self::$obj_peca->get_endereco()->get_rua() == false) {
                echo 'erro, rua';
            } else {
                echo self::$obj_peca->get_endereco()->get_rua();
            }
        }
        
        public static function Mostrar_Numero() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_numero()) OR self::$obj_peca->get_endereco()->get_numero() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_endereco()->get_numero();
            }
        }
        
        public static function Mostrar_Cep() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_cep()) OR self::$obj_peca->get_endereco()->get_cep() == false) {
                echo 'erro, cep';
            } else {
                echo self::$obj_peca->get_endereco()->get_cep();
            }
        }
        
        public static function Mostrar_Complemento() : void
        {
            if (empty(self::$obj_peca->get_endereco()->get_complemento()) OR self::$obj_peca->get_endereco()->get_complemento() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_endereco()->get_complemento();
            }
        }
        
        public static function Verificar_Complemento() : bool
        {
            return !empty(self::$obj_peca->get_endereco()->get_complemento()) OR self::$obj_peca->get_endereco()->get_complemento() != false;
        }
        
        public static function Mostrar_Nome_Comercial() : void
        {
            if (empty(self::$obj_peca->get_entidade()->get_nome_comercial()) OR self::$obj_peca->get_entidade()->get_nome_comercial() == false) {
                if (empty(self::$obj_peca->get_responsavel()->get_nome()) OR self::$obj_peca->get_responsavel()->get_nome() == false) {
                    echo 'erro, nome usuario';
                } else {
                    echo self::$obj_peca->get_responsavel()->get_nome();
                }
            } else {
                echo self::$obj_peca->get_entidade()->get_nome_comercial();
            }
        }
        
        public static function Mostrar_Site() : void
        {
            if (empty(self::$obj_peca->get_entidade()->get_site()) OR self::$obj_peca->get_entidade()->get_site() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_entidade()->get_site();
            }
        }
        
        public static function Verificar_Site() : bool
        {
            return !empty(self::$obj_peca->get_entidade()->get_site()) OR self::$obj_peca->get_entidade()->get_site() != false;
        }
        
        public static function Mostrar_Foto_Entidade() : void
        {
            if (empty(self::$obj_peca->get_entidade()->get_imagem()) OR self::$obj_peca->get_entidade()->get_imagem() == false) {
                echo '/resources/img/imagem_indisponivel.png';
            } else {
                echo str_replace('@', '200x150', self::$obj_peca->get_entidade()->get_imagem());
            }
        }
        
        public static function Mostrar_Email_Responsavel() : void
        {
            if (empty(self::$obj_peca->get_responsavel()->get_email()) OR self::$obj_peca->get_responsavel()->get_email() == false) {
                echo 'erro, e-mail responsavel';
            } else {
                echo self::$obj_peca->get_responsavel()->get_email();
            }
        }
        
        public static function Mostrar_Email_Alternativo_Responsavel() : void
        {
            if (empty(self::$obj_peca->get_responsavel()->get_email_alternativo()) OR self::$obj_peca->get_responsavel()->get_email_alternativo() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_responsavel()->get_email_alternativo();
            }
        }
        
        public static function Verificar_Email_Alternativo_Responsavel() : bool
        {
            return !empty(self::$obj_peca->get_responsavel()->get_email_alternativo()) OR self::$obj_peca->get_responsavel()->get_email_alternativo() != false;
        }
        
        public static function Mostrar_Fone_Responsavel() : void
        {
            if (empty(self::$obj_peca->get_responsavel()->get_fone()) OR self::$obj_peca->get_responsavel()->get_fone() == false) {
                echo 'erro, telefone 1';
            } else {
                echo self::$obj_peca->get_responsavel()->get_fone();
            }
        }
        
        public static function Mostrar_Fone_Alternativo_Responsavel() : void
        {
            if (empty(self::$obj_peca->get_responsavel()->get_fone_alternativo()) OR self::$obj_peca->get_responsavel()->get_fone_alternativo() == false) {
                echo 'não informado';
            } else {
                echo self::$obj_peca->get_responsavel()->get_fone_alternativo();
            }
        }
        
        public static function Verificar_Fone_Alternativo_Responsavel() : bool
        {
            return !empty(self::$obj_peca->get_responsavel()->get_fone_alternativo()) OR self::$obj_peca->get_responsavel()->get_fone_alternativo() != false;
        }
        
        public static function Mostrar_Pativeis() : void
        {
            if (!empty(self::$categorias_pativeis) AND self::$categorias_pativeis != false) {
                echo '<div class="ui divider"></div>';
                
                foreach (self::$categorias_pativeis as $categoria_pativel) {
                    echo '<label>'.$categoria_pativel->get_obj_categoria()->get_nome().' </label>';
                    
                    if (!empty($categoria_pativel->get_anos())) {
                        foreach ($categoria_pativel->get_anos() as $ano) {
                            echo ' - '.$ano;
                        }
                    }
                    
                    if (!empty(self::$marcas_pativeis) AND self::$marcas_pativeis != false) {
                        foreach (self::$marcas_pativeis as $marca_pativel) {
                            if ($categoria_pativel->get_obj_categoria()->get_id() == $marca_pativel->get_obj_marca()->get_categoria_id()) {
                                echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$marca_pativel->get_obj_marca()->get_nome().' </label>';
                                
                                if (!empty($marca_pativel->get_anos())) {
                                    foreach ($marca_pativel->get_anos() as $ano) {
                                        echo ' - '.$ano;
                                    }
                                }
                                
                                if (!empty(self::$modelos_pativeis) AND self::$modelos_pativeis != false) {
                                    foreach (self::$modelos_pativeis as $modelo_pativel) {
                                        if ($marca_pativel->get_obj_marca()->get_id() == $modelo_pativel->get_obj_modelo()->get_marca_id()) {
                                            echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$modelo_pativel->get_obj_modelo()->get_nome().' </label>';
                                            
                                            if (!empty($modelo_pativel->get_anos())) {
                                                foreach ($modelo_pativel->get_anos() as $ano) {
                                                    echo ' - '.$ano;
                                                }
                                            }
                                            
                                            if (!empty(self::$versoes_pativeis) AND self::$versoes_pativeis != false) {
                                                foreach (self::$versoes_pativeis as $versao_pativel) {
                                                    if ($modelo_pativel->get_obj_modelo()->get_id() == $versao_pativel->get_obj_versao()->get_modelo_id()) {
                                                        echo ' <label> <i class="lbPanel glyphicon glyphicon-hand-right"></i> '.$versao_pativel->get_obj_versao()->get_nome().'</label>';
                                                        
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
        
        /**
         * 
         * @return bool
         */
        public static function Validar_Pativeis() : bool
        {
            return !empty(self::$categorias_pativeis) AND self::$categorias_pativeis != false;
        }
    }
