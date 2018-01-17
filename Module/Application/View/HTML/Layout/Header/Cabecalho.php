<?php use Module\Application\View\SRC\Layout\Header\Cabecalho as View_Cabecalho; ?>
<section class="margem-inferior-pouco">
<script type="text/javascript" src="/application/js/layout/header/cabecalho.js"></script>
    <nav class="navbar navbar-default navbar-fixed-top navbar-titulo" role="navigation">
        <div class="ui container">
             <div class="navbar-header">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                     <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Feralten</a>
            </div>
            <div class="collapse navbar-collapse" id="collapseNav">
                <ul class="nav navbar-nav navbar-left pull-left">
                    <li><a href="/"><i class="home icon"></i>INÍCIO</a></li>
                    <li id="pecas_item"><a href="#"><i class="puzzle icon"></i>PEÇAS</a></li>
                    <li id="ferro_velho_item"><a href="#"><i class="configure icon"></i>MEMBROS</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <?php View_Cabecalho::Verificar_Usuario_Autenticado(); ?>
                </ul>
            </div>
        </div>
    </nav>
</section>