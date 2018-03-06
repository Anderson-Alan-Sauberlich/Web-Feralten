<?php use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Orcamento; ?>
<div class="ui fluid vertical menu">
	<a href="/usuario/meu-perfil/orcamentos/meus-orcamentos/" class="link <?php View_Orcamento::MostrarPaginaAtualLink(View_Orcamento::MEUS_ORCAMENTOS); ?> item">Meus Orçamentos<div id="label_meus_orcamentos" class="ui <?php View_Orcamento::MostrarPaginaAtualLabel(View_Orcamento::MEUS_ORCAMENTOS); ?> label"><?php View_Orcamento::MostrarNumeroMeus(); ?></div></a>
</div>
<div class="ui fluid vertical menu">
	<a href="/usuario/meu-perfil/orcamentos/caixa-de-entrada/" class="link <?php View_Orcamento::MostrarPaginaAtualLink(View_Orcamento::CAIXA_DE_ENTRADA); ?> item">Caixa de Entrada<div id="label_caixa_de_entrada" class="ui <?php View_Orcamento::MostrarPaginaAtualLabel(View_Orcamento::CAIXA_DE_ENTRADA); ?> label"><?php View_Orcamento::MostrarNumeroRecebido(); ?></div></a>
	<a href="/usuario/meu-perfil/orcamentos/respondidos/" class="link <?php View_Orcamento::MostrarPaginaAtualLink(View_Orcamento::RESPONDIDOS); ?> item">Respondidos<div id="label_respondidos" class="ui <?php View_Orcamento::MostrarPaginaAtualLabel(View_Orcamento::RESPONDIDOS); ?> label"><?php View_Orcamento::MostrarNumeroRespondido(); ?></div></a>
	<a href="/usuario/meu-perfil/orcamentos/nao-tenho/" class="link <?php View_Orcamento::MostrarPaginaAtualLink(View_Orcamento::NAO_TENHO); ?> item">Não Tenho<div id="label_nao_tenho" class="ui <?php View_Orcamento::MostrarPaginaAtualLabel(View_Orcamento::NAO_TENHO); ?> label"><?php View_Orcamento::MostrarNumeroNaoTenho(); ?></div></a>
</div>
<div class="ui fluid vertical menu">
    <div class="active item">
        <select id="categoria" name="categoria" class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Categorias...</option>
        </select>
    	<div class="ui divider"></div>
        <select id="marca" name="marca" class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Marcas...</option>
        </select>
    	<div class="ui divider"></div>
        <select id="modelo" name="modelo" class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todos os Modelos...</option>
        </select>
        <div class="ui divider"></div>
        <select id="versao" name="versao" class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Versões...</option>
        </select>
    </div>
</div>
<script type="text/javascript" src="/application/js/layout/menu/orcamento.js"></script>