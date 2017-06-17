<?php
namespace application\model\dao;
	
    use application\model\object\Marca_Pativel as Object_Marca_Pativel;
    use application\model\object\Peca as Object_Peca;
    use application\model\dao\Peca as DAO_Peca;
    use application\model\common\util\Conexao;
    use \PDO;
    use \PDOException;
    use \Exception;
    use \PDOStatement;
	
    class Marca_Pativel {
        
        function __construct() {
            
        }
        
        public static function Inserir(Object_Marca_Pativel $object_marca_pativel) : bool {
            try {
                $sql = "INSERT INTO tb_marca_pativel (marca_pativel_pec_id, marca_pativel_mrc_id, marca_pativel_ano_id) 
                        VALUES (:pec_id, :mrc_id, :ano_id);";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
				
                $p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
				$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
				
				$proximo_id_ano = null;
				
				if (empty($object_marca_pativel->get_anos())) {
					$p_sql->bindValue(":ano_id", null, PDO::PARAM_INT);
				} else {
					if (empty($object_marca_pativel->get_ano_id())) {
						$proximo_id_ano = self::Pegar_Proximo_Id_Ano();
					} else {
						$proximo_id_ano = $object_marca_pativel->get_ano_id();
					}
					
					$p_sql->bindValue(":ano_id", $proximo_id_ano, PDO::PARAM_INT);
				}
				
                if ($p_sql->execute()) {
                	$anos = $object_marca_pativel->get_anos();
                	
                	if (!empty($anos) AND !empty($proximo_id_ano)) {
	                	foreach ($anos as $ano) {
	                		$sql = "INSERT INTO tb_marca_pativel_ano (marca_pativel_ano_id, marca_pativel_ano_ano)
		                        	VALUES (:ano_id, :ano);";
	                		
	                		$p_sql = Conexao::Conectar()->prepare($sql);
	                		
	                		$p_sql->bindValue(":ano_id", $proximo_id_ano, PDO::PARAM_INT);
	                		$p_sql->bindValue(":ano", $ano, PDO::PARAM_INT);
	                		
	                		$p_sql->execute();
	                	}
	                	
	                	return true;
                	} else {
                		return true;
                	}
                } else {
                	return false;
                }
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Atualizar(Object_Marca_Pativel $object_marca_pativel) : bool {
        	try {
        		if (empty($object_marca_pativel->get_ano_id())) {
        			$object_marca_pativel->set_ano_id(self::Pegar_Id_Ano($object_marca_pativel->get_peca_id(),
        																 $object_marca_pativel->get_marca_id()));
        		}
        		
        		if (self::Deletar($object_marca_pativel)) {
        			if (self::Inserir($object_marca_pativel)) {
        				return true;
        			} else {
        				return false;
        			}
        		} else {
        			return false;
        		}
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Deletar(Object_Marca_Pativel $object_marca_pativel) : bool {
        	try {
        		if (!empty($object_marca_pativel->get_ano_id())) {
        			self::Deletar_Anos($object_marca_pativel->get_ano_id());
        		}
        		
        		$sql = "DELETE FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id AND marca_pativel_mrc_id = :mrc_id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
        		$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
        		
        		return $p_sql->execute();
        	} catch (Exception $e) {
        		return false;
        	}
        }
        
        public static function Deletar_Anos(int $ano_id) : bool {
            try {
                $sql = "DELETE FROM tb_marca_pativel_ano WHERE marca_pativel_ano_id = :ano_id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                
                $p_sql->bindValue(":ano_id", $ano_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (Exception $e) {
				return false;
            }
        }
        
        private static function Pegar_Proximo_Id_Ano() : ?int {
        	try {
        		$sql = "SELECT fc_achar_id_livre_ano_marca()";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql->execute();
        		
        		return $p_sql->fetch(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return null;
        	}
        }
        
        public static function Pegar_Id_Ano(int $peca_id, int $marca_id) : ?int {
        	try {
        		$sql = "SELECT marca_pativel_ano_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :pec_id AND marca_pativel_mrc_id = :mrc_id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":pec_id", $peca_id, PDO::PARAM_INT);
        		$p_sql->bindValue(":mrc_id", $marca_id, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		$id_ano = $p_sql->fetch(PDO::FETCH_COLUMN);
        		
        		if (!empty($id_ano) AND $id_ano != false) {
        			return $id_ano;
        		} else {
        			return null;
        		}
        	} catch (PDOException | Exception $e) {
        		return null;
        	}
        }
        
        public static function BuscarPorCOD(int $id) {
            try {
                $sql = "SELECT marca_pativel_pec_id, marca_pativel_mrc_id, marca_pativel_ano_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :id";
                
                $p_sql = Conexao::Conectar()->prepare($sql);
                $p_sql->bindValue(":id", $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::Popula_Marca_Pativeis($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
				return false;
            }
        }
        
        public static function Buscar_Id_Por_Id_Peca(int $id_peca) {
        	try {
        		$sql = "SELECT marca_pativel_mrc_id FROM tb_marca_pativel WHERE marca_pativel_pec_id = :id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id_peca, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return $p_sql->fetchAll(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Ano_Por_Id_Ano(int $id_ano) {
        	try {
        		$sql = "SELECT marca_pativel_ano_ano FROM tb_marca_pativel_ano WHERE marca_pativel_ano_id = :id";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		$p_sql->bindValue(":id", $id_ano, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return $p_sql->fetchAll(PDO::FETCH_COLUMN);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Numero_Paginas(Object_Marca_Pativel $object_marca_pativel, Object_Peca $object_peca, array $form_filtro) {
        	try {
        		$pesquisa = "";
        		
        		$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_marca_pativel);
        		
        		$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca, $form_filtro);
        		
        		if (!empty($pesquisa)) {
        			if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
        				$pesquisa = "WHERE $pesquisa";
        			}
        		}
        		
        		$sql = "SELECT peca_id FROM vw_marca_peca $pesquisa";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca, $form_filtro);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_marca_pativel);
        		
        		$p_sql->execute();
        		$select = $p_sql->fetchAll();
        		$cont = count($select);
        		
        		return ceil($cont / 9);
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Buscar_Pecas(Object_Marca_Pativel $object_marca_pativel, Object_Peca $object_peca, array $form_filtro, int $pg) {
        	$limite = 9;
        	$inicio = ($pg * $limite) - $limite;
        	$pesquisa = "";
        	
        	$pesquisa = self::Criar_String_Pesquisa($pesquisa, $object_marca_pativel);
        	
        	$pesquisa = DAO_Peca::Criar_String_Pesquisa($pesquisa, $object_peca, $form_filtro);
        	
        	if (!empty($pesquisa)) {
        		if (current(str_word_count($pesquisa, 2)) != 'ORDER') {
        			$pesquisa = "WHERE $pesquisa";
        		}
        	}
        	
        	try {
        		$sql = "SELECT peca_id, peca_ent_id, peca_end_id, peca_sts_pec_id, peca_nome, peca_fabricante, peca_preco, peca_descricao, peca_data_anuncio, peca_numero_serie, peca_prioridade
        		FROM vw_marca_peca $pesquisa LIMIT :inicio, :limite";
        		
        		$p_sql = Conexao::Conectar()->prepare($sql);
        		
        		$p_sql = DAO_Peca::Bind_String_Pesquisa($p_sql, $object_peca, $form_filtro);
        		
        		$p_sql = self::Bind_String_Pesquisa($p_sql, $object_marca_pativel);
        		
        		$p_sql->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        		$p_sql->bindValue(":limite", $limite, PDO::PARAM_INT);
        		$p_sql->execute();
        		
        		return DAO_Peca::PopulaPecas($p_sql->fetchAll(PDO::FETCH_ASSOC));
        	} catch (PDOException | Exception $e) {
        		return false;
        	}
        }
        
        public static function Criar_String_Pesquisa(string $pesquisa, Object_Marca_Pativel $object_marca_pativel) : string {
        	if (!empty($object_marca_pativel->get_peca_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "marca_pativel_pec_id = :pec_id";
        	}
        	
        	if (!empty($object_marca_pativel->get_marca_id())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND ";
        		}
        		$pesquisa .= "marca_pativel_mrc_id = :mrc_id";
        	}
        	
        	if (!empty($object_marca_pativel->get_ano_de()) OR !empty($object_marca_pativel->get_ano_ate())) {
        		if (!empty($pesquisa)) {
        			$pesquisa .= " AND (";
        		}
        		
        		$pesquisa_ano = "";
        		
	        	if (!empty($object_marca_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "marca_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_marca_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "marca_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "marca_pativel_ano_id IN (SELECT marca_pativel_ano_id FROM tb_marca_pativel_ano WHERE $pesquisa_ano)";
	        	
	        	if (!empty($pesquisa)) {
	        		$pesquisa .= " OR ";
	        	}
	        	
	        	$pesquisa_ano = "";
	        	
	        	if (!empty($object_marca_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "modelo_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_marca_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "modelo_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "modelo_pativel_ano_id IN (SELECT modelo_pativel_ano_id FROM tb_modelo_pativel_ano WHERE $pesquisa_ano)";
	        	
	        	if (!empty($pesquisa)) {
	        		$pesquisa .= " OR ";
	        	}
	        	
	        	$pesquisa_ano = "";
	        	
	        	if (!empty($object_marca_pativel->get_ano_de())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano >= :ano_de";
	        	}
	        	
	        	if (!empty($object_marca_pativel->get_ano_ate())) {
	        		if (!empty($pesquisa_ano)) {
	        			$pesquisa_ano .= " AND ";
	        		}
	        		$pesquisa_ano .= "versao_pativel_ano_ano <= :ano_ate";
	        	}
	        	
	        	$pesquisa .= "versao_pativel_ano_id IN (SELECT versao_pativel_ano_id FROM tb_versao_pativel_ano WHERE $pesquisa_ano))";
        	}
        	
        	return $pesquisa;
        }
        
        public static function Bind_String_Pesquisa(PDOStatement $p_sql, Object_Marca_Pativel $object_marca_pativel) : PDOStatement {
        	if (!empty($object_marca_pativel->get_peca_id())) {
        		$p_sql->bindValue(":pec_id", $object_marca_pativel->get_peca_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_marca_pativel->get_marca_id())) {
        		$p_sql->bindValue(":mrc_id", $object_marca_pativel->get_marca_id(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_marca_pativel->get_ano_de())) {
        		$p_sql->bindValue(":ano_de", $object_marca_pativel->get_ano_de(), PDO::PARAM_INT);
        	}
        	
        	if (!empty($object_marca_pativel->get_ano_ate())) {
        		$p_sql->bindValue(":ano_ate", $object_marca_pativel->get_ano_ate(), PDO::PARAM_INT);
        	}
        	
        	return $p_sql;
        }
        
        
        public static function Popula_Marca_Pativeis(array $rows) : array {
        	$pativeis = array();
			
			foreach ($rows as $row) {
	            $object_marca_pativel = new Object_Marca_Pativel();
				
	            if (isset($row['marca_pativel_pec_id'])) {
	            	$object_marca_pativel->set_peca_id($row['marca_pativel_pec_id']);
	            }
	            
	            if (isset($row['marca_pativel_mrc_id'])) {
	            	$object_marca_pativel->set_marca_id($row['marca_pativel_mrc_id']);
	            }
	            
	            if (isset($row['marca_pativel_ano_id'])) {
	            	$object_marca_pativel->set_ano_id($row['marca_pativel_ano_id']);
	            }
	            
				$pativeis[] = $object_marca_pativel;
			}
            
            return $pativeis;
        }
    }
?>