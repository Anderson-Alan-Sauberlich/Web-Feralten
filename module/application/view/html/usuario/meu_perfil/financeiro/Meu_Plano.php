<?php use module\application\view\src\usuario\meu_perfil\financeiro\Meu_Plano as View_Meu_Plano; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
	<title>Meu Plano | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Meu_Plano::Incluir_Menu_Usuario(); ?>
        <?php View_Meu_Plano::Incluir_Cards_Planos(); ?>
        <div class="margem-inferior-pouco"></div>
        <img src="/resources/img/formaspagamento.png" width="883" height="39" />
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>