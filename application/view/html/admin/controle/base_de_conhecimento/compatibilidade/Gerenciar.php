<?php use application\view\src\admin\controle\base_de_conhecimento\compatibilidade\Gerenciar as View_Gerenciar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/layout/head/Admin.php'; ?>
	<title>Gerenciar-Compatibilidade | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/layout/header/Admin.php'; ?>    
    </header>
    <section class="ui container" role="main">
		<?php View_Gerenciar::Incluir_Menu_Admin(); ?>
        <div class="ui pointing secondary three item menu" role="tablist">
        	<a data-tab="cadastrar" class="active item" role="tab">Cadastrar</a>
        	<a data-tab="alterar" class="item" role="tab">Alterar</a>
        	<a data-tab="deletar" class="item" role="tab">Deletar</a>
        </div>
        <div id="cadastrar" class="ui bottom attached active tab" data-tab="cadastrar" role="tabpanel">
        	<?php View_Gerenciar::Incluir_Pagina_Cadastrar(); ?>
        </div>
        <div id="alterar" class="ui bottom attached tab" data-tab="alterar" role="tabpanel">
        	<?php View_Gerenciar::Incluir_Pagina_Alterar(); ?>
        </div>
        <div id="deletar" class="ui bottom attached tab " data-tab="deletar" role="tabpanel">
        	<?php View_Gerenciar::Incluir_Pagina_Deletar(); ?>
        </div>
    </section>
    <footer>
        <?php //include_once RAIZ.'/application/view/html/layout/Rodape.php'; ?>
        <script type="text/javascript" src="/js/admin/controle\base_de_conhecimento\compatibilidade\gerenciar.js"></script>
    </footer>
</body>
</html>