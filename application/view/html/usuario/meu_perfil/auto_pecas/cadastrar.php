<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
    <script type="text/javascript" src="/application/view/js/usuario/meu_perfil/auto_pecas/cadastrar.js"></script>
	<title>Cadastrar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php self::Incluir_Menu_Usuario(); ?>
        <div class="panel-group">
            <form id="form_cadastrar_peca" name="form_cadastrar_peca" data-toggle="validator" enctype="multipart/form-data" class="form-horizontal" action="/usuario/meu-perfil/auto-pecas/cadastrar/" method="post" role="form">
                <?php self::Mostrar_Sucesso(); ?>
                <?php self::Mostrar_Erros(); ?>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Compatibilidade Com Marcas e Modelos dos Veiculos</label>
                    </div>
                    <div class="panel-body">
                       	<div class="row-fluid">
	                       	<h4><label class="lbPanel">Categoria do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_categoria" class="row">
										<?php self::Carregar_Categorias(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Marca do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_marca" class="row">
										<?php self::Carregar_Marcas(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Modelo do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_modelo" class="row">
										<?php self::Carregar_Modelos(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Versão do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_versao" class="row">
										<?php self::Carregar_Versoes(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Ano do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_ano" class="row">
										<?php self::Carregar_Anos(); ?>
			                        </div>
			                    </div>
	                        </div>
                       	</div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Informações da Peça</label>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                           	<div class="row">
                           		<div class="col-sm-6">
		                            <label for="peca" class="lbPanel">Digite o Nome da Peça:</label>
		                            <div class="input-group <?php self::Incluir_Classe_Erros("peca"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
		                                <input id="peca" name="peca" type="text" class="form-control" value="<?php self::Manter_Valor("peca") ?>" placeholder="Nome da Peça, Ex: Porta" />
		                            </div>
	                            </div>
	                            <div class="col-sm-6">
		                            <label for="fabricante" class="lbPanel">Digite o Nome do Fabricante/Marca:</label>
		                            <div class="input-group <?php self::Incluir_Classe_Erros("fabricante"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
		                                <input id="fabricante" name="fabricante" type="text" class="form-control" value="<?php self::Manter_Valor("fabricante") ?>" placeholder="Nome do Fabricante/Marca, Ex: Original" />
		                            </div>
	                            </div>
                            </div>
                            <div class="row">
                               	<div class="col-sm-6">
		                            <label for="serie" class="lbPanel">Digite o Numero de Serie da Peça:</label>
		                            <div class="input-group <?php self::Incluir_Classe_Erros("serie"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
		                                <input id="serie" name="serie" type="text" class="form-control" value="<?php self::Manter_Valor("serie") ?>" placeholder="Numero de Serie da Peça" />
		                            </div>
		                        </div>
                               	<div class="col-sm-3">
		                            <label for="preco" class="lbPanel">Digite Preço da Peça:</label>
		                            <div class="input-group <?php self::Incluir_Classe_Erros("preco"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
		                                <input id="preco" name="preco" type="text" class="form-control" value="<?php self::Manter_Valor("preco") ?>" placeholder="Preço da Peça" />
		                            </div>
		                        </div>
		                        <div class="col-sm-3">
		                            <label for="status" class="lbPanel">Selecione o Estado da Peça:</label>
		                            <div class="input-group <?php self::Incluir_Classe_Erros("status"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
		                                <select id="status" name="status" class="form-control form_select">
		                                    <option value="0">Selecione</option>
		                                    <?php self::Mostrar_Status(); ?>
		                                </select>
		                                <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                                   	</div>
		                        </div>
	                        </div>
	                        <div class="row-fluid">
		                        <div class="ui checkbox">
									<input type="checkbox" id="prioridade" name="prioridade" <?php self::Manter_Valor("prioridade") ?> value="checked"/>
									<label for="prioridade" class="lbPanel">Acresentar Alta Prioridade Para a Peça. <small>(Será uma das primeiras a ser exibida por um custo a mais de R$: 5,00)</small></label>
								</div>
							</div>
							<div class="row-fluid">
	                            <label for="descricao" class="lbPanel">Digite a Descrição da Peça:</label>
	                            <div class="input-group <?php self::Incluir_Classe_Erros("descricao"); ?>">
	                                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
	                                <textarea rows="3" id="descricao" name="descricao" type="text" class="form-control" placeholder="Descrição da Peça, detalhes e observações inportantes para tornar a peça mais facil de ser encontrada na pesquisa."><?php self::Manter_Valor("descricao") ?></textarea>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Adicionar Fotos</label>
                    </div>
                    <div class="panel-body <?php self::Incluir_Classe_Erros("imagem"); ?>">
                        <div id="drop_zone" class="row-fluid">
                	       	<div class="col-md-3 col-sm-4 col-xs-12">
                           		<div class="row-fluid">
									<span id="adicionar_imagem" name="adicionar_imagem" class="btn btn-primary btn-file btn-lg btnImagensPeca">
										<i class="glyphicon glyphicon-upload"></i> Adicionar Fotos
										<input id="imagens" value="" accept="image/*" multiple="multiple" type="file">
									</span>
								</div>
								<div class="row-fluid">
									<button id="remover_imagem" name="remover_imagem" onclick="limparCampoFile(123);" type="button" class="btn btn-danger btnImagensPeca"><i class="glyphicon glyphicon-trash"></i> Remover Fotos</button>
			                    </div>
                           	</div>
							<div class="col-md-9 col-sm-8 col-xs-12">
								<div class="ui medium bordered image imagemPeca">
									<div id="img1" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
									<a onclick="limparCampoFile(1);" class="ui corner red label"><i class="remove circle icon"></i></a>
									<img id="foto1" name="foto1" src="<?php self::Manter_Imagens("foto1") ?>">
								</div>
								<div class="ui small bordered image imagemPeca">
									<div id="img2" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
									<a onclick="limparCampoFile(2);" class="ui corner red label"><i class="remove circle icon"></i></a>
									<img id="foto2" name="foto2" src="<?php self::Manter_Imagens("foto2") ?>">
								</div>
								<div class="ui small bordered image imagemPeca">
									<div id="img3" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
									<a onclick="limparCampoFile(3);" class="ui corner red label"><i class="remove circle icon"></i></a>
									<img id="foto3" name="foto3" src="<?php self::Manter_Imagens("foto3") ?>">
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-body">
                        <div class="row-fluid">
                            <button id="restaurar" name="restaurar" value="1" type="submit" class="hidden-xs pull-right big ui button"><i class="glyphicon glyphicon-refresh"></i> Limpar</button>
                            <button id="salvar" name="salvar" value="1" type="submit" class="hidden-xs pull-left big ui green button"><i class="glyphicon glyphicon-floppy-saved"></i> Cadastrar Peça</button>
                        </div>
                        <div class="row visible-xs">
	                        <div class="large ui buttons bntCadPeca">
								<button id="salvar" name="salvar" value="1" type="submit" class="ui positive button">Cadastrar Peça</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar" name="restaurar" value="1" type="submit" class="ui button">Limpar</button>
							</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/rodape.php'; ?>
    </footer>
</body>
</html>