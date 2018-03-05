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
        <?php View_Editar_Dados::Incluir_Menu_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <h2 class="ui red dividing header">Dados do usuario</h2>
        <?php View_Editar_Dados::Incluir_View_Usuario(); ?>
        <br/>
        <h2 class="ui red dividing header">Dados da entidade</h2>
        <?php View_Editar_Dados::Incluir_View_Entidade(); ?>
        <br/>
        <h2 class="ui red dividing header">Dados do endereço</h2>
        <?php View_Editar_Dados::Incluir_View_Endereco(); ?>
        <?php if (!View_Editar_Dados::VerificaLoginEntidade()) { ?>
        	<h2 class="ui dividing header"></h2>
        	<button id="concluir" name="concluir" onclick="SalvarDados()" class="ui big green button"><i class="glyphicon glyphicon-floppy-saved"></i> Concluir Cadastro</button>
        <?php } ?>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/meus_dados/editar_dados.js"></script>
    </footer>
</body>
</html>