<?php
namespace Module\Application\Model\Common\Util;
    
    use Module\Application\Model\DAO\Orcamento as DAO_Orcamento;
    use \SQLite3;
    use \DateTime;
    
    class Entidade_BD extends SQLite3
    {
        /**
         * @const Parametro RetornaContagemPorStatus / RetornaOrcamentosPorStatus
         */
        public const RECEBIDO = 1;
        
        /**
         * @const Parametro RetornaContagemPorStatus / RetornaOrcamentosPorStatus
         */
        public const VISUALIZADO = 2;
        
        /**
         * @const Parametro RetornaContagemPorStatus / RetornaOrcamentosPorStatus
         */
        public const NAO_TENHO = 4;
        
        /**
         * @const Parametro RetornaContagemPorStatus / RetornaOrcamentosPorStatus
         */
        public const RESPONDIDO = 8;
        
        /**
         * Contrutor da Classe, abre o arquivo ou criar se não existe.
         * 
         * @param int $id_entidade
         */
        function __construct(int $id_entidade)
        {
            $this->open(RAIZ."/data/entidade/$id_entidade.db");
            
            //Só cria as tabelas se elas ainda não existirem
            $this->Criar_BaseDados();
        }
        
        /**
         * Destrutor, deve fechar a conexão.
         */
        function __destruct()
        {
            $this->close();
        }
        
        /**
         * Cria uma nova base de dados, com todas as tabelas nescessario.
         * Só pode ser execudado, se a base de dados ainda não existir.
         * 
         * @return bool
         */
        private function Criar_BaseDados() : bool
        {
            if ($this->Criar_Tb_Status()) {
                return $this->Criar_Tb_Orcamento();
            } else {
                return false;
            }
        }
        
        /**
         * Cria a tabela Orçamentos.
         * orcamento_orc_id INT PRIMARY KEY NOT NULL,
         * orcamento_sts_id INT NOT NULL,
         * orcamento_data_solicitacao NUMERIC NOT NULL,
         * orcamento_data_validade NUMERIC NOT NULL);
         * 
         * @return bool
         */
        private function Criar_Tb_Orcamento() : bool
        {
            $sql = 'CREATE TABLE IF NOT EXISTS tb_orcamento (
                    orcamento_orc_id INT PRIMARY KEY NOT NULL,
                    orcamento_sts_id INT NOT NULL,
                    orcamento_data_solicitacao NUMERIC NOT NULL,
                    orcamento_data_validade NUMERIC NOT NULL);';
            
            return $this->exec($sql);
        }
        
        /**
         * Criar a tabela Status.
         * status_id INT PRIMARY KEY NOT NULL,
         * status_descricao TEXT NOT NULL);
         * 
         * @return bool
         */
        private function Criar_Tb_Status() : bool
        {
            $sql = 'CREATE TABLE IF NOT EXISTS tb_status (
                    status_id INT PRIMARY KEY NOT NULL,
                    status_descricao TEXT NOT NULL);';
            
            if ($this->exec($sql)) {
                return $this->Setar_Status_Default();
            } else {
                return false;
            }
        }
        
        /**
         * Seta os valores Default para tabela Status.
         * 1-'Recebido', 2-'Visualizado', 4-'Não Tenho', 8-'Respondido'
         * 
         * @return bool
         */
        private function Setar_Status_Default() : bool
        {
            $sql = "INSERT OR IGNORE INTO tb_status (status_id, status_descricao)
                    VALUES (1, 'Recebido');
                    INSERT OR IGNORE INTO tb_status (status_id, status_descricao)
                    VALUES (2, 'Visualizado');
                    INSERT OR IGNORE INTO tb_status (status_id, status_descricao)
                    VALUES (4, 'Não Tenho');
                    INSERT OR IGNORE INTO tb_status (status_id, status_descricao)
                    VALUES (8, 'Respondido');";
            
            return $this->exec($sql);
        }
        
        /**
         * Deleta todos os orçamentos com validade inferior a data(timestamp) atual(now).
         * 
         * Retorna False em caso de falha e True quando executado com sucesso, ou nenhum elemento precisar ser deletado.
         * @return bool
         */
        private function Deletar_Orcamentos_Expirados() : bool
        {
            $sql = "DELETE FROM tb_orcamento WHERE orcamento_data_validade <= strftime('%s','now');";
            
            return $this->exec($sql);
        }
        
        /**
         * Deleta orçamento pelo id informado por parametro.
         *
         * Retorna False em caso de falha e True quando executado com sucesso, ou nenhum elemento precisar ser deletado.
         * @param int $id_orcamento
         * @return bool
         */
        public function Deletar_Orcamento(int $id_orcamento) : bool
        {
            $sql = "DELETE FROM tb_orcamento WHERE orcamento_orc_id = $id_orcamento;";
            
            return $this->exec($sql);
        }
        
        /**
         * Retorna em TimeStamp a ultima data inserida do ultimo orçamento.
         * 
         * @return string|NULL
         */
        private function Pegar_Ultima_Data_Orcamento() : ?string
        {
            $sql = 'SELECT orcamento_data_solicitacao FROM tb_orcamento ORDER BY orcamento_data_solicitacao DESC LIMIT 1;';
            
            $ret = $this->query($sql);
            
            $data_solicitacao = null;
            
            while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $data_solicitacao = $row['orcamento_data_solicitacao'];
            }
            
            return $data_solicitacao;
        }
        
        /**
         * Deleta todos os orçamentos com validade inferior a data(timestamp) atual(now).
         * Atualiza a base local com todos os novos elementos que foram adicionados depois da ultima data de orçamento_solicitado na base local.
         * 
         * Retorna False em caso de Erro e True quando executado com sucesso, ou nenhum elemento precisar ser atualizado.
         * @return bool
         */
        public function Atualizar_Orcamentos() : bool
        {
            $this->Deletar_Orcamentos_Expirados();
            
            $data_timestamp = $this->Pegar_Ultima_Data_Orcamento();
            $orcamentos = [];
            
            if (empty($data_timestamp)) {
                $orcamentos = DAO_Orcamento::BuscarLiteTodos();
            } else {
                $orcamentos = DAO_Orcamento::BuscarPorData(date('Y-m-d H:i:s', $data_timestamp));
            }
            
            if (!empty($orcamentos)) {
                $sql = 'INSERT OR IGNORE INTO tb_orcamento (orcamento_orc_id, orcamento_sts_id, orcamento_data_solicitacao, orcamento_data_validade) VALUES ';
                
                foreach ($orcamentos as $orcamento) {
                    $data_solicitacao = new DateTime($orcamento->get_datahora_solicitacao());
                    $data_validade = new DateTime($orcamento->get_datahora_validade());
                    
                    $sql .= "(".$orcamento->get_id().", 1, ".$data_solicitacao->getTimestamp().", ".$data_validade->getTimestamp()."),";
                }
                
                $sql = substr($sql, 0, -1).';';
                
                return $this->exec($sql);
            } else {
                return true;
            }
        }
        
        /**
         * Retorna um array de OBJ_Orcamento do status passado por parametro, encontrado na base local SQLite3.
         * 
         * @param int $status const Entidade_BD::RECEBIDO
         * @param int $status const Entidade_BD::VISUALIZADO
         * @param int $status const Entidade_BD::NAO_TENHO
         * @param int $status const Entidade_BD::RESPONDIDO
         * @param int $limit numero do limite
         * @param int $offset numero da pagina
         * @return array|NULL
         */
        public function RetornaOrcamentosPorStatus(int $status, int $indice = 1) : ?array
        {
            $limit = 10;
            $offset = ($indice * $limit) - $limit;
            
            $sql = "SELECT orcamento_orc_id FROM tb_orcamento WHERE orcamento_sts_id = $status GROUP BY orcamento_data_solicitacao ORDER BY orcamento_data_solicitacao DESC LIMIT $limit OFFSET $offset;";
            
            $ret = $this->query($sql);
            
            $orcamentos = [];
            
            while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                if (isset($row['orcamento_orc_id']) && !empty($row['orcamento_orc_id'])) {
                    $orcamento = DAO_Orcamento::BuscarPorCOD($row['orcamento_orc_id']);
                    
                    if (!empty($orcamento) && $orcamento) {
                        $orcamentos[] = $orcamento;
                    } else {
                        $this->Deletar_Orcamento($row['orcamento_orc_id']);
                    }
                }
            }
            
            return $orcamentos;
        }
        
        /**
         * Retorna o Numero de Orçamentos Encontrados na Base Local SQLite3, para o Status passado por Parametro.
         * 
         * @param int $status const Entidade_BD::RECEBIDO
         * @param int $status const Entidade_BD::VISUALIZADO
         * @param int $status const Entidade_BD::NAO_TENHO
         * @param int $status const Entidade_BD::RESPONDIDO
         * @return int Numero de Orçamentos encontrados com o status selecionado.
         */
        public function RetornaContagemPorStatus(int $status) : int
        {
            $sql = "SELECT count(*) FROM tb_orcamento WHERE orcamento_sts_id = $status;";
            
            $ret = $this->query($sql);
            
            $numero = 0;
            
            while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $numero = $row['count(*)'];
            }
            
            return $numero;
        }
        
        /**
         * Seta o Status passado por parametro para o orçamento na base local.
         *
         * @param int $id_orcamento O ID do Orçamento a ser atualizado
         * @param int $status const Entidade_BD::RECEBIDO
         * @param int $status const Entidade_BD::VISUALIZADO
         * @param int $status const Entidade_BD::NAO_TENHO
         * @param int $status const Entidade_BD::RESPONDIDO
         * @return bool Retorna False em caso de Erro e True quando executado com sucesso, ou nenhum elemento precisar ser atualizado.
         */
        public function SetarStatusOrcamento(int $id_orcamento, int $status) : bool
        {
            $sql = "UPDATE tb_orcamento SET orcamento_sts_id = $status WHERE orcamento_orc_id = $id_orcamento;";
            
            return $this->exec($sql);
        }
    }
