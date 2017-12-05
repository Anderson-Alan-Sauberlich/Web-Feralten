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
        <div class="ui secondary segment">
        	<div class="ui stackable doubling six column internally celled grid">
        		<div class="center aligned column">
        			<h4>Fatura Aberta</h4>
        			<div class="ui mini statistic">
                        <div class="value">#2204</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Abertura</h4>
                	<div class="ui mini statistic">
                        <div class="value">15/07/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Vencimento</h4>
                	<div class="ui mini statistic">
                        <div class="value">15/07/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Fechamento</h4>
                	<div class="ui mini statistic">
                        <div class="value">15/08/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Status</h4>
                	<div class="ui mini statistic">
                        <div class="value">Aberta</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Valor Total</h4>
                	<div class="ui mini statistic">
                        <div class="value">R$: 58,00</div>
                    </div>
                </div>
            </div>
            <div class="ui accordion">
                <div id="title_fatura_aberta" class="title ui horizontal divider"><i class="icon dropdown"></i>Detalhes</div>
                <div id="content_fatura_aberta" class="content">
                    <p>Pagamento Indisponivel</p>
                </div>
            </div>
        </div>
        <div class="ui raised piled segment">
        	<div class="ui stackable doubling six column internally celled grid">
        		<div class="center aligned column">
        			<h4>Fatura Fechada</h4>
                	<div class="ui mini statistic">
                        <div class="value">#2204</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Abertura</h4>
                    <div class="ui mini statistic">
                        <div class="value">15/07/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Vencimento</h4>
                    <div class="ui mini statistic">
                        <div class="value">15/07/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Fechamento</h4>
                    <div class="ui mini statistic">
                        <div class="value">15/08/1994</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Status</h4>
                    <div class="ui mini statistic">
                        <div class="value">Fechada</div>
                    </div>
                </div>
                <div class="center aligned column">
                	<h4>Valor Total</h4>
                    <div class="ui mini statistic">
                        <div class="value">R$: 58,00</div>
                    </div>
                </div>
            </div>
            <div class="ui accordion">
                <div id="title_fatura_fechada" class="title ui horizontal divider active"><i class="icon dropdown"></i>Detalhes</div>
                <div id="content_fatura_fechada" class="content active">
                    
                </div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
    	<script type="text/javascript" src="/application/js/usuario/meu_perfil/financeiro/fatura.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>