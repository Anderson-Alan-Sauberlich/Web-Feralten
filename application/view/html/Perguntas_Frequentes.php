<?php use application\view\src\Perguntas_Frequentes as View_Perguntas_Frequentes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<script type="text/javascript" src="/application/view/js/perguntas_frequentes.js"></script>
	<title>Perguntas Frequentes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<div class="ui grid">
        	<div class="eleven wide column">
                <div class="ui styled fluid accordion margem-inferior-pouco">
                	<div class="title"><i class="dropdown icon"></i> Titulo-1</div>
                	<div class="content">
                		<p class="transition hidden">Descrição-Descrição- Descrição-</p>
                	</div>
                	
                	<div class="title"><i class="dropdown icon"></i> Titulo-2</div>
                	<div class="content">
                		<p class="transition hidden">Descrição-Descrição- Descrição-</p>
                	</div>
                	
                	<div class="title"><i class="dropdown icon"></i> Titulo-3</div>
                	<div class="content">
                		<p class="transition hidden">Descrição-Descrição- Descrição-</p>
                	</div>
                	
                </div>
            </div>
            <div class="five wide column">
                <?php View_Perguntas_Frequentes::Incluir_Form_Contato(); ?>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>