<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once(RAIZ.'/application/view/html/include_page/head.php'); ?>
	<script type="text/javascript" src="/application/view/js/usuario/meu_perfil/meus_dados/concluir.js"></script>
	<title>Concluir Cadastro | Feralten</title>
</head>
<body>
    <header>
        <?php include_once(RAIZ.'/application/view/html/include_page/cabecalho.php'); ?>
    </header>
    <section class="ui container" role="main">
    	<?php self::Incluir_Menu_Usuario(); ?>
        <?php self::Mostrar_Erros(); ?>
        <form id="cnclr_form" name="cnclr_form" data-toggle="validator" enctype="multipart/form-data" action="/usuario/meu-perfil/meus-dados/concluir/" method="post" role="form">
        	<div class="panel panel-default sombra_painel">
                <div class="panel-heading sombra_painel centralizar">
                    <label class="lbPanel">Concluir Cadastro</label>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="panel-body dadosPanel">
                            <div class="col-sm-6">
                                <label for="fone1" class="lbPanel">Digite Seu Numero de Telefone-1:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("fone1"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    <input id="fone1" name="fone1" type="text" class="form-control" value="<?php self::Manter_Valor("fone1"); ?>" placeholder="Fone Ex: (00) 000-000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone-1. (Campo Obrigatório)" />
                                </div>
                                <label for="fone2" class="lbPanel">Digite Seu Numero de Telefone-2:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("fone2"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    <input id="fone2" name="fone2" type="text" class="form-control" value="<?php self::Manter_Valor("fone2"); ?>" placeholder="Fone Ex: (00) 000-000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone-2.  (Campo Obcional)" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="emailcontato" class="lbPanel">Digite Um E-Mail Alternativo:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("emailcontato"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="emailcontato" name="emailcontato" type="email" class="form-control" value="<?php self::Manter_Valor("emailcontato"); ?>" placeholder="E-Mail Alternativo" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Email neste campo o mesmo sera mostrado em seus dados, substituindo seu E-Mail de Usuario.  (Campo Obcional)" />
                                </div>
                            </div>
                        </div>
                        <div class="panel-body dadosPanel">
                            <div class="col-sm-6">
                                <label for="estado" class="lbPanel">Selecione Seu Estado:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("estado"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <select id="estado" name="estado" class="form-control form_select">
                                        <option value="0">Selecione seu Estado</option>
                                        <?php self::Mostrar_Estados(); ?>
                                    </select>
                                    <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                                </div>
                                <label for="cidade" class="lbPanel">Selecione Sua Cidade:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("cidade"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <select id="cidade" name="cidade" class="form-control form_select">
                                    	<option value="0">Selecione sua Cidade</option>
                                        <?php self::Mostrar_Cidades(); ?>
                                    </select>
                                    <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                                </div>
                                <label for="bairro" class="lbPanel">Digite o Nome do Bairro:</label>
                                <div class="input-group  <?php self::Incluir_Classe_Erros("bairro"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <input id="bairro" name="bairro" type="text" class="form-control" value="<?php self::Manter_Valor("bairro"); ?>" placeholder="Bairro" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o Nome Completo do Bairro. (Campo Obrigatório)" />
                                </div>
                                <label for="rua" class="lbPanel">Digite o Nome da Rua:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("rua"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <input id="rua" name="rua" type="text" class="form-control" value="<?php self::Manter_Valor("rua"); ?>" placeholder="Rua" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o nome Completo da Rua. (Campo Obrigatório)" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="numero" class="lbPanel">Digite o Numero do Estabelecimento:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("numero"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input id="numero" name="numero" type="text" class="form-control" value="<?php self::Manter_Valor("numero"); ?>" placeholder="Numero" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o Numero do Endereço. (Campo Obrigatório)" />
                                </div>
                                <label for="cep" class="lbPanel">Digite Seu CEP:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("cep"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="cep" name="cep" type="text" class="form-control" value="<?php self::Manter_Valor("cep"); ?>" placeholder="CEP" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os numeros do seu CEP. (Campo Obrigatório)" />
                                </div>
                                <label for="complemento" class="lbPanel">Digite um Complemento do Endereço:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("complemento"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                    <input id="complemento" name="complemento" type="text" class="form-control" value="<?php self::Manter_Valor("complemento"); ?>" placeholder="Complemento" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite um Complememento de Referencia para o Endereço.  (Campo Obcional)" />
                                </div>
                            </div>
                        </div>
                        <div class="panel-body dadosPanel">
                            <div class="col-sm-6">
                                <label for="imagem" class="lbPanel">Selecione uma Foto, Logo Marca ou Imagem de Capa:</label>
								<div class="thumbnail">
									<div class="row">
										<div class="col-md-7 col-sm-12 col-xs-12">
											<span id="adicionar_imagem" name="adicionar_imagem" class="btn btn-primary btn-file btn-lg btnImagens">
												<i class="glyphicon glyphicon-upload"></i> Adicionar Imagem
												<input id="imagem" value="" accept="image/*" name="imagem" onchange="loadFile(event);" type="file">
											</span>
											<button id="remover_imagem" name="remover_imagem" onclick="limparCampoFile();" type="button" class="btn btn-danger btnImagens"><i class="glyphicon glyphicon-trash"></i> Remover Imagem</button>
										</div>
										<div class="col-md-5 col-sm-12 col-xs-12">
											<div class="ui small bordered image imagemPeca">
												<div id="div_img" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
												<a onclick="limparCampoFile();" class="ui corner red label"><i class="remove circle icon"></i></a>
												<img id="foto" name="foto" src="<?php self::Manter_Imagem() ?>">
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="cpf_cnpj" class="lbPanel">Digite Seu CPF ou CNPJ:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("cpf_cnpj"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                    <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control" value="<?php self::Manter_Valor("cpf_cnpj"); ?>" placeholder="CPF / CNPJ" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros do seu CPF ou CNPJ. (Campo Obrigatório)" />
                                </div>
                                <label for="nomedadosusuario" class="lbPanel">Digite um Nome Fantasia:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("nomedadosusuario"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                    <input id="nomedadosusuario" name="nomedadosusuario" type="text" class="form-control" value="<?php self::Manter_Valor("nomedadosusuario"); ?>" placeholder="Nome Fantasia" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Nome neste campo o mesmo sera mostrado em seus dados, substituindo seu Nome de Usuario.  (Campo Obcional)" />
                                </div>
                                <label for="site" class="lbPanel">Digite o Endereço do seu Site:</label>
                                <div class="input-group <?php self::Incluir_Classe_Erros("site"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                                    <input id="site" name="site" type="text" class="form-control" value="<?php self::Manter_Valor("site") ?>" placeholder="Digite o Endereço do seu site" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Informe aqui o Endereço do seu site, caso você tenha. (Campo Obcional)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer sombra_painel">
                    <button type="submit" id="concluir" name="concluir" class="big ui green button btnConcluir"><i class="glyphicon glyphicon-floppy-saved"></i> Concluir Cadastro</button>
                </div>
            </div>
        </form>
    </section>
    <footer>
        <?php include_once(RAIZ.'/application/view/html/include_page/rodape.php'); ?>
    </footer>
</body>
</html>