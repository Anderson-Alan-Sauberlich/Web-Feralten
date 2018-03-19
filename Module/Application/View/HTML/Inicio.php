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
    </section>
    <div class="margem-inferior-minimo"></div>
    <div class="ui basic secondary vertical segment">
    	<div class="margem-inferior-minimo"></div>
    	<section class="ui container" role="main">
       		<h2 class="ui red header">
       			<div class="content">
       				Chega de perder tempo correndo atrás de peças, encontre e anuncie todas aqui no Feralten.
       			</div>
       		</h2>
       		<h2 class="ui header">
       			<div class="sub header">
       				O site Feralten é um portal de anúncios, que visa aumentar os lucros e facilitar as vendas entre Ferros Velhos, Oficinas Mêcanicas e Pessoas Interessadas em peças originais, usadas ou novas.
       			</div>
       		</h2>
    	</section>
    	<div class="margem-inferior-minimo"></div>
    </div>
    <img src="/resources/img/fundo_pecas1.jpg" class="ui fluid image" />
    <div class="ui basic secondary vertical segment">
    	<div class="margem-inferior-minimo"></div>
    	<section class="ui container" role="main">
    		<div class="ui two column very relaxed stackable grid">
        		<div class="column">
               		<h2 class="ui red header">Por que Anunciar no Feralten?</h2>
               		<h2 class="ui header">
               			<div class="sub header">
               				Portal exclusivo para negociantes de peças usadas;<br/>
               				Único portal da área no Brasil;<br/>
               				Com menos de 1 café por dia você é visto pelo mês todo, lembre-se, quem é visto é  lembrado!
               			</div>
               		</h2>
           		</div>
           		<div class="column">
           			<h2 class="ui red header">Confira as nossas dicas para vender mais e melhor! Acesse: <a href="/dicas-de-venda/">Dicas de Venda</a></h2>
           		</div>
       		</div>
    	</section>
    	<div class="margem-inferior-minimo"></div>
    </div>
    <div class="margem-superior-minimo"></div>
    <section class="ui container" role="main">
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