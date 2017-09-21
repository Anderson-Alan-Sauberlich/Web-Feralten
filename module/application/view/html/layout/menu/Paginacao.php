<?php use module\application\view\src\layout\menu\Paginacao as View_Paginacao; ?>
<nav class="ui center aligned container margem-inferior-pouco">
	<ul class="ui stackable pagination menu">
	 	<?php View_Paginacao::Mostrar_Item_Anterior(); ?>
		<?php View_Paginacao::Mostrar_Indices_Paginas(); ?>
		<?php View_Paginacao::Mostrar_Item_Proximo(); ?>
	</ul>
</nav>