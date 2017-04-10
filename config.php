<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	define('RAIZ', __DIR__);
?>
