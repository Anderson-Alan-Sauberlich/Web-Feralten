<?php use Module\Application\View\SRC\Layout\Elemento\Vendedor as View_Vendedor; ?>
<div class="item">
	<div class="image">
		<img src="<?= View_Vendedor::RetornarImagem(); ?>">
	</div>
	<div class="content">
		<a class="header"><?= View_Vendedor::RetornaNome(); ?></a>
		<div class="meta">
			<span><?= View_Vendedor::RetornaCidadeEstado(); ?></span>
		</div>
		<div class="description">
			<p><?= View_Vendedor::RetornarEmail(); ?> / <?= View_Vendedor::RetornaTelefone(); ?></p>
		</div>
		<div class="extra">
			<?= View_Vendedor::RetornaSite(); ?>
		</div>
	</div>
</div>