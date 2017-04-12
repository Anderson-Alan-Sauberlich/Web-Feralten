<a href="/auto-pecas/resultados/" class="ui card">
	<div class="content">
		<div class="meta"><?php echo $peca->get_nome(); ?></div>
	</div>
	<div class="ui medium bordered image">
		<?php if (!empty($peca->get_fotos())) { ?>
			<img width="200" height="150" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="<?php echo str_replace("@", "200x150", $peca->get_foto(1)->get_endereco()); ?>">
		<?php } else { ?>
			<img width="200" height="150" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="/application/view/resources/img/imagem_indisponivel.png">
		<?php } ?>
	</div>
	<div class="content">
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
	</div>
	<div class="extra content">
		<span class="right floated"><?php echo date('d/m/Y', strtotime($peca->get_data_anuncio())); ?></span>
		<span><i class="user icon"></i>livre</span>
	</div>
	<?php if ($peca->get_entidade()->get_usuario_id() === $_SESSION['login']['usuario']['id']) { ?>
		<div class="extra content">
			<div class="ui two buttons">
				<button id="atualizar" name="atualizar" value="$peca->get_id();" class="ui inverted green button">Atualizar</button>
				<button id="excluir" name="excluir" value="$peca->get_id();" class="ui inverted red button">Excluir</button>
			</div>
		</div>
	<?php } ?>
</a>