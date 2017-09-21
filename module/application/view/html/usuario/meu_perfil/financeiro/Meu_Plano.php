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
            
		<div class="container-fluid">
            <div class="row-fluid">
                <img src="/resources/img/contrucao.png" position="center" class="img-responsive centerIMG" />
            </div>
        </div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>