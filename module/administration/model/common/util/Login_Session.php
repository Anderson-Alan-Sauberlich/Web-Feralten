<?php
namespace module\administration\model\common\util;
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	class Login_Session
	{
		
		function __constructor()
		{
			
		}
		
		/**
		 * Function Verificar_Login
		 * @return bool
		 */
		public static function Verificar_Login() : bool
		{
		    if (empty(self::get_usuario_id())) {
		        return false;
		    } else {
		        return true;
		    }
		}
		
		/** 
		 * Function Set_Usuario_Id
		 * @param int $usuario_id 'Id do usuario'
		 * @return void
		 */
		public static function set_usuario_id(int $usuario_id) : void
		{
			$_SESSION['login']['usuario']['id'] = $usuario_id;
		}
		
		/** 
		 * Function Get_Usuario_Id
		 * @param none
		 * @return ?int 'Id do usuario'
		 */
		public static function get_usuario_id() : ?int
		{
			if (isset($_SESSION['login']['usuario']['id'])) {
				return $_SESSION['login']['usuario']['id'];
			} else {
				return null;
			}
		}
		
		/**
		 * Function Set_Usuario_Nome
		 * @param string $usuario_nome 'Nome do usuario'
		 * @return void
		 */
		public static function set_usuario_nome(string $usuario_nome) : void
		{
			$_SESSION['login']['usuario']['nome'] = $usuario_nome;
		}
		
		/**
		 * Function Get_Usuario_Nome
		 * @param none
		 * @return ?string 'Nome do usuario'
		 */
		public static function get_usuario_nome() : ?string
		{
			if (isset($_SESSION['login']['usuario']['nome'])) {
				return $_SESSION['login']['usuario']['nome'];
			} else {
				return null;
			}
		}
		
		/**
		 * Function Set_Usuario_Status
		 * @param int $usuario_status 'Status do usuario'
		 * @return void
		 */
		public static function set_usuario_status(int $usuario_status) : void
		{
			$_SESSION['login']['usuario']['status'] = $usuario_status;
		}
		
		/**
		 * Function Get_Usuario_Status
		 * @param none
		 * @return ?int 'Status do usuario'
		 */
		public static function get_usuario_status() : ?int
		{
			if (isset($_SESSION['login']['usuario']['status'])) {
				return $_SESSION['login']['usuario']['status'];
			} else {
				return null;
			}
		}
		
		public static function Finalizar_Login_Session() : void
		{
			unset($_SESSION['login']);
		}
	}
