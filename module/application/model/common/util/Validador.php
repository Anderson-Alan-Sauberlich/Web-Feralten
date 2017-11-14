<?php
namespace module\application\model\common\util;
	
	use module\application\model\validador\Acesso_Usuario;
	use module\application\model\validador\Adicionado;
	use module\application\model\validador\Categoria;
	use module\application\model\validador\Categoria_Compativel;
	use module\application\model\validador\Categoria_Pativel;
	use module\application\model\validador\Cidade;
	use module\application\model\validador\Contato_Anunciante;
	use module\application\model\validador\Contato;
	use module\application\model\validador\Endereco;
	use module\application\model\validador\Entidade;
	use module\application\model\validador\Estado;
	use module\application\model\validador\Fatura_Servico;
	use module\application\model\validador\Fatura;
	use module\application\model\validador\Foto_Peca;
	use module\application\model\validador\Funcionalidade;
	use module\application\model\validador\Intervalo_Pagamento;
	use module\application\model\validador\Marca;
	use module\application\model\validador\Marca_Compativel;
	use module\application\model\validador\Marca_Pativel;
	use module\application\model\validador\Modelo;
	use module\application\model\validador\Modelo_Compativel;
	use module\application\model\validador\Modelo_Pativel;
	use module\application\model\validador\Peca;
	use module\application\model\validador\Permissao;
	use module\application\model\validador\Plano;
	use module\application\model\validador\Preferencia_Entrega;
	use module\application\model\validador\Recuperar_Senha;
	use module\application\model\validador\Removido;
	use module\application\model\validador\Status_Entidade;
	use module\application\model\validador\Status_Fatura;
	use module\application\model\validador\Status_Peca;
	use module\application\model\validador\Estado_Uso_Peca;
	use module\application\model\validador\Status_Usuario;
	use module\application\model\validador\Transacao;
	use module\application\model\validador\Usuario;
	use module\application\model\validador\Versao;
	use module\application\model\validador\Versao_Compativel;
	use module\application\model\validador\Versao_Pativel;
	use module\application\model\validador\Visualizado;
	
	class Validador {
		
		function __construct() {
			
		}
		
		public static function Acesso_Usuario() : Acesso_Usuario { return new Acesso_Usuario(); }
		
		public static function Adicionado() : Adicionado { return new Adicionado(); }
		
		public static function Categoria() : Categoria { return new Categoria(); }
		
		public static function Categoria_Compativel() : Categoria_Compativel { return new Categoria_Compativel(); }
		
		public static function Categoria_Pativel() : Categoria_Pativel { return new Categoria_Pativel(); }
		
		public static function Cidade() : Cidade { return new Cidade(); }
		
		public static function Contato_Anunciante() : Contato_Anunciante { return new Contato_Anunciante(); }
		
		public static function Contato() : Contato { return new Contato(); }
		
		public static function Endereco() : Endereco { return new Endereco(); }
		
		public static function Entidade() : Entidade { return new Entidade(); }
		
		public static function Estado() : Estado { return new Estado(); }
		
		public static function Fatura_Servico() : Fatura_Servico { return new Fatura_Servico(); }
		
		public static function Fatura() : Fatura { return new Fatura(); }
		
		public static function Foto_Peca() : Foto_Peca { return new Foto_Peca(); }
		
		public static function Funcionalidade() : Funcionalidade { return new Funcionalidade(); }
		
		public static function Intervalo_Pagamento() : Intervalo_Pagamento { return new Intervalo_Pagamento(); }
		
		public static function Marca() : Marca { return new Marca(); }
		
		public static function Marca_Compativel() : Marca_Compativel { return new Marca_Compativel(); }
		
		public static function Marca_Pativel() : Marca_Pativel { return new Marca_Pativel(); }
		
		public static function Modelo() : Modelo { return new Modelo(); }
		
		public static function Modelo_Compativel() : Modelo_Compativel { return new Modelo_Compativel(); }
		
		public static function Modelo_Pativel() : Modelo_Pativel { return new Modelo_Pativel(); }
		
		public static function Peca() : Peca { return new Peca(); }
		
		public static function Permissao() : Permissao { return new Permissao(); }
		
		public static function Plano() : Plano{ return new Plano(); }
		
		public static function Preferencia_Entrega() : Preferencia_Entrega { return new Preferencia_Entrega(); }
		
		public static function Recuperar_Senha() : Recuperar_Senha { return new Recuperar_Senha(); }
		
		public static function Removido() : Removido { return new Removido(); }
		
		public static function Status_Entidade() : Status_Entidade { return new Status_Entidade(); }
		
		public static function Status_Fatura() : Status_Fatura { return new Status_Fatura(); }
		
		public static function Status_Peca() : Status_Peca { return new Status_Peca(); }
		
		public static function Estado_Uso_Peca() : Estado_Uso_Peca { return new Estado_Uso_Peca(); }
		
		public static function Status_Usuario() : Status_Usuario { return new Status_Usuario(); }
		
		public static function Transacao() : Transacao { return new Transacao(); }
		
		public static function Usuario() : Usuario { return new Usuario(); }
		
		public static function Versao() : Versao { return new Versao(); }
		
		public static function Versao_Compativel() : Versao_Compativel { return new Versao_Compativel(); }
		
		public static function Versao_Pativel() : Versao_Pativel { return new Versao_Pativel(); }
		
		public static function Visualizado() : Visualizado { return new Visualizado(); }
	}
?>
