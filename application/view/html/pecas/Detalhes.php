<?php use application\view\src\pecas\Detalhes as View_Detalhes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<title>Detalhes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<div class="ui segment">
    		<h1><?php View_Detalhes::Mostrar_Nome(); ?></h1>
    		<h3>Fabricante: <?php View_Detalhes::Mostrar_Fabricante(); ?></h3>
    		<h3>Preço: <?php View_Detalhes::Mostrar_Preco(); ?></h3>
    		<h3>Estado de Uso: <?php View_Detalhes::Mostrar_Estado_Uso(); ?></h3>
    		<h3>Número de Série: <?php View_Detalhes::Mostrar_Serie(); ?></h3>
    		<h4>Descrição: <?php View_Detalhes::Mostrar_Descricao(); ?></h4>
		</div>
		<div class="ui doubling stackable grid">
			<div class="ten wide column">
                <div class="ui center aligned segment">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    	<ol class="carousel-indicators">
                    		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    	</ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img width="600" height="450" onclick="abrirModal(1);" src="<?php View_Detalhes::Mostrar_Foto(1, '600x450'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                            </div>
                            <div class="item">
                                <img width="600" height="450" onclick="abrirModal(2);" src="<?php View_Detalhes::Mostrar_Foto(2, '600x450'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                            </div>
                            <div class="item">
                                <img width="600" height="450" onclick="abrirModal(3);" src="<?php View_Detalhes::Mostrar_Foto(3, '600x450'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="ui basic modal">
                    	<i class="close icon"></i>
                        <div class="image content">
                            <div id="carousel-modal" class="carousel slide" data-ride="carousel">
                            	<ol class="carousel-indicators">
                            		<li id="ol_indice0" data-target="#carousel-modal" data-slide-to="0" class="active"></li>
                            		<li id="ol_indice1" data-target="#carousel-modal" data-slide-to="1"></li>
                            		<li id="ol_indice2" data-target="#carousel-modal" data-slide-to="2"></li>
                            	</ol>
                                <div class="carousel-inner" role="listbox">
                                    <div id="item_indice0" class="item active">
                                        <img width="800" height="600" onclick="" src="<?php View_Detalhes::Mostrar_Foto(1, '800x600'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                                    </div>
                                    <div id="item_indice1" class="item">
                                        <img width="800" height="600" onclick="" src="<?php View_Detalhes::Mostrar_Foto(2, '800x600'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                                    </div>
                                    <div id="item_indice2" class="item">
                                        <img width="800" height="600" onclick="" src="<?php View_Detalhes::Mostrar_Foto(3, '800x600'); ?>" onerror="this.src='/application/view/resources/img/imagem_indisponivel.png'">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-modal" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-modal" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="six wide column">
            	<div class="ui center aligned segment">
           			<label>Contate o Vendedor</label>
           			<p>Nome</p>
           			<p>Email</p>
           			<p>Telefone</p>
           			<p>Mensagem</p>
        		</div>
            </div>
        </div>
        <div class="ui segment">
           	<?php View_Detalhes::Mostrar_Pativeis(); ?>
        </div>
        <div class="ui divider"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/view/js/pecas/detalhes.js"></script>
    </footer>
</body>
</html>