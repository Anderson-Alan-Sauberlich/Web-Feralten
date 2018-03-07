<?php use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento; ?>
<div id="div_orcamento_<?= View_Orcamento::MostrarID(); ?>" class="ui segments">
    <div class="ui raised tertiary clearing segment">
        <h2 class="ui header"><?= View_Orcamento::MostrarNome(); ?></h2>
    </div>
    <div class="ui raised secondary clearing segment">
        <h4 class="ui header"><?= View_Orcamento::MostrarCMMV(); ?></h4>
        <h4 class="ui header"><?= View_Orcamento::MostrarAnos(); ?></h4>
        <div class="ui fluid accordion">
        	<div class="title">
            	<h4>Mais Informações...
            	<i class="dropdown icon"></i></h4>
        	</div>
        	<div class="content">
        		<p><?= View_Orcamento::MostrarDescricao(); ?></p>
        	</div>
        </div>
        <?php if (View_Orcamento::VerificarMostrarListaPecas()) { ?>
        	<div class="ui divider"></div>
        	<div class="ui fluid accordion">
        	<div class="title">
            	<h4>Lista de Peças...
            	<i class="dropdown icon"></i></h4>
        	</div>
        	<div class="content">
                <div class="ui relaxed divided list">
                	<?php foreach (View_Orcamento::RetornarPecas() as $peca) { ?>
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
        <?php if (View_Orcamento::VerificarMostrarBotoes()) { ?>
        	<div class="ui divider"></div>
            <div class="ui two bottom buttons">
            	<a id="btn_sim_tenho_<?= View_Orcamento::MostrarID(); ?>" href="/usuario/meu-perfil/pecas/cadastrar/no-orcamento/<?= View_Orcamento::MostrarID(); ?>/" class="ui primary button">SIM TENHO</a>
            	<div id="btn_nao_tenho_<?= View_Orcamento::MostrarID(); ?>" OnClick="NaoTenho(<?= View_Orcamento::MostrarID(); ?>)" class="ui <?= View_Orcamento::VerificarDesativarBotao(); ?> secondary button">NÃO TENHO</div>
        	</div>
    	<?php } else if (View_Orcamento::VerificarMostrarBotaoCadastrar()) { ?>
    		<a href="/usuario/meu-perfil/pecas/cadastrar/no-orcamento/<?= View_Orcamento::MostrarID(); ?>/" class="ui right floated primary button">Eu tenho essa peça</a>
    	<?php } ?>
    </div>
</div>