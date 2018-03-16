<?php use Module\Application\View\SRC\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Peças Novas e Usadas de Carros, Motos, Camihões, Ônibus e Muito Mais em Ferro Velho, Oficinas e Lojas | Feralten</title>
	<?php include_once RAIZ.'/Module/Application/View/HTML/Common/Util/Gtag.php'; ?>
</head>
<body>
    <?php View_Inicio::Carregar_Loader(); ?>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <img class="ui fluid image headIMG" src="/resources/img/header_fundo.jpg"/>
    <section class="ui container" role="main">
        <form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
            <?php View_Inicio::Incluir_Menu_Pesquisa(); ?>
        </form>
        <div class="margem-superior-grande"></div>
        <h1 class="ui red huge dividing header">Nossos Patrocinadores</h1>
        <div class="ui four column doubling grid">
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/patrocinadores/Feralten_logo_Transparente_mini.png"/>
            	</a>
            </div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/patrocinadores/Feralten_logo_Transparente_mini.png"/>
            	</a>
            </div>
            <div class="column">
           		<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/patrocinadores/Feralten_logo_Transparente_mini.png"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/patrocinadores/Feralten_logo_Transparente_mini.png"/>
            	</a>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>