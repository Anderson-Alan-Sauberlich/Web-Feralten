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
    	<img class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
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
                            <b>Com orçamentos gratuitos</b>
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
                            <b>Com orçamentos gratuitos</b>
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
                            <b>Com orçamentos gratuitos</b>
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
                            <b>Com orçamentos gratuitos</b>
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
                            <b>Com orçamentos gratuitos</b>
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
                            <b>Com orçamentos gratuitos</b>
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
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>