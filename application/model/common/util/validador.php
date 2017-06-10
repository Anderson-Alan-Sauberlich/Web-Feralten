<?php
namespace application\model\common\util;
	
	require_once RAIZ.'/application/model/validador/acesso_usuario.php';
	require_once RAIZ.'/application/model/validador/categoria.php';
	require_once RAIZ.'/application/model/validador/categoria_compativel.php';
	require_once RAIZ.'/application/model/validador/categoria_pativel.php';
	require_once RAIZ.'/application/model/validador/cidade.php';
	require_once RAIZ.'/application/model/validador/endereco.php';
	require_once RAIZ.'/application/model/validador/entidade.php';
	require_once RAIZ.'/application/model/validador/estado.php';
	require_once RAIZ.'/application/model/validador/foto_peca.php';
	require_once RAIZ.'/application/model/validador/funcionalidade.php';
	require_once RAIZ.'/application/model/validador/marca.php';
	require_once RAIZ.'/application/model/validador/marca_compativel.php';
	require_once RAIZ.'/application/model/validador/marca_pativel.php';
	require_once RAIZ.'/application/model/validador/modelo.php';
	require_once RAIZ.'/application/model/validador/modelo_compativel.php';
	require_once RAIZ.'/application/model/validador/modelo_pativel.php';
	require_once RAIZ.'/application/model/validador/peca.php';
	require_once RAIZ.'/application/model/validador/permissao.php';
	require_once RAIZ.'/application/model/validador/preferencia_entrega.php';
	require_once RAIZ.'/application/model/validador/status_entidade.php';
	require_once RAIZ.'/application/model/validador/status_peca.php';
	require_once RAIZ.'/application/model/validador/status_usuario.php';
	require_once RAIZ.'/application/model/validador/usuario.php';
	require_once RAIZ.'/application/model/validador/usuario_admin.php';
	require_once RAIZ.'/application/model/validador/versao.php';
	require_once RAIZ.'/application/model/validador/versao_compativel.php';
	require_once RAIZ.'/application/model/validador/versao_pativel.php';
	
	use application\model\validador\Acesso_Usuario;
	use application\model\validador\Categoria;
	use application\model\validador\Categoria_Compativel;
	use application\model\validador\Categoria_Pativel;
	use application\model\validador\Cidade;
	use application\model\validador\Endereco;
	use application\model\validador\Entidade;
	use application\model\validador\Estado;
	use application\model\validador\Foto_Peca;
	use application\model\validador\Funcionalidade;
	use application\model\validador\Marca;
	use application\model\validador\Marca_Compativel;
	use application\model\validador\Marca_Pativel;
	use application\model\validador\Modelo;
	use application\model\validador\Modelo_Compativel;
	use application\model\validador\Modelo_Pativel;
	use application\model\validador\Peca;
	use application\model\validador\Permissao;
	use application\model\validador\Preferencia_Entrega;
	use application\model\validador\Status_Entidade;
	use application\model\validador\Status_Peca;
	use application\model\validador\Status_Usuario;
	use application\model\validador\Usuario;
	use application\model\validador\Usuario_Admin;
	use application\model\validador\Versao;
	use application\model\validador\Versao_Compativel;
	use application\model\validador\Versao_Pativel;
	
	class Validador {
		
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