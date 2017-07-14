<?php use application\view\src\pecas\Resultados as View_Resultados; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<script type="text/javascript" src="/application/view/js/include_page/card_peca.js"></script>
	<title>Resultados | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<div class="container-fluid margem-inferior-pouco">
			<form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
				<div class="row">
					<?php View_Resultados::Incluir_Menu_Pesquisa(); ?>
					<div class="col-sm-4 col-md-3 col-lg-3">
						<?php View_Resultados::Incluir_Menu_Filtro(); ?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
						<div class="row">
							<div class="ui three stackable doubling link raised cards" id="div_pecas">
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
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>