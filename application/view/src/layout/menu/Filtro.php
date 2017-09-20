<?php
namespace application\view\src\layout\menu;
	
    use application\controller\layout\menu\Filtro as Controller_Filtro;
    
	class Filtro {
		
		function __construct(?array $form_filtro = null) {
			self::$form_filtro = $form_filtro;
	    	
	        require_once RAIZ.'/application/view/html/layout/menu/Filtro.php';
		}
		
		private static $form_filtro;
		
		public static function Mostrar_Estados() : void {
			$estados = Controller_Filtro::Buscar_Estados();
		
			foreach ($estados as $estado) {
				if (isset(self::$form_filtro['estado']) AND self::$form_filtro['estado'] == $estado->get_id()) {
					echo "<option selected data-url=\"".strtolower($estado->get_uf())."\" value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</option>";
				} else {
					echo "<option data-url=\"".strtolower($estado->get_uf())."\" value=\"".$estado->get_id()."\">".$estado->get_uf()." - ".$estado->get_nome()."</option>";
				}
			}
		}
		
		public static function Mostrar_Cidades(?int $estado = null) : void {
			$cidades = array();
			 
			if (!empty($estado)) {
				$cidades = Controller_Filtro::Buscar_Cidade_Por_Estado($estado);
			} else if (isset(self::$form_filtro['estado'])) {
				if (!empty(self::$form_filtro['estado'])) {
					$cidades = Controller_Filtro::Buscar_Cidade_Por_Estado(self::$form_filtro['estado']);
				}
			}
		
			echo "<option value=\"0\">Selecione a Cidade</option>";
				
			foreach ($cidades as $cidade) {
				if (isset(self::$form_filtro['cidade']) AND self::$form_filtro['cidade'] == $cidade->get_id()) {
					echo "<option selected data-url=\"".$cidade->get_url()."\" value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</option>";
				} else {
					echo "<option data-url=\"".$cidade->get_url()."\" value=\"".$cidade->get_id()."\">".$cidade->get_nome()."</option>";
				}
			}
		}
		
		public static function Mostrar_Estado_Uso() : void {
			$estado_uso_pecas = Controller_Filtro::Buscar_Estado_Uso_Pecas();
				
			foreach ($estado_uso_pecas as $estado_uso_peca) {
				if (isset(self::$form_filtro['estado_uso']) AND self::$form_filtro['estado_uso'] == $estado_uso_peca->get_id()) {
					echo "<option selected value=\"".$estado_uso_peca->get_url()."\">".$estado_uso_peca->get_nome()."</option>";
				} else {
					echo "<option value=\"".$estado_uso_peca->get_url()."\">".$estado_uso_peca->get_nome()."</option>";
				}
			}
		}
		
		public static function Mostrar_Preferencia_Entrega() : void {
			$preferencias_entrega = Controller_Filtro::Buscar_Preferencia_Entrega();
			
			foreach ($preferencias_entrega as $preferencia_entrega) {
				if (isset(self::$form_filtro['preferencia_entrega']) AND self::$form_filtro['preferencia_entrega'] == $preferencia_entrega->get_id()) {
					echo "<option selected value=\"".$preferencia_entrega->get_url()."\">".$preferencia_entrega->get_nome()."</option>";
				} else {
					echo "<option value=\"".$preferencia_entrega->get_url()."\">".$preferencia_entrega->get_nome()."</option>";
				}
			}
		}
		
		public static function Mostrar_Status_Peca() : void {
		    $status_pecas = Controller_Filtro::Buscar_Status_Peca();
		    
		    foreach ($status_pecas as $status_peca) {
		        if (isset(self::$form_filtro['status_peca']) AND self::$form_filtro['status_peca'] == $status_peca->get_id()) {
		            echo "<option selected value=\"".$status_peca->get_url()."\">".$status_peca->get_nome()."</option>";
		        } else {
		            echo "<option value=\"".$status_peca->get_url()."\">".$status_peca->get_nome()."</option>";
		        }
		    }
		}
		
		public static function Manter_Valor(string $ordem, string $campo) : void {
			switch ($ordem) {
				case 'ordem_preco':
					if (isset(self::$form_filtro['ordem_preco']) AND self::$form_filtro['ordem_preco'] == $campo) {
						echo 'checked="checked"';
					}
					break;
					
				case 'ordem_data':
					if (isset(self::$form_filtro['ordem_data']) AND self::$form_filtro['ordem_data'] == $campo) {
						echo 'checked="checked"';
					}
					break;
			}
		}
		
		public static function Verificar_Login() : bool {
		    return Controller_Filtro::Verificar_Login();
		}
		
		public static function Mostrar_Data_Dia() : void {
			for ($i = 1; $i <= 31; $i++) {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		
		public static function Mostrar_Data_Mes() : void {
			for ($i = 1; $i <= 12; $i++) {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		
		public static function Mostrar_Data_Ano() : void {
			for ($i = 2016; $i <= 2017; $i++) {
				echo "<option value=\"$i\">$i</option>";
			}
		}
	}
?>