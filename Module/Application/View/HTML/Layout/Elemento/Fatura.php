<?php use Module\Application\View\SRC\Layout\Elemento\Fatura as View_Fatura; ?>
<div class="ui secondary segment">
	<div class="ui stackable five column internally celled grid">
        <div class="center aligned column">
        	<h4>Abertura</h4>
        	<div class="ui mini statistic">
                <div class="content"><?= View_Fatura::MostrarDataAbertura(); ?></div>
            </div>
        </div>
        <div class="center aligned column">
        	<h4>Fechamento</h4>
        	<div class="ui mini statistic">
                <div class="content"><?= View_Fatura::MostrarDataFechamento(); ?></div>
            </div>
        </div>
        <div class="center aligned column">
        	<h4>Vencimento</h4>
        	<div class="ui mini statistic">
                <div class="content"><?= View_Fatura::MostrarDataVencimento(); ?></div>
            </div>
        </div>
        <div class="center aligned column">
        	<h4>Status</h4>
        	<div class="ui mini statistic">
                <div class="content"><?= View_Fatura::MostrarStatus(); ?></div>
            </div>
        </div>
        <div class="center aligned column">
        	<h4>Valor Total</h4>
        	<div class="ui mini statistic">
                <div class="content">R$: <?= View_Fatura::MostrarValorTotal(); ?></div>
            </div>
        </div>
    </div>
    <div id="accordion_fatura_aberta" class="ui accordion">
        <div id="title_fatura_aberta" class="title ui horizontal divider"><i class="icon dropdown"></i>Detalhes</div>
        <div id="content_fatura_aberta" class="content">
            SERVIÇOS:
            <div class="ui relaxed large celled list">
            	<?php if (!empty(View_Fatura::RetornarListaFaturaServicos())) { ?>
                	<?php foreach (View_Fatura::RetornarListaFaturaServicos() as $fatura_servicos) { ?>
                    	<div class="item">
                    		<div class="header"><?= $fatura_servicos->get_descricao(); ?>, valor R$: <?= number_format($fatura_servicos->get_valor(), 2, ',', '.'); ?></div>
                    		<div class="content">Mensal, <?= View_Fatura::MostrarDataAbertura(); ?> até <?= View_Fatura::MostrarDataFechamento(); ?></div>
                    	</div>
                	<?php } ?>
            	<?php } ?>
            </div>
        </div>
    </div>
</div>