<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Pecas\Cadastrar as View_Cadastrar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
    <script type="text/javascript" src="/application/js/usuario/meu_perfil/pecas/cadastrar.js"></script>
    <title>Cadastrar | Feralten</title>
</head>
<body>
    <header>
        <?php View_Cadastrar::Incluir_Header_Usuario(); ?>
    </header>
    <section class="ui container" role="main">
        <div class="panel-group">
            <form id="form_cadastrar_pecas" name="form_cadastrar_pecas" data-toggle="validator" enctype="multipart/form-data" class="form-horizontal" action="/usuario/meu-perfil/pecas/cadastrar/<?php View_Cadastrar::MostrarURLOrcamento(); ?>" method="post" role="form">
                <?php View_Cadastrar::Mostrar_Sucesso(); ?>
                <?php View_Cadastrar::Mostrar_Erros(); ?>
                <div class="panel panel-default ">
                    <div class="panel-heading centralizar">
                    	<h3 class="ui header disabled">Compatibilidade da Peça</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <h4><label class="lbPanel">Categoria:</label></h4>
                            <div class="well well-sm">
                                <div class="container-fluid">
                                    <div id="div_categoria" class="row">
                                        <?php View_Cadastrar::Carregar_Categorias(); ?>
                                    </div>
                                </div>
                            </div>
                            <h4><label class="lbPanel">Marca:</label></h4>
                            <div class="well well-sm">
                                <div class="container-fluid">
                                    <div id="div_marca" class="row">
                                        <?php View_Cadastrar::Carregar_Marcas(); ?>
                                    </div>
                                </div>
                            </div>
                            <h4><label class="lbPanel">Modelo:</label></h4>
                            <div class="well well-sm">
                                <div class="container-fluid">
                                    <div id="div_modelo" class="row">
                                        <?php View_Cadastrar::Carregar_Modelos(); ?>
                                    </div>
                                </div>
                            </div>
                            <h4><label class="lbPanel">Versão:</label></h4>
                            <div class="well well-sm">
                                <div class="container-fluid">
                                    <div id="div_versao" class="row">
                                        <?php View_Cadastrar::Carregar_Versoes(); ?>
                                    </div>
                                </div>
                            </div>
                            <h4><label class="lbPanel">Ano:</label></h4>
                            <div class="well well-sm">
                                <div class="container-fluid">
                                    <div id="div_ano" class="row">
                                        <?php View_Cadastrar::Carregar_Anos(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading centralizar">
                        <h3 class="ui header disabled">Informações da Peça</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                        	<div class="row">
                                <div class="col-sm-6">
                                    <label for="peca" class="lbPanel">Nome da Peça:</label>
                                    <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("peca"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                                        <input id="peca" name="peca" type="text" class="form-control" value="<?php View_Cadastrar::Manter_Valor("peca") ?>" placeholder="Nome da Peça, Ex: Porta" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fabricante" class="lbPanel">Fabricante/Marca da Peça:</label>
                                    <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("fabricante"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                                        <input id="fabricante" name="fabricante" type="text" class="form-control" value="<?php View_Cadastrar::Manter_Valor("fabricante") ?>" placeholder="Nome do Fabricante/Marca, Ex: Original" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="serie" class="lbPanel">Numero de Série da Peça:</label>
                                    <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("serie"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                        <input id="serie" name="serie" type="text" class="form-control" value="<?php View_Cadastrar::Manter_Valor("serie") ?>" placeholder="Numero de Serie da Peça" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="preco" class="lbPanel">Preço da Peça:</label>
                                    <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("preco"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input id="preco" name="preco" type="text" class="form-control" value="<?php View_Cadastrar::Manter_Valor("preco") ?>" placeholder="Preço da Peça" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Pratique Preço Justo! Lembre-se, o Feralten não cobra comissão!" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="estado_uso_uso" class="lbPanel">Selecione o Estado de Uso da Peça:</label>
                                    <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("estado_uso"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
                                        <select id="estado_uso" name="estado_uso" class="form-control form_select">
                                            <option value="0">Selecione</option>
                                            <?php View_Cadastrar::Mostrar_Estado_Uso(); ?>
                                        </select>
                                        <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <label for="descricao" class="lbPanel">Descrição da Peça:</label>
                                <div class="input-group <?php View_Cadastrar::Incluir_Classe_Erros("descricao"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <textarea rows="3" id="descricao" name="descricao" class="form-control" placeholder="Descrição da Peça, detalhes e observações importantes para tornar a peça mais fácil de ser encontrada na pesquisa."><?php View_Cadastrar::Manter_Valor("descricao") ?></textarea>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <label for="preferencia_entrega" class="lbPanel">Selecione Suas Preferencias de Entrega:</label>
                                <select id="preferencia_entrega" name="preferencia_entrega[]" multiple="multiple" class="ui fluid multiple scrolling search selection dropdown">
                                    <option value="">Preferencias de Entrega</option>
                                    <?php View_Cadastrar::Mostrar_Preferencia_Entrega(); ?>
                                </select>
                            </div>
                            <div class="row-fluid">
                                <div class="ui toggle checkbox">
                                	<input name="vip" <?php View_Cadastrar::Manter_Valor('vip'); ?> type="checkbox">
                                	<label class="lbPanel"><b>Anúncio VIP.</b> A peça será destacada das demais e compartilhadas nas redes sociais.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading centralizar">
                    	<h3 class="ui header disabled">Adicionar Fotos</h3>
                    </div>
                    <div class="panel-body <?php View_Cadastrar::Incluir_Classe_Erros("imagem"); ?>">
                        <div id="drop_zone" class="row-fluid">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="row-fluid">
                                    <span id="adicionar_imagem" class="btn btn-primary btn-file btn-lg btnImagensPeca">
                                        <i class="glyphicon glyphicon-upload"></i> Adicionar Fotos
                                        <input id="imagens" value="" accept="image/*" multiple="multiple" type="file">
                                    </span>
                                </div>
                                <div class="row-fluid">
                                    <button id="remover_imagem" name="remover_imagem" onClick="limparCampoFile(123);" type="button" class="btn btn-danger btnImagensPeca"><i class="glyphicon glyphicon-trash"></i> Remover Fotos</button>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-8 col-xs-12">
                                <div class="ui medium bordered image imagemPeca">
                                    <div id="img1" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
                                    <a onClick="limparCampoFile(1);" class="ui corner red label"><i class="remove circle icon"></i></a>
                                    <img id="foto1" name="foto1" onError="MostImgErr(this);" src="<?php View_Cadastrar::Manter_Imagens("foto1") ?>">
                                </div>
                                <div class="ui small bordered image imagemPeca">
                                    <div id="img2" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
                                    <a onClick="limparCampoFile(2);" class="ui corner red label"><i class="remove circle icon"></i></a>
                                    <img id="foto2" name="foto2" onError="MostImgErr(this);" src="<?php View_Cadastrar::Manter_Imagens("foto2") ?>">
                                </div>
                                <div class="ui small bordered image imagemPeca">
                                    <div id="img3" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
                                    <a onClick="limparCampoFile(3);" class="ui corner red label"><i class="remove circle icon"></i></a>
                                    <img id="foto3" name="foto3" onError="MostImgErr(this);" src="<?php View_Cadastrar::Manter_Imagens("foto3") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row-fluid">
                        	<div onclick="Submit_Salvar();" id="salvar" class="ui big green button"><i class="glyphicon glyphicon-floppy-saved"></i> Cadastrar Peça</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="margem-inferior-medio"></div>
        <div id="mdl_msg" class="ui small modal">
            <i class="close icon"></i>
            <div id="msg_header" class="header">Deseja continuar?</div>
            <div id="msg_content" class="content"></div>
            <div class="actions">
                <div id="btn_cancelar" class="ui cancel button">Cancelar</div>
                <div id="btn_aceitar" class="ui approve positive right labeled icon button">Aceitar <i class="checkmark icon"></i></div>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>