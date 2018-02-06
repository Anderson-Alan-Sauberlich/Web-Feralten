<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos_Recebidos as View_Orcamentos_Recebidos; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Orcamentos_Recebidos::Incluir_Menu_Usuario(); ?>
        <div class="ui stackable relaxed grid">
        	<div class="five wide column">
        		<div class="ui fluid vertical menu">
                	<div class="active teal link item">Caixa de Entrega<div class="ui teal left pointing label"><?php View_Orcamentos_Recebidos::MostrarNumeroRecebido(); ?></div></div>
                	<div class="link item">Respondidos<div class="ui label"><?php View_Orcamentos_Recebidos::MostrarNumeroRespondido(); ?></div></div>
                	<div class="link item">Não Tenho<div class="ui label"><?php View_Orcamentos_Recebidos::MostrarNumeroNaoTenho(); ?></div></div>
                </div>
                <div class="ui fluid vertical menu">
                    <div class="active item">
                        <select class="ui fluid search selection scrolling dropdown">
                        	<option value="0">Todas as Categorias...</option>
                        </select>
                    	<div class="ui divider"></div>
                        <select class="ui fluid search selection scrolling dropdown">
                        	<option value="0">Todas as Marcas...</option>
                        </select>
                    	<div class="ui divider"></div>
                        <select class="ui fluid search selection scrolling dropdown">
                        	<option value="0">Todos os Modelos...</option>
                        </select>
                        <div class="ui divider"></div>
                        <select class="ui fluid search selection scrolling dropdown">
                        	<option value="0">Todas as Versões...</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="eleven wide column">
            	<?php View_Orcamentos_Recebidos::Incluir_Elemento_Orcamento(); ?>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos_recebidos.js"></script>
    </footer>
</body>
</html>