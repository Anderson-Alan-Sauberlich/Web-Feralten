<?php use Module\Application\View\SRC\Planos_Mensais as View_Planos_Mensais; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Planos Mensais | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<img id="header_logo_fundo" class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
    	<h1 class="ui red huge dividing header">Planos Mensais</h1>
        <div class="margem-inferior-minimo"></div>
		<div class="ui secondary segment">
            <div class="ui doubling raised inverted grey stackable link three cards">
                <div onclick="btn_plano(1);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Até <?php View_Planos_Mensais::Mostrar_Limite_Pecas(1); ?></h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(1); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                GRÁTIS
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_1" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
                <div onclick="btn_plano(2);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Até <?php View_Planos_Mensais::Mostrar_Limite_Pecas(2); ?></h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(2); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                <?php View_Planos_Mensais::Mostrar_Valor(2); ?>
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_2" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
                <div onclick="btn_plano(3);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Até <?php View_Planos_Mensais::Mostrar_Limite_Pecas(3); ?></h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(3); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                <?php View_Planos_Mensais::Mostrar_Valor(3); ?>
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_3" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
                <div onclick="btn_plano(4);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Até <?php View_Planos_Mensais::Mostrar_Limite_Pecas(4); ?></h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(4); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                <?php View_Planos_Mensais::Mostrar_Valor(4); ?>
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_4" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
                <div onclick="btn_plano(5);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Até <?php View_Planos_Mensais::Mostrar_Limite_Pecas(5); ?></h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(5); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                <?php View_Planos_Mensais::Mostrar_Valor(5); ?>
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_5" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
                <div onclick="btn_plano(6);" class="card">
                    <div class="content">
                        <div class="center aligned header">
                            <h1>Sem limites</h1>
                        </div>
                        <div class="center aligned meta">
                            <h3>Peças<br>Simultaneamente</h3>
                        </div>
                    </div>
                    <div class="content">
                        <div class="description">
                            <p><b>Com <label class="ui circular large label"><?php View_Planos_Mensais::Mostrar_Limite_Pecas_Vip(6); ?></label> anúncios VIP</b></p>
                            <p><b>Com orçamentos gratuitos</b></p>
                        </div>
                    </div>
                    <div class="center aligned content">
                        <div class="ui orange statistic">
                            <div class="label">
                                <h3>R$:</h3>
                            </div>
                            <div class="value">
                                <?php View_Planos_Mensais::Mostrar_Valor(6); ?>
                            </div>
                            <div class="label meta">
                                <span>/mês</span>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                           <a href="/usuario/cadastro/" id="btn_plano_6" class="ui fluid massive button">Contratar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
        <h1 class="ui center aligned red dividing header">Uma plataforma mais do que completa</h1>
        <h2 class="ui red header">
        	<i class="chart line icon"></i>
        	<div class="content">
        		Maior Visibilidade
        		<div class="sub header">Sua marca e suas peças com os melhores resultados no Google</div>
        	</div>
        </h2>
        <h2 class="ui red header">
        	<i class="sitemap icon"></i>
        	<div class="content">
        		Painel de Controle
        		<div class="sub header">Gerencie todos os seus anúncios e mensagens</div>
        	</div>
        </h2>
        <h2 class="ui red header">
        	<i class="comments icon"></i>
        	<div class="content">
        		Contato por WhatsApp e Email
        		<div class="sub header">Seu cliente negocia diretamente com você</div>
        	</div>
        </h2>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/planos_mensais.js"></script>
    </footer>
</body>
</html>