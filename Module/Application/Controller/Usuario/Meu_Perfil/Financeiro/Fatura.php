<?php
namespace Module\Application\Controller\Usuario\Meu_Perfil\Financeiro;
    
    use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Fatura as View_Fatura;
    use Module\Application\Controller\Layout\Menu\Usuario as Controller_Usuario;
    use Module\Application\Model\DAO\Fatura as DAO_Fatura;
    use Module\Application\Model\DAO\Fatura_Servico as DAO_Fatura_Servico;
    use Module\Application\Model\DAO\Entidade as DAO_Entidade;
    use Module\Application\Model\DAO\Plano as DAO_Plano;
    use Module\Application\Model\Object\Entidade as Object_Entidade;
    use Module\Application\Model\Object\Fatura as Object_Fatura;
    use Module\Application\Model\Object\Fatura_Servico as Object_Fatura_Servico;
    use Module\Application\Model\Object\Status_Fatura as Object_Status_Fatura;
    use Module\Application\Model\Common\Util\Login_Session;
    use Module\Application\Model\Common\Util\Conexao;
    use \DateTime;
    use \DateInterval;
    use \Exception;
    
    class Fatura
    {

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
                    $view = new View_Fatura($status);
                    
                    $view->Executar();
                }
                
                return $status;
            } else {
                return false;
            }
        }
        
        /**
         * Altera/Salva o plano, function usado no controller Meu-Plano
         * 
         * @param int $plano_id
         * @throws Exception
         * @return bool True para Sucesso e False para Erro
         */
        public static function Alterar_Plano(int $plano_id) : bool
        {
            $fatura_antiga = DAO_Fatura::BuscarPorCodStatus(Login_session::get_entidade_id(), 1);
            $fatura_antiga_sts = true;
            
            Conexao::$conection->beginTransaction();
            
            foreach ($fatura_antiga as $fatura) {
                if (!DAO_Fatura::Atualizar_Status($fatura->get_id(), 8)) {
                    $fatura_antiga_sts = false;
                }
            }
            
            if ($fatura_antiga_sts) {
                $object_fatura = new Object_Fatura();
                $object_fatura->set_id(0);
                $object_fatura->set_entidade_id(Login_Session::get_entidade_id());
                $object_fatura->set_valor_total(DAO_Plano::BuscarValorMensalPorCOD($plano_id));
                
                $datetime = new DateTime();
                $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                $object_fatura->set_data_fechamento($datetime->format('Y-m-d H:i:s'));
                $datetime->add(new DateInterval('P10D'));
                $object_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
                
                $object_status = new Object_Status_Fatura();
                $object_status->set_id(2);
                $object_fatura->set_object_status($object_status);
                
                if (DAO_Fatura::Inserir($object_fatura)) {
                    $object_fatura = new Object_Fatura();
                    
                    $object_fatura->set_id(0);
                    $object_fatura->set_entidade_id(Login_Session::get_entidade_id());
                    $object_fatura->set_valor_total(DAO_Plano::BuscarValorMensalPorCOD($plano_id));
                    
                    $datetime = new DateTime();
                    $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                    $datetime->add(new DateInterval('P30D'));
                    $object_fatura->set_data_fechamento($datetime->format('Y-m-d H:i:s'));
                    $datetime->add(new DateInterval('P10D'));
                    $object_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
                    
                    $object_status = new Object_Status_Fatura();
                    $object_status->set_id(1);
                    $object_fatura->set_object_status($object_status);
                    
                    if (DAO_Fatura::Inserir($object_fatura)) {
                        $object_entidade = new Object_Entidade();
                        $object_entidade->set_id(Login_Session::get_entidade_id());
                        $object_entidade->set_plano_id($plano_id);
                        $object_entidade->set_intervalo_pagamento_id(1);
                        $object_entidade->set_data_contratacao_plano(date('Y-m-d H:i:s'));
                        
                        if (DAO_Entidade::Atualizar_Financeiro($object_entidade)) {
                            Login_Session::set_entidade_plano($plano_id);
                            
                            if (Conexao::$conection->commit()) {
                                
                            } else {
                                throw new Exception('Erro Fatal ao tentar salvar modificações');
                            }
                        } else {
                            if (Conexao::$conection->rollBack()) {
                                throw new Exception('Erro ao tentar Ativar novo plano');
                            } else {
                                throw new Exception('Erro Fatal ao tentar salvar modificações');
                            }
                        }
                    } else {
                        if (Conexao::$conection->rollBack()) {
                            throw new Exception('Erro ao tentar gerar Fatura');
                        } else {
                            throw new Exception('Erro Fatal ao tentar salvar modificações');
                        }
                    }
                } else {
                    if (Conexao::$conection->rollBack()) {
                        throw new Exception('Erro ao tentar fechar Fatura');
                    } else {
                        throw new Exception('Erro Fatal ao tentar salvar modificações');
                    }
                }
            } else {
                if (Conexao::$conection->rollBack()) {
                    throw new Exception('Erro ao tentar Cancelar fatura antiga');
                } else {
                    throw new Exception('Erro Fatal ao tentar salvar modificações');
                }
            }
            
            return true;
        }
        
        /**
         * Criar a primeira fatura padrão
         * Function chamada no Controller Concluir Cadastro
         * 
         * @throws Exception
         * @return bool True para Sucesso e False para Erro
         */
        public static function Criar_Primeira_Fatura() : bool
        {
            $object_fatura = new Object_Fatura();
            
            $object_fatura->set_id(0);
            $object_fatura->set_entidade_id(Login_Session::get_entidade_id());
            $object_fatura->set_valor_total(DAO_Plano::BuscarValorMensalPorCOD(1));
            
            $datetime = new DateTime();
            $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
            $datetime->add(new DateInterval('P30D'));
            $object_fatura->set_data_fechamento($datetime->format('Y-m-d H:i:s'));
            $datetime->add(new DateInterval('P10D'));
            $object_fatura->set_data_vencimento($datetime->format('Y-m-d H:i:s'));
            
            $object_status = new Object_Status_Fatura();
            $object_status->set_id(1);
            $object_fatura->set_object_status($object_status);
            
            if (DAO_Fatura::Inserir($object_fatura)) {
                return true;
            } else {
                throw new Exception('Erro ao tentar gerar Fatura');
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
         * @return bool True para Sucesso e False para Erro
         */
        public static function Criar_Fatura(int $id_entidade, int $id_plano) : bool
        {
            if (self::Cancelar_Fatura_Aberta($id_entidade)) {
                $object_fatura = new Object_Fatura();
                
                $object_fatura->set_id(0);
                $object_fatura->set_entidade_id($id_entidade);
                $object_fatura->set_valor_total(0);
                
                $datetime = new DateTime();
                $object_fatura->set_data_emissao($datetime->format('Y-m-d H:i:s'));
                
                if (Login_Session::get_entidade_plano() === $id_plano) {
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
                        return self::Adicionar_Serviço_Fatura($id_entidade, 'Plano mensal: '.$object_plano->get_descricao(), $object_plano->get_valor_mensal());
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
         * @param int $valor
         * @param ?int $id_fatura
         * @return bool True para Sucesso e False para Erro
         */
        public static function Adicionar_Serviço_Fatura(int $id_entidade, string $descricao, int $valor) : bool
        {
            $object_fatura = self::Retornar_Fatura_Aberta($id_entidade);
            
            if (empty($object_fatura)) {
                return false;
            }
            
            $object_fatura_servico = new Object_Fatura_Servico();
            
            $object_fatura_servico->set_descricao($descricao);
            $object_fatura_servico->set_fatura_id($object_fatura->get_id());
            $object_fatura_servico->set_valor($valor);
            
            if (DAO_Fatura_Servico::Inserir($object_fatura_servico)) {
                return self::Recalcular_Valor_Total($object_fatura->get_id());
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
         * @return bool True para Sucesso e False para Erro
         */
        public static function Fechar_Fatura(int $id_entidade, int $id_plano) : bool
        {
            $object_fatura = self::Retornar_Fatura_Aberta($id_entidade);
            
            if (empty($object_fatura)) {
                return false;
            }
            
            if (self::Recalcular_Valor_Total($object_fatura->get_id())) {
                if (DAO_Fatura::Atualizar_Status($object_fatura->get_id(), 2)) {
                    return self::Criar_Fatura($id_entidade, $id_plano);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        /**
         * Recalcula o valor total da fatura analizando todos os serviços
         * 
         * @param int $id_fatura
         * @return bool True para Sucesso e False para Erro
         */
        public static function Recalcular_Valor_Total(int $id_fatura) : bool
        {
            $fatura_servicos = DAO_Fatura_Servico::BuscarPorCOD($id_fatura);
            
            $valor_total = 0;
            
            foreach ($fatura_servicos as $fatura_servico) {
                $valor_total += $fatura_servico->get_valor_total();
            }
            
            return DAO_Fatura::Atualizar_Valor_Total($id_fatura, $valor_total);
        }
        
        /**
         * Procura pelas faturas abertas, se achar mais de uma, retorna null
         * Não podem exister mais de uma fatura em aberto ao mesmo tempo
         * Não podem existem mais de uma fatura fechada ao mesmo tempo
         * 
         * @param int $id_entidade
         * @return Object_Fatura|NULL
         */
        private static function Retornar_Fatura_Aberta(int $id_entidade) : ?Object_Fatura
        {
            $object_fatura = null;
            
            $faturas = DAO_Fatura::BuscarPorCodStatus($id_entidade, 1);
            
            if (count($faturas) === 1) {
                foreach ($faturas as $fatura) {
                    $object_fatura = $fatura->get_id();
                }
            }
            
            return $object_fatura;
        }
    }
