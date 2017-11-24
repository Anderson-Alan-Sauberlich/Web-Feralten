<?php
namespace module\administration\model\common\util;
	
	use module\administration\model\validador\Usuario_Admin;
	
	class Validador
	{
		
		function __construct()
		{
			
		}
		
		public static function Usuario_Admin() : Usuario_Admin { return new Usuario_Admin(); }
	}
