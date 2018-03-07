<?php
namespace Module\Application\View\SRC\Layout\Elemento;
    
    use Module\Application\Model\Object\Orcamento as Object_Orcamento;
    use Module\Application\Model\Common\Util\Login_Session;
        
    class Orcamento
    {
        /** 
         * @const Parametro Funcionalidade
         */
        public const MEUS_ORCAMENTOS = 'meus-orcamentos';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const CAIXA_DE_ENTRADA = 'caixa-de-entrada';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const RESPONDIDOS = 'respondidos';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const NAO_TENHO = 'nao-tenho';
        
        /**
         * @const Parametro Funcionalidade
         */
        public const ORCAMENTOS = 'orcamentos';
        
        function __construct()
        {
            
        }
        
        /**
         * Armazena o objeto do orçamento a sermostrado na view html.
         * 
         * @var Object_Orcamento $obj_orcamento
         */
        private static $obj_orcamento;
        
        /**
         * Armazena o nome da pagina aberta, onde será mostrado o elemento orçamento.
         * 
         * @var string $pagina
         */
        private static $pagina;
        
        /**
         * Seta o objeto orçamento.
         * 
         * @param Object_Orcamento $obj_orcamento
         */
        public function set_obj_orcamento(Object_Orcamento $obj_orcamento) : void
        {
            self::$obj_orcamento = $obj_orcamento;
        }
        
        /**
         * Seta a variavel pagina.
         * 
         * @param string $pagina
         */
        public function set_pagina(string $pagina) : void
        {
            self::$pagina = $pagina;
        }
        
        /**
         * Chama a pagina html que por sua vez chama todas as function estaticas.
         */
        public function Executar() : void
        {
            include RAIZ.'/Module/Application/View/HTML/Layout/Elemento/Orcamento.php';
        }
        
        /**
         * Retorna o ID do orçamento.
         * 
         * @return int|NULL
         */
        public static function MostrarID() : ?int
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_id();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o Nome do orçamento.
         * 
         * @return string|NULL
         */
        public static function MostrarNome() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_peca_nome();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna o texto dos nomes da categoria, marca, modelo, verssão do orçamento.
         * 
         * @return string|NULL
         */
        public static function MostrarCMMV() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_categoria()->get_nome().', '.
                       self::$obj_orcamento->get_marca()->get_nome().', '.
                       self::$obj_orcamento->get_modelo()->get_nome().', '.
                       self::$obj_orcamento->get_versao()->get_nome();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna a lista de peças, se for na pagina Respondidos, vai retornar apenas as peças da entidade autenticada.
         * 
         * @return array
         */
        public static function RetornarPecas() : array
        {
            $pecas =[];
            
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                if (self::$pagina === self::RESPONDIDOS) {
                    foreach (self::$obj_orcamento->get_pecas() as $peca) {
                        if ($peca->get_entidade()->get_id() === Login_Session::get_entidade_id()) {
                            $pecas[] = $peca;
                        }
                    }
                } else {
                    $pecas = self::$obj_orcamento->get_pecas();
                }
            }
            
            return $pecas;
        }
        
        /**
         * Retorna em texto os anos do orçamento.
         * 
         * @return string|NULL
         */
        public static function MostrarAnos() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return 'Ano: de '.self::$obj_orcamento->get_ano_de().' até '.self::$obj_orcamento->get_ano_ate();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna a descrição do orçamento.
         * 
         * @return string|NULL
         */
        public static function MostrarDescricao() : ?string
        {
            if (self::$obj_orcamento instanceof Object_Orcamento) {
                return self::$obj_orcamento->get_descricao();
            } else {
                return null;
            }
        }
        
        /**
         * Retorna uma classe css para desativar o o botão Não Tenho, caso já esteja na pagina Não Tenho.
         * 
         * @return string|NULL
         */
        public static function VerificarDesativarBotao() : ?string
        {
            if (self::$pagina === self::NAO_TENHO) {
                return 'disabled';
            } else {
                return null;
            }
        }
        
        /**
         * Verifica se esta em uma pagina onde a lista de peças deve ser mostrado.
         * 
         * @return bool
         */
        public static function VerificarMostrarListaPecas() : bool
        {
            if (self::$pagina === self::RESPONDIDOS ||
                self::$pagina === self::MEUS_ORCAMENTOS) {
                return true;
            } else {
                return false;
            }
        }
        
        /**
         * Verifica se está em uma pagina onde os botões Sim Tenho e Não Tenho devem ser mostrados.
         * 
         * @return bool
         */
        public static function VerificarMostrarBotoes() : bool
        {
            if (self::$pagina === self::CAIXA_DE_ENTRADA ||
                self::$pagina === self::NAO_TENHO ||
                self::$pagina === self::RESPONDIDOS) {
                return true;
            } else {
                return false;
            }
        }
        
        /**
         * Verifica se está em uma pagina onde o botão 'Eu tenho essa peça' devem ser mostrados.
         *
         * @return bool
         */
        public static function VerificarMostrarBotaoCadastrar() : bool
        {
            if (self::$pagina === self::ORCAMENTOS) {
                return true;
            } else {
                return false;
            }
        }
    }
