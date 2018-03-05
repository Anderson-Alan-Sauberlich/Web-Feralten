<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Financeiro\Historico as View_Historico; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Historico | Feralten</title>
</head>
<body>
    <header>
        <?php View_Historico::Incluir_Menu_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
            
        <div class="container-fluid">
            <div class="row-fluid">
                <img src="/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>