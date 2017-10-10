<?php use module\application\view\src\usuario\meu_perfil\financeiro\Historico as View_Historico; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
	<title>Historico | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Historico::Incluir_Menu_Usuario(); ?>
            
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