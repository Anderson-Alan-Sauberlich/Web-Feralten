<?php use Module\Application\View\SRC\Layout\Elemento\Orcamento as View_Orcamento; ?>
<div id="div_orcamento_<?php View_Orcamento::Mostrar_ID(); ?>" class="ui raised secondary clearing segment">
	<h2 class="ui header"><?php View_Orcamento::Mostrar_Nome(); ?></h2>
    <h4 class="ui header"><?php View_Orcamento::Mostrar_CMMV(); ?></h4>
    <h4 class="ui header"><?php View_Orcamento::Mostrar_Anos(); ?></h4>
    <div class="ui fluid accordion">
    	<div class="title">
        	<h4>Mais Informações...
        	<i class="dropdown icon"></i></h4>
    	</div>
    	<div class="content">
    		<p><?php View_Orcamento::Mostrar_Descricao(); ?></p>
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
            	<?php foreach ($pecas as $peca) { ?>
                	<div class="item">
                		<i class="large github middle aligned icon"></i>
                		<div class="content">
                			<a class="header">Semantic-Org/Semantic-UI</a>
                			<div class="description">Updated 10 mins ago</div>
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
        	<div id="btn_sim_tenho_<?php View_Orcamento::Mostrar_ID(); ?>" OnClick="SimTenho(<?php View_Orcamento::Mostrar_ID(); ?>)" class="ui primary button">SIM TENHO</div>
        	<div id="btn_nao_tenho_<?php View_Orcamento::Mostrar_ID(); ?>" OnClick="NaoTenho(<?php View_Orcamento::Mostrar_ID(); ?>)" class="ui <?php View_Orcamento::Verificar_Desativar_Botao(); ?> secondary button">NÃO TENHO</div>
    	</div>
	<?php } ?>
</div>