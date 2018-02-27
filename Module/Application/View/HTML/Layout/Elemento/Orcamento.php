<?php use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento; ?>
<div id="div_orcamento_<?= View_Orcamento::Mostrar_ID(); ?>" class="ui segments">
    <div class="ui raised tertiary clearing segment">
        <h2 class="ui header"><?= View_Orcamento::Mostrar_Nome(); ?></h2>
    </div>
    <div class="ui raised secondary clearing segment">
        <h4 class="ui header"><?= View_Orcamento::Mostrar_CMMV(); ?></h4>
        <h4 class="ui header"><?= View_Orcamento::Mostrar_Anos(); ?></h4>
        <div class="ui fluid accordion">
        	<div class="title">
            	<h4>Mais Informações...
            	<i class="dropdown icon"></i></h4>
        	</div>
        	<div class="content">
        		<p><?= View_Orcamento::Mostrar_Descricao(); ?></p>
        	</div>
        </div>
        <?php if (View_Orcamento::Verificar_Mostrar_ListaPecas()) { ?>
        	<div class="ui divider"></div>
        	<div class="ui fluid accordion">
        	<div class="title">
            	<h4>Lista de Peças...
            	<i class="dropdown icon"></i></h4>
        	</div>
        	<div class="content">
                <div class="ui relaxed divided list">
                	<?php foreach (View_Orcamento::Retornar_Pecas() as $peca) { ?>
                    	<div class="item">
                    		<i class="large share middle aligned icon"></i>
                    		<div class="content">
                    			<a href="/pecas/detalhes/<?= $peca->get_url(); ?>/" class="header"><?= $peca->get_nome(); ?></a>
                    			<div class="description">Peça adicionada em: <?= $peca->get_data_anuncio(); ?></div>
                    		</div>
                    	</div>
                	<?php } ?>
                </div>
        	</div>
        </div>
        <?php } ?>
        <?php if (View_Orcamento::Verificar_Mostrar_Botoes()) { ?>
        	<div class="ui divider"></div>
            <div class="ui two bottom buttons">
            	<div id="btn_sim_tenho_<?= View_Orcamento::Mostrar_ID(); ?>" OnClick="SimTenho(<?= View_Orcamento::Mostrar_ID(); ?>)" class="ui primary button">SIM TENHO</div>
            	<div id="btn_nao_tenho_<?= View_Orcamento::Mostrar_ID(); ?>" OnClick="NaoTenho(<?= View_Orcamento::Mostrar_ID(); ?>)" class="ui <?= View_Orcamento::Verificar_Desativar_Botao(); ?> secondary button">NÃO TENHO</div>
        	</div>
    	<?php } ?>
    </div>
</div>