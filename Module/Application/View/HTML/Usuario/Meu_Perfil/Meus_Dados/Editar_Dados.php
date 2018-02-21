<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados as View_Editar_Dados; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
    <title>Editar Dados | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Editar_Dados::Incluir_Menu_Usuario(); ?>
        <h2 class="ui dividing header">Dados do usuario</h2>
        <?php View_Editar_Dados::Incluir_View_Usuario(); ?>
        <div class="margem-inferior-pouco"></div>
        <h2 class="ui dividing header">Dados da entidade</h2>
        <?php View_Editar_Dados::Incluir_View_Entidade(); ?>
        <div class="margem-inferior-pouco"></div>
        <h2 class="ui dividing header">Dados do endereço</h2>
        <?php View_Editar_Dados::Incluir_View_Endereco(); ?>
        <div class="margem-inferior-pouco"></div>
        <?php if (!View_Editar_Dados::VerificaLoginEntidade()) { ?>
        	<button id="concluir" name="concluir" class="ui big green button"><i class="glyphicon glyphicon-floppy-saved"></i> Concluir Cadastro</button>
        	<div class="margem-inferior-pouco"></div>
        <?php } ?>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>