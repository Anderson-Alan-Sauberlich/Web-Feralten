<?php use Module\Application\View\SRC\Layout\Menu\Orcamento as View_Orcamento; ?>
<div class="ui fluid vertical menu">
	<a href="/usuario/meu-perfil/orcamentos/meus-orcamentos/" class="link item">Meus Orçamentos<div class="ui label">50</div></a>
</div>
<div class="ui fluid vertical menu">
	<a href="/usuario/meu-perfil/orcamentos/caixa-de-entrada/" class="active teal link item">Caixa de Entrega<div class="ui teal left pointing label"><?php View_Orcamento::MostrarNumeroRecebido(); ?></div></a>
	<a href="/usuario/meu-perfil/orcamentos/respondidos/" class="link item">Respondidos<div class="ui label"><?php View_Orcamento::MostrarNumeroRespondido(); ?></div></a>
	<a href="/usuario/meu-perfil/orcamentos/nao-tenho/" class="link item">Não Tenho<div class="ui label"><?php View_Orcamento::MostrarNumeroNaoTenho(); ?></div></a>
</div>
<div class="ui fluid vertical menu">
    <div class="active item">
        <select class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Categorias...</option>
        </select>
    	<div class="ui divider"></div>
        <select class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Marcas...</option>
        </select>
    	<div class="ui divider"></div>
        <select class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todos os Modelos...</option>
        </select>
        <div class="ui divider"></div>
        <select class="ui fluid search selection scrolling dropdown">
        	<option value="0">Todas as Versões...</option>
        </select>
    </div>
</div>