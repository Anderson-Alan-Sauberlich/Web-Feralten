<?php use Module\Application\View\SRC\Vendedores as View_Vendedores; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Vendedores | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<img class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
    	<h1 class="ui red huge dividing header">Nossos Vendedores</h1>
        <div class="ui text container margem-inferior-pouco">
            <div class="margem-inferior-minimo"></div>
            <div class="ui very relaxed divided items">
            	<?php View_Vendedores::IncluirElementoVendedor(); ?>
            </div>
        </div>
        <div class="hidden-xs">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Vendedores -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6647185654470379"
                 data-ad-slot="9547736782"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>