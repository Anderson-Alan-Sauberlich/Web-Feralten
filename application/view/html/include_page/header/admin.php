<?php require_once RAIZ.'/application/view/src/include_page/header/admin.php'; ?>
<?php use application\view\src\include_page\header\Admin as View_Admin; ?>
<script type="text/javascript" src="/application/view/js/include_page/header/admin.js"></script>
<div class="row">
	<div class="ui inverted blue top attached segment">
		<div class="ui container stackable inverted blue menu">
			<a onclick="abrir_menu()" class="item"><i class="sidebar icon"></i>Menu</a>
			<div class="right menu">
				<a href="/admin/login/sair/?logout=<?php View_Admin::Carregar_Id_Session(); ?>" class="item"><i class="power icon"></i>Sair</a>
			</div>
		</div>
	</div>
</div>