<?php use application\view\src\admin\controle\base_de_conhecimento\cmmv\Cadastrar as View_Cadastrar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Admin.php'; ?>
	<title>Cad CMMV | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Admin.php'; ?>
    </header>
    <section class="ui container" role="main">
		<?php View_Cadastrar::Incluir_Menu_Admin(); ?>
    	<div class="margem-superior-pouco"></div>
	    <div id="div_msg"></div>
		<form class="ui form">
			<h4 class="ui dividing header">Selecione a sequência pertencente a nova informação:</h4>
			<div class="two fields">
				<div class="field">
					<select id="categoria" name="categoria" class="ui fluid scrolling search selection dropdown">
						<?php View_Cadastrar::Carregar_Categorias(); ?>
					</select>
				</div>
				<div class="field">
					<select id="marca" name="marca" class="ui fluid scrolling search selection dropdown">
						<option value="0">Marca</option>
					</select>
				</div>
			</div>
			<div class="two fields">
				<div class="field">
					<select id="modelo" name="modelo" class="ui fluid scrolling search selection dropdown">
						<option value="0">Modelo</option>
					</select>
				</div>
				<div class="field">
					<select id="versao" name="versao" class="ui fluid scrolling search selection dropdown">
						<option value="0">Versão</option>
					</select>
				</div>
			</div>
			<h4 class="ui dividing header">Nome e URL da nova informação:</h4>
			<div class="two fields">
				<div class="field">
					<input type="text" id="nome" name="nome" placeholder="Nome (1° Letra Maiuscula)" class="ui fluid"/>
				</div>
				<div class="field">
					<input type="text" id="url" name="url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui fluid"/>
				</div>
			</div>
	    </form>
	    <div class="cmmv_salvar">
	    	<h4 class="ui dividing header">A Cadastrar: <label class="ui big label" id="lb_item">Categoria</label></h4>
	       	<button id="salvar" name="salvar" onclick="SalvarCadastrar()" class="ui fluid inverted green button ">Salvar e Cadastrar</button>
	    </div>
    </section>
    <footer>
        <?php //include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>   
        <script type="text/javascript" src="/application/view/js/admin/controle\base_de_conhecimento\cmmv\cadastrar.js"></script>     
    </footer>
</body>
</html>