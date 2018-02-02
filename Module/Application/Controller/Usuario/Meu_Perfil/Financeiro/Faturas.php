<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Faturas as View_Faturas;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\Object\Fatura as Object_Fatura;
    use Module\Application\Model\Object\Fatura_Servico as Object_Fatura_Servico;
    use Module\Application\Model\Object\Status_Fatura as Object_Status_Fatura;
    use Module\Application\Model\Common\Util\Login_Session;
    use \DateTime;
    use \DateInterval;
                    
    class Faturas
    {
        /**
         * @const Parametro Cobrança
         */
        public const IMEDIATA = 3;
        
        /**
         * @const Parametro Cobrança
         */
        public const MENSAL = 6;
        
        function __construct()
        {
            
        }
        
        /**
         * Instancia e Abre a View
         * 
         * @return number|NULL|boolean
         */
        public function Carregar_Pagina()
        {
            if (Controller_Usuario::Verificar_Autenticacao()) {
                $status = Controller_Usuario::Verificar_Status_Usuario();
                
                if ($status != 0) {
                    $view = new View_Faturas($status);
                    
                    $fatura_aberta = self::Retornar_Fatura(Login_Session::get_entidade_id(), 1);
                    
                    if (!empty($fatura_aberta)) {
                        $view->set_fatura_aberta($fatura_aberta);
                        
                        $fatura_servicos_aberta = DAO_Fatura_Servico::BuscarPorCOD($fatura_aberta->get_id());
                        
                        if (!empty($fatura_servicos_aberta) AND $fatura_servicos_aberta != false) {
                            $view->set_fatura_servicos_aberta($fatura_servicos_aberta);
                        }
                    }
                    
                    $fatura_fechada = self::Retornar_Fatura(Login_Session::get_entidade_id(), 16);
                    
                    if (empty($fatura_fechada)) {
                        $fatura_fechada = self::Retornar_Fatura(Login_Session::get_entidade_id(), 32);
                        
                        if (empty($fatura_fechada)) {
                            $fatura_fechada = self::Retornar_Fatura(Login_Session::get_entidade_id(), 2);
                        }
                    }
                    
                    if (!empty($fatura_fechada)) {
                        $view->set_fatura_fechada($fatura_fechada);
                        
                        $fatura_servicos_fechada = DAO_Fatura_Servico::BuscarPorCOD($fatura_fechada->get_id());
                        
                        if (!empty($fatura_servicos_fechada) AND $fatura_servicos_fechada != false) {
                            $view->set_fatura_servicos_fechada($fatura_servicos_fechada);
                        }
                    }
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Cancela todas as faturas abertas dessa Entidade
         * 
         * @param int $id_entidade
         * @return bool True para Sucesso e False para Erro
         */
        private static function Cancelar_Fatura_Aberta(int $id_entidade) : bool
        {
            $fatura_antiga = DAO_Fatura::BuscarPorCodStatus($id_entidade, 1);
            $fatura_antiga_sts = true;
            
            foreach ($fatura_antiga as $fatura) {
                if (!DAO_Fatura::Atualizar_Status($fatura->get_id(), 8)) {
                    $fatura_antiga_sts = false;
                }
            }
            
            return $fatura_antiga_sts;
        }
        
        /**
         * Abre uma nova fatura para essa Entidade
         * 
         * @param int $id_entidade
         * @param int $id_plano
         * @param int $cobrança @const Parametro Cobrança
         * @return bool True para Sucesso e False para Erro
         */
        public static function Criar_Fatura(int $id_entidade, int $id_plano, ?int $cobrança = null) : bool
        {
            if (self::Cancelar_Fatura_Aberta($id_entidade)) {
                if ($id_plano === 1) {
                    $cobrança = null;
                }
                
                $object_fatura = new Object_Fatura();
                
                $object_fatura->set_id(0);
                $object_fatura->set_entidade_id($id_entidade);
                $object_fatura->set_valor_total(0);
                
                $datetime = new DateTime();
                $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                
                if ($cobrança !== self::IMEDIATA) {
                    $datetime->add(new DateInterval('P30D'));
                }
                
                $object_fatura->set_data_fechamento($datetime->format('Y-m-d H:i:s'));
                $datetime->add(new DateInterval('P10D'));
                $object_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
                
                $object_status = new Object_Status_Fatura();
                $object_status->set_id(1);
                $object_fatura->set_object_status($object_status);
                
                if (DAO_Fatura::Inserir($object_fatura)) {
                    $object_plano = DAO_Plano::BuscarPorCOD($id_plano);
                    
                    if (!empty($object_plano)) {
                        if (self::Adicionar_Serviço_Fatura($id_entidade, 'Plano mensal: '.$object_plano->get_descricao(), $object_plano->get_valor_mensal())) {
                            if ($cobrança === self::IMEDIATA) {
                                return self::Fechar_Fatura($id_entidade, $id_plano);
                            } else {
                                return true;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Cria um novo serviço dentro da fatura aberta da Entidade, e recalcula o valor total da fatura
         * 
         * @param int $id_entidade
         * @param string $descricao
         * @param float $valor
         * @param ?Object_Fatura $object_fatura = null
         * @return bool True para Sucesso e False para Erro
         */
        public static function Adicionar_Serviço_Fatura(int $id_entidade, string $descricao, float $valor, ?Object_Fatura $object_fatura = null) : bool
        {
            if (empty($object_fatura)) {
                $object_fatura = self::Retornar_Fatura($id_entidade, 1);
            }
            
            if (empty($object_fatura)) {
                return false;
            }
            
            $object_fatura_servico = new Object_Fatura_Servico();
            
            $object_fatura_servico->set_descricao($descricao);
            $object_fatura_servico->set_fatura_id($object_fatura->get_id());
            $object_fatura_servico->set_valor($valor);
            
            if (DAO_Fatura_Servico::Inserir($object_fatura_servico)) {
                if (self::Recalcular_Valor_Total($object_fatura->get_id()) !== null) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Recalcula o valor total da fatura analizando todos os serviços
         * Seta o status da fatura como Fechado
         * Abri uma nova fatura identica
         * 
         * @param int $id_entidade
         * @param int $id_plano
         * @param ?Object_Fatura $object_fatura = null
         * @return bool True para Sucesso e False para Erro
         */
        public static function Fechar_Fatura(int $id_entidade, int $id_plano, ?Object_Fatura $object_fatura = null) : bool
        {
            if (empty($object_fatura)) {
                $object_fatura = self::Retornar_Fatura($id_entidade, 1);
            }
            
            if (empty($object_fatura)) {
                return false;
            }
            
            $valor_total = self::Recalcular_Valor_Total($object_fatura->get_id());
            
            if ($valor_total !== null) {
                if ($valor_total === 0) {
                    if (!DAO_Fatura::Atualizar_Status($object_fatura->get_id(), 4)) {
                        return false;
                    }
                } else {
                    if (!DAO_Fatura::Atualizar_Status($object_fatura->get_id(), 2)) {
                        return false;
                    }
                }
                
                return self::Criar_Fatura($id_entidade, $id_plano);
            } else {
                return false;
            }
        }
        
        /**
         * Recalcula o valor total da fatura analizando todos os serviços
         * 
         * @param int $id_fatura
         * @return ?float Valor Total para Sucesso e Null para Erro
         */
        public static function Recalcular_Valor_Total(int $id_fatura) : ?float
        {
            $fatura_servicos = DAO_Fatura_Servico::BuscarPorCOD($id_fatura);
            
            $valor_total = 0;
            
            foreach ($fatura_servicos as $fatura_servico) {
                $valor_total += $fatura_servico->get_valor();
            }
            
            if (DAO_Fatura::Atualizar_Valor_Total($id_fatura, $valor_total)) {
                return $valor_total;
            } else {
                return null;
            }
        }
        
        /**
         * Procura pelas faturas abertas, se achar mais de uma, retorna null
         * Não podem exister mais de uma fatura em aberto ao mesmo tempo
         * Não podem existem mais de uma fatura fechada ao mesmo tempo
         * 
         * @param int $id_entidade
         * @return Object_Fatura|NULL
         */
        private static function Retornar_Fatura(int $id_entidade, int $status) : ?Object_Fatura
        {
            $object_fatura = null;
            
            $faturas = DAO_Fatura::BuscarPorCodStatus($id_entidade, $status);
            
            if (count($faturas) === 1) {
                foreach ($faturas as $fatura) {
                    $object_fatura = $fatura;
                }
            }
            
            return $object_fatura;
        }
        
        /**
         * Function que deve ser chamada pelo Cron do linux e executada uma vez por dia durante a madrugada
         */
        public static function Gerenciar_Todas_Faturas_Abertas() : void
        {
            $faturas = DAO_Fatura::BuscarPorStatusDataFechamento(1, date('Y-m-d H:i:s'));
            
            foreach ($faturas as $fatura) {
                $id_plano = DAO_Entidade::Pegar_Plano_Id($fatura->get_entidade_id());
                
                if (!empty($id_plano) AND $id_plano != false) {
                    self::Fechar_Fatura($fatura->get_entidade_id(), $id_plano, $fatura);
                }
            }
        }
        
        /**
         * Function que deve ser chamada pelo Cron do linux e executada uma vez por dia durante a madrugada.
         * 
         * Quando o valor da fatura for fechado com menos de 5 reais e o usuário não realizar o pagamento.
         * Em vez de bloquear a conta, adicionar esse valor na nova fatura.
         */
        public static function Gerenciar_Todas_Faturas_Fechadas() : void
        {
            $faturas = DAO_Fatura::BuscarPorStatusDataVencimento(2, date('Y-m-d H:i:s'));
            
            foreach ($faturas as $fatura) {
                if ($fatura->get_valor_total() > 5) {
                    self::Cancelar_Fatura_Aberta($fatura->get_entidade_id());
                    
                    DAO_Fatura::Atualizar_Status($fatura->get_id(), 32);
                    
                    DAO_Entidade::Atualizar_Status($fatura->get_entidade_id(), 2);
                } else {
                    $id_plano = DAO_Entidade::Pegar_Plano_Id($fatura->get_entidade_id());
                    
                    if (!empty($id_plano) AND $id_plano != false) {
                        DAO_Fatura::Atualizar_Status($fatura->get_id(), 4);
                        
                        self::Criar_Fatura($fatura->get_entidade_id(), $id_plano);
                        
                        self::Adicionar_Serviço_Fatura($fatura->get_entidade_id(), 'Valor da fatura antiga, por pagamento atrasado', $fatura->get_valor_total());
                    }
                }
            }
        }
    }
