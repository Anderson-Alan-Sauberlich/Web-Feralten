<?php use Module\Application\View\SRC\Perguntas_Frequentes as View_Perguntas_Frequentes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script type="text/javascript" src="/application/js/perguntas_frequentes.js"></script>
    <title>Perguntas Frequentes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
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
                <div id="div_contato" class="ui secondary segment">
                    <?php View_Perguntas_Frequentes::Incluir_Form_Contato(); ?>
                </div>
                <div id="msg_contato" class="ui hidden message">
                    <i class="close icon"></i>
                    <ul id="ul_contato"></ul>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>