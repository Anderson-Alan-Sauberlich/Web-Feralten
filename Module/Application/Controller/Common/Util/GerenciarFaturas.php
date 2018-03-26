<?php
namespace Module\Application\Controller\Common\Util;
    
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\OBJ\Fatura as OBJ_Fatura;
    use Module\Application\Model\OBJ\Fatura_Servico as OBJ_Fatura_Servico;
    use Module\Application\Model\OBJ\Status_Fatura as OBJ_Status_Fatura;
    use \DateTime;
    use \DateInterval;
    
    class GerenciarFaturas
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
         * @var array $erros Array com todas as mensagens de erro
         */
        private $erros = [];
        
        /**
         * @var array $sucesso Array com todos as Mensagens de Sucesso
         */
        private $sucessos = [];
        
        /**
         * @var array $campos Array com todos os Status dos Campos do Formulario
         */
        private $campos = [];
        
        /**
         * Cancela todas as faturas abertas dessa Entidade
         * 
         * @param int $id_entidade
         * @return bool True para Sucesso e False para Erro
         */
        public static function Cancelar_Fatura_Aberta(int $id_entidade) : bool
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
                
                $obj_fatura = new OBJ_Fatura();
                
                $obj_fatura->set_id(0);
                $obj_fatura->set_entidade_id($id_entidade);
                $obj_fatura->set_valor_total(0);
                
                $datetime = new DateTime();
                $obj_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                
                if ($cobrança !== self::IMEDIATA) {
                    $datetime->add(new DateInterval('P30D'));
                }
                
                $obj_fatura->set_data_fechamento($datetime->format('Y-m-d H:i:s'));
                $datetime->add(new DateInterval('P10D'));
                $obj_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
                
                $obj_status = new OBJ_Status_Fatura();
                $obj_status->set_id(1);
                $obj_fatura->set_obj_status($obj_status);
                
                if (DAO_Fatura::Inserir($obj_fatura)) {
                    $obj_plano = DAO_Plano::BuscarPorCOD($id_plano);
                    
                    if (!empty($obj_plano)) {
                        if (self::Adicionar_Serviço_Fatura($id_entidade, 'Plano mensal: '.$obj_plano->get_descricao(), $obj_plano->get_valor_mensal())) {
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
         * @param ?OBJ_Fatura $obj_fatura = null
         * @return bool True para Sucesso e False para Erro
         */
        public static function Adicionar_Serviço_Fatura(int $id_entidade, string $descricao, float $valor, ?OBJ_Fatura $obj_fatura = null) : bool
        {
            if (empty($obj_fatura)) {
                $obj_fatura = self::Retornar_Fatura($id_entidade, 1);
            }
            
            if (empty($obj_fatura)) {
                return false;
            }
            
            $obj_fatura_servico = new OBJ_Fatura_Servico();
            
            $obj_fatura_servico->set_descricao($descricao);
            $obj_fatura_servico->set_fatura_id($obj_fatura->get_id());
            $obj_fatura_servico->set_valor($valor);
            
            if (DAO_Fatura_Servico::Inserir($obj_fatura_servico)) {
                if (self::Recalcular_Valor_Total($obj_fatura->get_id()) !== null) {
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
         * @param ?OBJ_Fatura $obj_fatura = null
         * @return bool True para Sucesso e False para Erro
         */
        public static function Fechar_Fatura(int $id_entidade, int $id_plano, ?OBJ_Fatura $obj_fatura = null) : bool
        {
            if (empty($obj_fatura)) {
                $obj_fatura = self::Retornar_Fatura($id_entidade, 1);
            }
            
            if (empty($obj_fatura)) {
                return false;
            }
            
            $valor_total = self::Recalcular_Valor_Total($obj_fatura->get_id());
            
            if ($valor_total !== null) {
                if ($valor_total === 0) {
                    if (!DAO_Fatura::Atualizar_Status($obj_fatura->get_id(), 4)) {
                        return false;
                    }
                } else {
                    if (!DAO_Fatura::Atualizar_Status($obj_fatura->get_id(), 2)) {
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
         * @return OBJ_Fatura|NULL
         */
        public static function Retornar_Fatura(int $id_entidade, int $status) : ?OBJ_Fatura
        {
            $obj_fatura = null;
            
            $faturas = DAO_Fatura::BuscarPorCodStatus($id_entidade, $status);
            
            if (count($faturas) === 1) {
                foreach ($faturas as $fatura) {
                    $obj_fatura = $fatura;
                }
            }
            
            return $obj_fatura;
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
