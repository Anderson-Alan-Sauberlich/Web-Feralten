<?php use module\application\view\src\usuario\meu_perfil\pecas\Visualizar as View_Visualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
    <script type="text/javascript" src="/js/usuario/meu_perfil/pecas/visualizar.js"></script>
	<script type="text/javascript" src="/js/layout/card_peca.js"></script>
	<title>Visualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Visualizar::Incluir_Menu_Usuario(); ?>
		<div class="container-fluid margem-inferior-pouco">
			<form id="searschform" class="form-horizontal" name="searschform" action="/usuario/meu-perfil/pecas/visualizar/" method="get" role="form">
				<div class="row">
					<?php View_Visualizar::Incluir_Menu_Pesquisa(); ?>
					<div class="col-sm-4 col-md-3 col-lg-3">
						<?php View_Visualizar::Incluir_Menu_Filtro(); ?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
						<div class="row">
							<div class="ui three stackable doubling link raised cards" id="div_pecas">
								<?php View_Visualizar::Mostrar_Cards_Pecas(); ?>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php View_Visualizar::Incluir_Menu_Paginacao(); ?>
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>