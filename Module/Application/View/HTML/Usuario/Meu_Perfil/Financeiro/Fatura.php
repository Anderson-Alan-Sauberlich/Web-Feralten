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
            	<div class="ui stackable doubling six column internally celled grid">
            		<div class="center aligned column">
            			<h4>Fatura Fechada</h4>
                    	<div class="ui mini statistic">
                            <div class="content">#<?php View_Fatura::Mostrar_ID('fechada'); ?></div>
                        </div>
                    </div>
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
                        	<?php foreach (View_Fatura::Retornar_Lista_Fatura_Servicos('fechada') as $fatura_servicos) { ?>
                            	<div class="item">
                            		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo $fatura_servicos->get_valor(); ?></div>
                            		<div class="content">Mensal, <?php View_Fatura::Mostrar_Abertura('fechada'); ?> até <?php View_Fatura::Mostrar_Fechamento('fechada'); ?></div>
                            	</div>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (View_Fatura::Verificar_Fatura('aberta')) { ?>
            <div class="ui secondary segment">
            	<div class="ui stackable doubling six column internally celled grid">
            		<div class="center aligned column">
            			<h4>Fatura Aberta</h4>
            			<div class="ui mini statistic">
                            <div class="content">#<?php View_Fatura::Mostrar_ID('aberta'); ?></div>
                        </div>
                    </div>
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
                        	<?php foreach (View_Fatura::Retornar_Lista_Fatura_Servicos('aberta') as $fatura_servicos) { ?>
                            	<div class="item">
                            		<div class="header"><?php echo $fatura_servicos->get_descricao(); ?>, valor R$: <?php echo $fatura_servicos->get_valor(); ?></div>
                            		<div class="content">Mensal, <?php View_Fatura::Mostrar_Abertura('aberta'); ?> até <?php View_Fatura::Mostrar_Fechamento('aberta'); ?></div>
                            	</div>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { echo '<h3>Erro: Nenhuma fatura encontrada em aberto</h3>'; } ?>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/fatura.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>