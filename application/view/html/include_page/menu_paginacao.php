<?php require_once RAIZ.'/application/view/src/include_page/menu_paginacao.php'; ?>
<?php use application\view\src\include_page\Menu_Paginacao as View_Menu_Paginacao; ?>
<nav class="ui center aligned container margem-inferior-pouco">
	<ul class="ui stackable pagination menu">
	 	<?php View_Menu_Paginacao::Mostrar_Item_Anterior(); ?>
		<?php View_Menu_Paginacao::Mostrar_Indices_Paginas(); ?>
		<?php View_Menu_Paginacao::Mostrar_Item_Proximo(); ?>
	</ul>
</nav>