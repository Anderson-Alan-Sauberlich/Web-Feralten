<?php require_once RAIZ.'/application/view/src/usuario/meu_perfil/meus_dados/atualizar.php'; ?>
<?php use application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head.php'; ?>
	<script type="text/javascript" src="/application/view/js/usuario/meu_perfil/meus_dados/atualizar.js"></script>
	<title>Atualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Atualizar::Incluir_Menu_Usuario(); ?>
        <div class="panel-group">
            <form id="form_atualizar" name="form_atualizar" data-toggle="validator" enctype="multipart/form-data" action="/usuario/meu-perfil/meus-dados/atualizar/" method="post" role="form">
                <?php View_Atualizar::Mostrar_Erros(); ?>
                <?php View_Atualizar::Mostrar_Sucesso(); ?>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Atualizar Dados do Login</label>
                    </div>
                    <div class="panel-body dadosPanel">
                        <div class="col-sm-6">
                            <label for="email" class="lbPanel">Digite Seu E-Mail:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("login", "email"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control" value="<?php View_Atualizar::Manter_Valor("login", "email") ?>" placeholder="E-Mail" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Este email sera usado para realizar a confirmação de seu Cadastro e para acessar o Sistema. (Campo Obrigatório)" />
                            </div>
	                        <label for="confemail" class="lbPanel">Digite Novamente Seu E-Mail:</label>
	                        <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("login", "confemail"); ?>">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	                            <input id="confemail" name="confemail" type="email" class="form-control" value="<?php View_Atualizar::Manter_Valor("login", "confemail") ?>" placeholder="Repetir E-Mail" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite seu e-mail novamente da mesma forma para Confirmilo. (Campo Obrigatório)" />
	                        </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="nome" class="lbPanel">Digite Seu Nome Completo:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("login", "nome"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nome" name="nome" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("login", "nome") ?>" placeholder="Nome" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite seu nome Completo. (Campo Obrigatório)" />
                            </div>
	                        <div class="ui buttons linha_inteira btnAtualizar">
								<button id="salvar_login" name="salvar_login" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar_login" name="restaurar_login" value="1" type="submit" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
							</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Atualizar Dados Do Usuario</label>
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
										<button id="remover_imagem" name="remover_imagem" onclick="limparCampoFile()" type="button" class="btn btn-danger btnImagens"><i class="glyphicon glyphicon-trash"></i> Remover Imagem</button>
									</div>
									<div class="col-md-5 col-sm-12 col-xs-12">
										<div class="ui small bordered image imagemPeca">
											<div id="div_img" class="ui dimmer"><div class="ui text loader">Carregando</div></div>
											<a onclick="limparCampoFile();" class="ui corner red label"><i class="remove circle icon"></i></a>
											<img id="foto" name="foto" onError="MostImgErr(this)" src="<?php View_Atualizar::Manter_Imagem() ?>">
										</div>
									</div>
                                </div>
                            </div>
                            <label for="fone1" class="lbPanel">Digite Seu Numero de Telefone-1:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("dadosusuario", "fone1"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <input id="fone1" name="fone1" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "fone1") ?>" placeholder="Fone Ex: (00) 000-000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone-1. (Campo Obrigatório)" />
                            </div>
                            <label for="fone2" class="lbPanel">Digite Seu Numero de Telefone-2:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("contato", "fone2"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <input id="fone2" name="fone2" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "fone2") ?>" placeholder="Fone Ex: (00) 000-000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone-2. (Campo Obcional)" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="cpf_cnpj" class="lbPanel">Digite Seu CPF ou CNPJ:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("dadosusuario", "cpf_cnpj"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "cpf_cnpj"); ?>" placeholder="CPF / CNPJ" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros do seu CPF ou CNPJ. (Campo Obrigatório)" />
                            </div>
                            <label for="nomedadosusuario" class="lbPanel">Digite um Nome Fantasia:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("dadosusuario", "nomedadosusuario"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                <input id="nomedadosusuario" name="nomedadosusuario" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "nomedadosusuario"); ?>" placeholder="Nome Fantasia" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Nome neste campo o mesmo sera mostrado em seus dados, substituindo seu Nome de Usuario.  (Campo Obcional)" />
                            </div>
                            <label for="site" class="lbPanel">Digite o Endereço do seu Site:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("dadosusuario", "site"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                                <input id="site" name="site" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "site") ?>" placeholder="Digite o Endereço do seu site" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Informe aqui o Endereço do seu site, caso você tenha. (Campo Obcional)" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="emailcontato" class="lbPanel">Digite Um E-Mail Alternativo:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("dadosusuario", "emailcontato"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="emailcontato" name="emailcontato" type="email" class="form-control" value="<?php View_Atualizar::Manter_Valor("dadosusuario", "emailcontato") ?>" placeholder="E-Mail Alternativo" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Email neste campo o mesmo sera mostrado em seus dados, substituindo seu E-Mail de Usuario.  (Campo Obcional)" />
                            </div>
                            <div class="ui buttons linha_inteira btnAtualizar">
								<button id="salvar_dadosusuario" name="salvar_dadosusuario" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar_dadosusuario" name="restaurar_dadosusuario" value="1" type="submit" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
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