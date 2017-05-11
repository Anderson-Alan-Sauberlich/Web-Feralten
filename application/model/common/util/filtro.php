<?php
namespace application\model\common\util;
	
	require_once RAIZ.'/application/model/filter/acesso_usuario.php';
	require_once RAIZ.'/application/model/filter/categoria.php';
	require_once RAIZ.'/application/model/filter/categoria_compativel.php';
	require_once RAIZ.'/application/model/filter/categoria_pativel.php';
	require_once RAIZ.'/application/model/filter/cidade.php';
	require_once RAIZ.'/application/model/filter/endereco.php';
	require_once RAIZ.'/application/model/filter/entidade.php';
	require_once RAIZ.'/application/model/filter/estado.php';
	require_once RAIZ.'/application/model/filter/foto_peca.php';
	require_once RAIZ.'/application/model/filter/funcionalidade.php';
	require_once RAIZ.'/application/model/filter/marca.php';
	require_once RAIZ.'/application/model/filter/marca_compativel.php';
	require_once RAIZ.'/application/model/filter/marca_pativel.php';
	require_once RAIZ.'/application/model/filter/modelo.php';
	require_once RAIZ.'/application/model/filter/modelo_compativel.php';
	require_once RAIZ.'/application/model/filter/modelo_pativel.php';
	require_once RAIZ.'/application/model/filter/peca.php';
	require_once RAIZ.'/application/model/filter/permissao.php';
	require_once RAIZ.'/application/model/filter/preferencia_entrega.php';
	require_once RAIZ.'/application/model/filter/status_entidade.php';
	require_once RAIZ.'/application/model/filter/status_peca.php';
	require_once RAIZ.'/application/model/filter/status_usuario.php';
	require_once RAIZ.'/application/model/filter/usuario.php';
	require_once RAIZ.'/application/model/filter/usuario_admin.php';
	require_once RAIZ.'/application/model/filter/versao.php';
	require_once RAIZ.'/application/model/filter/versao_compativel.php';
	require_once RAIZ.'/application/model/filter/versao_pativel.php';
	
	use application\model\filter\Acesso_Usuario;
	use application\model\filter\Categoria;
	use application\model\filter\Categoria_Compativel;
	use application\model\filter\Categoria_Pativel;
	use application\model\filter\Cidade;
	use application\model\filter\Endereco;
	use application\model\filter\Entidade;
	use application\model\filter\Estado;
	use application\model\filter\Foto_Peca;
	use application\model\filter\Funcionalidade;
	use application\model\filter\Marca;
	use application\model\filter\Marca_Compativel;
	use application\model\filter\Marca_Pativel;
	use application\model\filter\Modelo;
	use application\model\filter\Modelo_Compativel;
	use application\model\filter\Modelo_Pativel;
	use application\model\filter\Peca;
	use application\model\filter\Permissao;
	use application\model\filter\Preferencia_Entrega;
	use application\model\filter\Status_Entidade;
	use application\model\filter\Status_Peca;
	use application\model\filter\Status_Usuario;
	use application\model\filter\Usuario;
	use application\model\filter\Usuario_Admin;
	use application\model\filter\Versao;
	use application\model\filter\Versao_Compativel;
	use application\model\filter\Versao_Pativel;
	
	class Filtro {
		
		function __construct() {
			
		}
		
		public static function Acesso_Usuario() : Acesso_Usuario { return new Acesso_Usuario(); }
		
		public static function Categoria() : Categoria { return new Categoria(); }
		
		public static function Categoria_Compativel() : Categoria_Compativel { return new Categoria_Compativel(); }
		
		public static function Categoria_Pativel() : Categoria_Pativel { return new Categoria_Pativel(); }
		
		public static function Cidade() : Cidade { return new Cidade(); }
		
		public static function Endereco() : Endereco { return new Endereco(); }
		
		public static function Entidade() : Entidade { return new Entidade(); }
		
		public static function Estado() : Estado { return new Estado(); }
		
		public static function Foto_Peca() : Foto_Peca { return new Foto_Peca(); }
		
		public static function Funcionalidade() : Funcionalidade { return new Funcionalidade(); }
		
		public static function Marca() : Marca { return new Marca(); }
		
		public static function Marca_Compativel() : Marca_Compativel { return new Marca_Compativel(); }
		
		public static function Marca_Pativel() : Marca_Pativel { return new Marca_Pativel(); }
		
		public static function Modelo() : Modelo { return new Modelo(); }
		
		public static function Modelo_Compativel() : Modelo_Compativel { return new Modelo_Compativel(); }
		
		public static function Modelo_Pativel() : Modelo_Pativel { return new Modelo_Pativel(); }
		
		public static function Peca() : Peca { return new Peca(); }
		
		public static function Permissao() : Permissao { return new Permissao(); }
		
		public static function Preferencia_Entrega() : Preferencia_Entrega { return new Preferencia_Entrega(); }
		
		public static function Status_Entidade() : Status_Entidade { return new Status_Entidade(); }
		
		public static function Status_Peca() : Status_Peca { return new Status_Peca(); }
		
		public static function Status_Usuario() : Status_Usuario { return new Status_Usuario(); }
		
		public static function Usuario() : Usuario { return new Usuario(); }
		
		public static function Usuario_Admin() : Usuario_Admin { return new Usuario_Admin(); }
		
		public static function Versao() : Versao { return new Versao(); }
		
		public static function Versao_Compativel() : Versao_Compativel { return new Versao_Compativel(); }
		
		public static function Versao_Pativel() : Versao_Pativel { return new Versao_Pativel(); }
	}
?>