<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Fatura as View_Fatura; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Fatura | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Fatura::Incluir_Menu_Usuario(); ?>
        <?php if (View_Fatura::Verificar_Fatura('fechada')) { ?>
            <div class="ui raised segment">
            	<div class="ui stackable doubling five column internally celled grid">
                    <div class="center aligned column">
                    	<h4>Abertura</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Abertura('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Vencimento</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Vencimento('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Fechamento</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Fechamento('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Status</h4>
                        <div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Status('fechada'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Valor Total</h4>
                        <div class="ui mini statistic">
                            <div class="content">R$: <?php View_Fatura::Mostrar_Total('fechada'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="ui accordion">
                    <div id="title_fatura_fechada" class="title ui horizontal divider active"><i class="icon dropdown"></i>Detalhes</div>
                    <div id="content_fatura_fechada" class="content active">
                        SERVIÇOS:
                        <div class="ui relaxed large celled list">
                        	<?php if (!empty(View_Fatura::Retornar_Lista_Fatura_Servicos('fechada'))) { ?>
                            	<?php foreach (View_Fatura::Retornar_Lista_Fatura_Servicos('fechada') as $fatura_servicos) { ?>
                                	<div class="item">
                                		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo number_format($fatura_servicos->get_valor(), 2, ',', '.'); ?></div>
                                		<div class="content">Mensal, <?php View_Fatura::Mostrar_Abertura('fechada'); ?> até <?php View_Fatura::Mostrar_Fechamento('fechada'); ?></div>
                                	</div>
                            	<?php } ?>
                        	<?php } ?>
                        </div>
                        <?php if (View_Fatura::Verificar_Valor_Fatura('fechada')) { ?>
                            <div class="ui pointing secondary three item menu" role="tablist">
                                <a data-tab="credito" class="active red item" role="tab">Crédito</a>
                                <a data-tab="debito" class="red item" role="tab">Débito</a>
                                <a data-tab="boleto" class="red item" role="tab">Boleto</a>
                            </div>
                            <div id="credito" class="ui bottom attached active tab" data-tab="credito" role="tabpanel">
                                <form class="ui form">
                                	<div class="field">
                                		<label>Número cartão</label>
                                		<input id="numero" name="numero" placeholder="(ex.: 0000 0000 0000 0000)" type="text">
                                	</div>
                                	<div class="field">
                                		<label>Nome</label>
                                		<input id="name" name="name" placeholder="Exatamente como está no cartão" type="text">
                                	</div>
                                	<div class="field">
                                		<label>Código de Segurança</label>
                                		<input id="codigo" name="codigo" placeholder="Geralente está no verso do cartão e tem de 3 a 4 digitos" type="text">
                                	</div>
                                	<div class="field">
                                		<label>Validade</label>
                                		<input id="validade" name="validade" placeholder="Mes/Ano" type="text">
                                	</div>
                                	<div class="field">
                                		<label>Data de nascimento</label>
                                		<input id="nascimento" name="nascimento" placeholder="Dia/Mes/Ano" type="text">
                                	</div>
                                	<div class="field">
                                		<label>CPF</label>
                                		<input id="cpf" name="cpf" placeholder="Digite apenas os numeros" type="text">
                                	</div>
                                	<button class="ui blue big button" type="submit">Continuar</button>
                                </form>
                            </div>
                            <div id="debito" class="ui bottom attached tab" data-tab="debito" role="tabpanel">
                                
                            </div>
                            <div id="boleto" class="ui bottom attached tab " data-tab="boleto" role="tabpanel">
                                <button class="ui blue big button">Gerar Boleto</button>
                            </div>
                        <?php } else { ?>
                        	<h1>Grátis</h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (View_Fatura::Verificar_Fatura('aberta')) { ?>
            <div class="ui secondary segment">
            	<div class="ui stackable doubling five column internally celled grid">
                    <div class="center aligned column">
                    	<h4>Abertura</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Abertura('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Vencimento</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Vencimento('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Fechamento</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Fechamento('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Status</h4>
                    	<div class="ui mini statistic">
                            <div class="content"><?php View_Fatura::Mostrar_Status('aberta'); ?></div>
                        </div>
                    </div>
                    <div class="center aligned column">
                    	<h4>Valor Total</h4>
                    	<div class="ui mini statistic">
                            <div class="content">R$: <?php View_Fatura::Mostrar_Total('aberta'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="ui accordion">
                    <div id="title_fatura_aberta" class="title ui horizontal divider"><i class="icon dropdown"></i>Detalhes</div>
                    <div id="content_fatura_aberta" class="content">
                        SERVIÇOS:
                        <div class="ui relaxed large celled list">
                        	<?php if (!empty(View_Fatura::Retornar_Lista_Fatura_Servicos('aberta'))) { ?>
                            	<?php foreach (View_Fatura::Retornar_Lista_Fatura_Servicos('aberta') as $fatura_servicos) { ?>
                                	<div class="item">
                                		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo number_format($fatura_servicos->get_valor(), 2, ',', '.'); ?></div>
                                		<div class="content">Mensal, <?php View_Fatura::Mostrar_Abertura('aberta'); ?> até <?php View_Fatura::Mostrar_Fechamento('aberta'); ?></div>
                                	</div>
                            	<?php } ?>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if (!View_Fatura::Verificar_Fatura('fechada')) { echo '<h3>Erro: Nenhuma fatura encontrada em aberto</h3>'; } ?>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/fatura.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>