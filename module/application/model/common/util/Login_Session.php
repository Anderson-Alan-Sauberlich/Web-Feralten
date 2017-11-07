<?php
namespace module\application\model\common\util;
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	class Login_Session {
		
		/** @const Parametro Funcionalidade */
		public const PERFIL = 1;
		
		/** @const Parametro Funcionalidade */
		public const MEUS_DADOS = 2;
		
		/** @const Parametro Funcionalidade */
		public const PECAS = 3;
		
		/** @const Parametro Funcionalidade */
		public const FINANCEIRO = 4;
		
		function __constructor() {
			
		}
		
		/**
		 * Function Verificar_Login
		 * @return bool
		 */
		public static function Verificar_Login() : bool {
		    if (empty(self::get_usuario_id())) {
		        return false;
		    } else {
		        return true;
		    }
		}
		
		/**
		 * Function Verificar_Entidade
		 * @return bool
		 */
		public static function Verificar_Entidade() : bool {
		    if (empty(self::get_entidade_id())) {
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
		public static function set_usuario_id(int $usuario_id) : void {
			$_SESSION['login']['usuario']['id'] = $usuario_id;
		}
		
		/** 
		 * Function Get_Usuario_Id
		 * @param none
		 * @return ?int 'Id do usuario'
		 */
		public static function get_usuario_id() : ?int {
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
		public static function set_usuario_nome(string $usuario_nome) : void {
			$_SESSION['login']['usuario']['nome'] = $usuario_nome;
		}
		
		/**
		 * Function Get_Usuario_Nome
		 * @param none
		 * @return ?string 'Nome do usuario'
		 */
		public static function get_usuario_nome() : ?string {
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
		public static function set_usuario_status(int $usuario_status) : void {
			$_SESSION['login']['usuario']['status'] = $usuario_status;
		}
		
		/**
		 * Function Get_Usuario_Status
		 * @param none
		 * @return ?int 'Status do usuario'
		 */
		public static function get_usuario_status() : ?int {
			if (isset($_SESSION['login']['usuario']['status'])) {
				return $_SESSION['login']['usuario']['status'];
			} else {
				return null;
			}
		}
		
		/** 
		 * Function Set_Entidade_Id
		 * @param int $entidade_id 'Id da entidade'
		 * @return void
		 */
		public static function set_entidade_id(int $entidade_id) : void {
			$_SESSION['login']['entidade']['id'] = $entidade_id;
		}
		
		/** 
		 * Function Get_Entidade_Id
		 * @param none
		 * @return ?int 'Id da entidade'
		 */
		public static function get_entidade_id() : ?int {
			if (isset($_SESSION['login']['entidade']['id'])) {
				return $_SESSION['login']['entidade']['id'];
			} else {
				return null;
			}
		}
		
		/**
		 * Function Set_Entidade_Nome
		 * @param string $entidade_nome 'Nome da entidade'
		 * @return void
		 */
		public static function set_entidade_nome(?string $entidade_nome) : void {
			$_SESSION['login']['Entidade']['nome'] = $entidade_nome;
		}
		
		/**
		 * Function Get_Entidade_Nome
		 * @param none
		 * @return ?string 'Nome da entidade'
		 */
		public static function get_entidade_nome() : ?string {
			if (isset($_SESSION['login']['entidade']['nome'])) {
				return $_SESSION['login']['entidade']['nome'];
			} else {
				return null;
			}
		}
		
		/**
		 * Function Set_Entidade_Status
		 * @param int $entidade_status 'Status da entidade'
		 * @return void
		 */
		public static function set_entidade_status(int $entidade_status) : void {
			$_SESSION['login']['entidade']['status'] = $entidade_status;
		}
		
		/**
		 * Function Get_Entidade_Status
		 * @param none
		 * @return ?int 'Status da entidade'
		 */
		public static function get_entidade_status() : ?int {
			if (isset($_SESSION['login']['entidade']['status'])) {
				return $_SESSION['login']['entidade']['status'];
			} else {
				return null;
			}
		}
		
		/** 
		 * Function Set_Permissao
		 * @param int $funcionalidade_id const Login_Session::PERFIL = 1 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::MEUS_DADOS = 2 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::PECAS = 3 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::FINANCEIRO = 4 'Id da funcionalidade'
		 * @param int $permissao_id 'Id da entidade'
		 * @return void
		 */
		public static function set_permissao(int $funcionalidade_id, int $permissao_id) : void {
			$_SESSION['login']['permissao'][$funcionalidade_id] = $permissao_id;
		}
		
		/**
		 * Function Get_Entidade_Id
		 * @param int $funcionalidade_id const Login_Session::PERFIL = 1 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::MEUS_DADOS = 2 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::PECAS = 3 'Id da funcionalidade'
		 * @param int $funcionalidade_id const Login_Session::FINANCEIRO = 4 'Id da funcionalidade'
		 * @return ?int 'Id da permissão'
		 */
		public static function get_permissao(int $funcionalidade_id) : ?int {
			if (isset($_SESSION['login']['permissao'][$funcionalidade_id])) {
				return $_SESSION['login']['permissao'][$funcionalidade_id];
			} else {
				return null;
			}
		}
		
		public static function Finalizar_Login_Session() : void {
			unset($_SESSION['login']);
		}
	}
?>