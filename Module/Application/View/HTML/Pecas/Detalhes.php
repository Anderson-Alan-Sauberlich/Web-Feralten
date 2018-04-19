<?php use Module\Application\View\SRC\Pecas\Detalhes as View_Detalhes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Detalhes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <div class="mrg-sup-det-pec"></div>
        <div class="ui doubling stackable grid">
            <div class="sixteen wide column">
                <h1 class="ui huge red dividing header"><?php View_Detalhes::Mostrar_Nome(); ?></h1>
            </div>
            <div class="sixteen wide column">
                <div class="ui doubling stackable two column grid">
                    <div class="column">
                        <h3 class="ui block header">Preço: <?php View_Detalhes::Mostrar_Preco(); ?></h3>
                    </div>
                    <?php if (View_Detalhes::Verificar_Fabricante()) { ?>
                        <div class="column">
                    		<h3 class="ui block header">Fabricante: <?php View_Detalhes::Mostrar_Fabricante(); ?></h3>
                		</div>
            		<?php } ?>
            		<?php if (View_Detalhes::Verificar_Estado_Uso()) { ?>
                        <div class="column">
                            <h3 class="ui block header">Estado de Uso: <?php View_Detalhes::Mostrar_Estado_Uso(); ?></h3>
                        </div>
                    <?php } ?>
                    <?php if (View_Detalhes::Verificar_Serie()) { ?>
                        <div class="column">
                            <h3 class="ui block header">Número de Série: <?php View_Detalhes::Mostrar_Serie(); ?></h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (View_Detalhes::Verificar_Descricao()) { ?>
                <div class="sixteen wide column">
                    <h4 class="ui grey block header">Descrição: <?php View_Detalhes::Mostrar_Descricao(); ?></h4>
                </div>
            <?php } ?>
        </div>
        <div class="margem-inferior-minimo"></div>
        <div class="ui doubling stackable grid">
            <div class="ten wide column">
                <div class="ui center aligned segment">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img onclick="abrirModal(1);" src="<?php View_Detalhes::Mostrar_Foto_Peca(1, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                            </div>
                            <div class="item">
                                <img onclick="abrirModal(2);" src="<?php View_Detalhes::Mostrar_Foto_Peca(2, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                            </div>
                            <div class="item">
                                <img onclick="abrirModal(3);" src="<?php View_Detalhes::Mostrar_Foto_Peca(3, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="ui basic modal">
                        <i class="close icon"></i>
                        <div class="image content">
                            <div id="carousel-modal" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li id="ol_indice0" data-target="#carousel-modal" data-slide-to="0" class="active"></li>
                                    <li id="ol_indice1" data-target="#carousel-modal" data-slide-to="1"></li>
                                    <li id="ol_indice2" data-target="#carousel-modal" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div id="item_indice0" class="item active">
                                        <img src="<?php View_Detalhes::Mostrar_Foto_Peca(1, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                                    </div>
                                    <div id="item_indice1" class="item">
                                        <img src="<?php View_Detalhes::Mostrar_Foto_Peca(2, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                                    </div>
                                    <div id="item_indice2" class="item">
                                        <img src="<?php View_Detalhes::Mostrar_Foto_Peca(3, '800x600'); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-modal" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-modal" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="six wide column">
                <div id="div_cnt_anc" class="ui secondary segment">
                    <h2 class="ui center aligned grey header">Contato com anunciante</h2>
                    <?php View_Detalhes::Incluir_Form_Contato_Anunciante(); ?>
                </div>
                <div id="msg_cnt_anc" class="ui hidden message">
                    <i class="close icon"></i>
                    <ul id="ul_cnt_anc"></ul>
                </div>
            </div>
        </div>
        <div class="margem-inferior-minimo"></div>
        <?php if (View_Detalhes::Verificar_Preferencia_Entrega()) { ?>
            <div class="ui secondary segment">
                <p><label class="ui big horizontal label">Preferencia de Entrega:</label> <?php View_Detalhes::Mostrar_Preferencia_Entrega(); ?></p>
            </div>
        <?php } ?>
        <div class="ui segment">
            <div class="ui doubling stackable three column center aligned grid">
                <div class="column">
                    <p><?php View_Detalhes::Mostrar_Estado(); ?></p>
                    <p><?php View_Detalhes::Mostrar_Cidade(); ?></p>
                    <?php if (View_Detalhes::Validar_Preferencia_Entrega(1)) { ?>
                        <p>Bairro: <?php View_Detalhes::Mostrar_Bairro(); ?></p>
                        <p>Rua: <?php View_Detalhes::Mostrar_Rua(); ?></p>
                        <p>Numero: <?php View_Detalhes::Mostrar_Numero(); ?></p>
                        <p>Cep: <?php View_Detalhes::Mostrar_Cep(); ?></p>
                        <?php if (View_Detalhes::Verificar_Complemento()) { ?>
                        	<p>Complemento: <?php View_Detalhes::Mostrar_Complemento(); ?></p>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="column">
                    <p>Telefone: <?php View_Detalhes::Mostrar_Fone_Responsavel(); ?></p>
                    <p>E-mail: <?php View_Detalhes::Mostrar_Email_Responsavel(); ?></p>
                    <?php if (View_Detalhes::Verificar_Fone_Alternativo_Responsavel()) { ?>
                    	<p>Telefone Alternativo: <?php View_Detalhes::Mostrar_Fone_Alternativo_Responsavel(); ?></p>
                    <?php } ?>
                    <?php if (View_Detalhes::Verificar_Email_Alternativo_Responsavel()) { ?>
                    	<p>E-mail Alternativo: <?php View_Detalhes::Mostrar_Email_Alternativo_Responsavel(); ?></p>
                    <?php } ?>
                </div>
                <div class="column">
                     <p><?php View_Detalhes::Mostrar_Nome_Comercial(); ?></p>
                     <?php if (View_Detalhes::Verificar_Site()) { ?>
                     	<p>Site: <?php View_Detalhes::Mostrar_Site(); ?></p>
                     <?php } ?>
                     <img class="ui centered small image" src="<?php View_Detalhes::Mostrar_Foto_Entidade(); ?>" onerror="this.src='/resources/img/imagem_indisponivel.png'">
                </div>
            </div>
        </div>
        <?php if (View_Detalhes::Validar_Pativeis()) { ?>
            <div class="ui segment">
                <?php View_Detalhes::Mostrar_Pativeis(); ?>
            </div>
        <?php } ?>
        <div class="margem-inferior-minimo"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/pecas/detalhes.js"></script>
    </footer>
</body>
</html>