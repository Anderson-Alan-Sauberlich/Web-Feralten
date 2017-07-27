<div class="ui card">
	<a href="/" class="content">
		<div class="meta"><?php echo $peca->get_nome(); ?></div>
	</a>
	<a href="/" class="ui medium bordered image">
		<?php if (!empty($peca->get_foto(1))) { ?>
			<img width="200" height="150" <?php if ($peca->get_status()->get_id() !== 1) { echo 'class="ui disabled image"'; } ?> onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="<?php echo str_replace("@", "200x150", $peca->get_foto(1)->get_endereco()); ?>">
		<?php } else { ?>
			<img width="200" height="150" <?php if ($peca->get_status()->get_id() !== 1) { echo 'class="ui disabled image"'; } ?> onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'" src="/application/view/resources/img/imagem_indisponivel.png">
		<?php } ?>
	</a>
	<a href="/" class="content">
		<?php if (!empty($peca->get_preco()) AND !empty($peca->get_estado_uso())) { ?>
			<div class="right floated header">R$: <?php echo $peca->get_preco(); ?></div>
			<div class="meta">
				<span class="date"><?php echo $peca->get_estado_uso()->get_nome(); ?></span>
			</div>
		<?php } else if (!empty($peca->get_preco()) AND empty($peca->get_estado_uso())) { ?>
			<div class="header">R$: <?php echo $peca->get_preco(); ?></div>
		<?php } else if (empty($peca->get_preco()) AND !empty($peca->get_estado_uso())) { ?>
			<div class="header">R$: A Negociar</div>
			<div class="meta">
			<span class="date"><?php echo $peca->get_estado_uso()->get_nome(); ?></span>
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
				<a id="opcoes" onclick="Mostrar_Modal(<?php echo $peca->get_id(); ?>);" class="ui inverted red button">Opções</a>
			</div>
		</div>
        <div id="modal_<?php echo $peca->get_id(); ?>" class="ui tiny modal">
        	<div class="header"><?php echo $peca->get_nome(); ?></div>
            <div class="content">
            	<div class="ui container fluid">
                    <div class="grouped fields">
                    	<label>Deseja Deletar a Peça?</label>
                    	<label class="ui red basic label">Cuidado, Irreversível!</label>
                    	<div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" onchange="Change_Checkbox(<?php echo $peca->get_id(); ?>)" id="deletar_<?php echo $peca->get_id(); ?>" name="deletar_<?php echo $peca->get_id(); ?>">
                                <label for="deletar_<?php echo $peca->get_id(); ?>">Deletar Peça</label>
                            </div>
                        </div>
                        <div class="ui divider"></div>
                    	<label>Selecione o Status da Peça:</label>
                        <div class="field">
                            <div id="div_visivel_<?php echo $peca->get_id(); ?>" class="ui radio checkbox">
                            	<input type="radio" id="visivel_<?php echo $peca->get_id(); ?>" <?php if ($peca->get_status()->get_id() === 1) { echo 'checked="checked"'; } ?> name="status_<?php echo $peca->get_id(); ?>">
                            	<label for="visivel_<?php echo $peca->get_id(); ?>">Visível Para Todos</label>
                            </div>
                        </div>
                        <div class="field">
                            <div id="div_desativada_<?php echo $peca->get_id(); ?>" class="ui radio checkbox">
                                <input type="radio" id="desativada_<?php echo $peca->get_id(); ?>" <?php if ($peca->get_status()->get_id() === 2) { echo 'checked="checked"'; } ?> name="status_<?php echo $peca->get_id(); ?>">
                                <label for="desativada_<?php echo $peca->get_id(); ?>">Desativada Temporariamente</label>
                            </div>
                        </div>
                        <div class="field">
                            <div id="div_invisivel_<?php echo $peca->get_id(); ?>" class="ui radio checkbox">
                            	<input type="radio" id="invisivel_<?php echo $peca->get_id(); ?>" <?php if ($peca->get_status()->get_id() === 3) { echo 'checked="checked"'; } ?> name="status_<?php echo $peca->get_id(); ?>">
                            	<label for="invisivel_<?php echo $peca->get_id(); ?>">Invisível Para Todos</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
            	<div onclick="Cancelar_Opcoes_Peca()" class="ui cancel button">Cancelar</div>
                <div onclick="Salvar_Opcoes_Peca(<?php echo $peca->get_id(); ?>)" class="ui approve positive right labeled icon button">Salvar <i class="checkmark icon"></i></div>
            </div>
        </div>
	<?php } ?>
</div>