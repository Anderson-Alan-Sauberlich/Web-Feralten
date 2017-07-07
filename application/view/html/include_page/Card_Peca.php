<div class="ui card">
	<a href="/" class="content">
		<div class="meta"><?php echo $peca->get_nome(); ?></div>
	</a>
	<a href="/" class="ui medium bordered image">
		<?php if (!empty($peca->get_foto(1))) { ?>
			<img width="200" height="150" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="<?php echo str_replace("@", "200x150", $peca->get_foto(1)->get_endereco()); ?>">
		<?php } else { ?>
			<img width="200" height="150" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="/application/view/resources/img/imagem_indisponivel.png">
		<?php } ?>
	</a>
	<a href="/" class="content">
		<?php if (!empty($peca->get_preco()) AND !empty($peca->get_status())) { ?>
			<div class="right floated header">R$: <?php echo $peca->get_preco(); ?></div>
			<div class="meta">
				<span class="date"><?php echo $peca->get_status()->get_nome(); ?></span>
			</div>
		<?php } else if (!empty($peca->get_preco()) AND empty($peca->get_status())) { ?>
			<div class="header">R$: <?php echo $peca->get_preco(); ?></div>
		<?php } else if (empty($peca->get_preco()) AND !empty($peca->get_status())) { ?>
			<div class="header">R$: A Negociar</div>
			<div class="meta">
			<span class="date"><?php echo $peca->get_status()->get_nome(); ?></span>
			</div>
		<?php } else if (empty($peca->get_preco())) { ?>
			<div class="header">R$: A Negociar</div>
		<?php } ?>
		<?php if (!empty($peca->get_fabricante())) { ?>
			<div class="description"><?php echo $peca->get_fabricante(); ?></div>
		<?php } ?>
	</a>
	<a href="/" class="extra content">
		<span class="right floated"><?php echo date('d/m/Y', strtotime($peca->get_data_anuncio())); ?></span>
		<span><i class="user icon"></i>livre</span>
	</a>
	<?php if (isset($_SESSION['login']['usuario']['id']) AND $peca->get_entidade()->get_usuario_id() === $_SESSION['login']['usuario']['id']) { ?>
		<div class="extra content">
			<div class="ui two buttons">
				<a id="atualizar" href="/usuario/meu-perfil/pecas/atualizar/<?php echo $peca->get_id(); ?>/" class="ui inverted green button">Atualizar</a>
				<a id="excluir" href="/usuario/meu-perfil/pecas/excluir/<?php echo $peca->get_id(); ?>/" class="ui inverted red button">Excluir</a>
			</div>
		</div>
	<?php } ?>
</div>