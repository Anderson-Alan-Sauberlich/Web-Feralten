<?php use application\view\src\usuario\meu_perfil\pecas\Atualizar as View_Atualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
    <script type="text/javascript" src="/application/view/js/usuario/meu_perfil/pecas/atualizar.js"></script>
	<title>Atualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <?php View_Atualizar::Incluir_Menu_Usuario(); ?>
            
		<div class="panel-group">
            <form id="form_atualizar_pecas" name="form_atualizar_pecas" data-toggle="validator" enctype="multipart/form-data" class="form-horizontal" action="/usuario/meu-perfil/pecas/atualizar/<?php View_Atualizar::Mostrar_Id_Peca(); ?>/" method="post" role="form">
                <?php View_Atualizar::Mostrar_Sucesso(); ?>
                <?php View_Atualizar::Mostrar_Erros(); ?>
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
										<?php View_Atualizar::Carregar_Categorias(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Marca do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_marca" class="row">
										<?php View_Atualizar::Carregar_Marcas(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Modelo do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_modelo" class="row">
										<?php View_Atualizar::Carregar_Modelos(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Versão do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_versao" class="row">
										<?php View_Atualizar::Carregar_Versoes(); ?>
			                        </div>
			                    </div>
	                        </div>
	                       	<h4><label class="lbPanel">Ano do Veiculo Compativel:</label></h4>
							<div class="well well-sm">
			                    <div class="container-fluid">
			                    	<div id="div_ano" class="row">
										<?php View_Atualizar::Carregar_Anos(); ?>
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
		                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("peca"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
		                                <input id="peca" name="peca" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("peca") ?>" placeholder="Nome da Peça, Ex: Porta" />
		                            </div>
	                            </div>
	                            <div class="col-sm-6">
		                            <label for="fabricante" class="lbPanel">Digite o Nome do Fabricante/Marca:</label>
		                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("fabricante"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
		                                <input id="fabricante" name="fabricante" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("fabricante") ?>" placeholder="Nome do Fabricante/Marca, Ex: Original" />
		                            </div>
	                            </div>
                            </div>
                            <div class="row">
                               	<div class="col-sm-6">
		                            <label for="serie" class="lbPanel">Digite o Numero de Serie da Peça:</label>
		                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("serie"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
		                                <input id="serie" name="serie" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("serie") ?>" placeholder="Numero de Serie da Peça" />
		                            </div>
		                        </div>
                               	<div class="col-sm-3">
		                            <label for="preco" class="lbPanel">Digite Preço da Peça:</label>
		                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("preco"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
		                                <input id="preco" name="preco" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("preco") ?>" placeholder="Preço da Peça" />
		                            </div>
		                        </div>
		                        <div class="col-sm-3">
		                            <label for="status" class="lbPanel">Selecione o Estado da Peça:</label>
		                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("status"); ?>">
		                                <span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
		                                <select id="status" name="status" class="form-control form_select">
		                                    <option value="0">Selecione</option>
		                                    <?php View_Atualizar::Mostrar_Status(); ?>
		                                </select>
		                                <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                                   	</div>
		                        </div>
	                        </div>
							<div class="row-fluid">
	                            <label for="descricao" class="lbPanel">Digite a Descrição da Peça:</label>
	                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("descricao"); ?>">
	                                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
	                                <textarea rows="3" id="descricao" name="descricao" class="form-control" placeholder="Descrição da Peça, detalhes e observações inportantes para tornar a peça mais facil de ser encontrada na pesquisa."><?php View_Atualizar::Manter_Valor("descricao") ?></textarea>
	                            </div>
                            </div>
                            <div class="row-fluid">
		                        <div class="ui checkbox">
									<input type="checkbox" id="prioridade" name="prioridade" <?php View_Atualizar::Manter_Valor("prioridade") ?> value="checked"/>
									<label for="prioridade" class="lbPanel">Acresentar Alta Prioridade Para a Peça. <small>(Será uma das primeiras a ser exibida por um custo a mais de R$: 5,00)</small></label>
								</div>
							</div>
							<div class="row-fluid">
								<label for="preferencia_entrega" class="lbPanel">Selecione Suas Preferencias de Entrega:</label>
		                        <select id="preferencia_entrega" name="preferencia_entrega[]" class="ui fluid multiple scrolling search selection dropdown">
		                        	<option value="">Preferencias de Entrega</option>
		                        	<?php View_Atualizar::Mostrar_Preferencia_Entrega(); ?>
		                        </select>
							</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Adicionar Fotos</label>
                    </div>
                    <div class="panel-body <?php View_Atualizar::Incluir_Classe_Erros("imagem"); ?>">
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
									<img id="foto1" name="foto1" onError="MostImgErr(this)" src="<?php View_Atualizar::Manter_Imagens("foto1") ?>">
								</div>
								<div class="ui small bordered image imagemPeca">
									<div id="img2" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
									<a onClick="limparCampoFile(2);" class="ui corner red label"><i class="remove circle icon"></i></a>
									<img id="foto2" name="foto2" onError="MostImgErr(this)" src="<?php View_Atualizar::Manter_Imagens("foto2") ?>">
								</div>
								<div class="ui small bordered image imagemPeca">
									<div id="img3" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
									<a onClick="limparCampoFile(3);" class="ui corner red label"><i class="remove circle icon"></i></a>
									<img id="foto3" name="foto3" onError="MostImgErr(this)" src="<?php View_Atualizar::Manter_Imagens("foto3") ?>">
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-body">
                        <div class="row-fluid">
                            <button id="restaurar" name="restaurar" value="1" type="submit" class="hidden-xs pull-right big ui button"><i class="glyphicon glyphicon-refresh"></i> Limpar</button>
                            <button id="salvar" name="salvar" value="1" type="submit" class="hidden-xs pull-left big ui green button"><i class="glyphicon glyphicon-floppy-saved"></i> Atualizar Peça</button>
                        </div>
                        <div class="row visible-xs">
	                        <div class="large ui buttons bntCadPeca">
								<button id="salvar" name="salvar" value="1" type="submit" class="ui positive button">Atualizar Peça</button>
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
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>