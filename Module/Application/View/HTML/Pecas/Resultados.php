<?php use Module\Application\View\SRC\Pecas\Resultados as View_Resultados; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script type="text/javascript" src="/application/js/layout/elemento/card_peca.js"></script>
    <title>Resultados | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <div class="container-fluid margem-inferior-pouco">
            <div class="hidden-xs">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Peças/Resultados -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-6647185654470379"
                     data-ad-slot="2240216118"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
                <div class="row">
                    <?php View_Resultados::Incluir_Menu_Pesquisa(); ?>
                    <div class="col-sm-4 col-md-3 col-lg-3">
                        <?php View_Resultados::Incluir_Menu_Filtro(); ?>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="ui three stackable doubling raised cards" id="div_pecas">
                                <?php View_Resultados::Mostrar_Cards_Pecas(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php View_Resultados::Incluir_Menu_Paginacao(); ?>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>