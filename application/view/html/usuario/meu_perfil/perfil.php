<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once(RAIZ.'/application/view/html/include_page/head.php'); ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php include_once(RAIZ.'/application/view/html/include_page/cabecalho.php'); ?>
    </header>
    <section class="ui container" role="main">
        <?php self::Incluir_Menu_Usuario(); ?>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="lbPanel">Peças Cadastradas</label>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="lbPanel">Mensagens Recebidas</label>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once(RAIZ.'/application/view/html/include_page/rodape.php'); ?>
    </footer>
</body>
</html>