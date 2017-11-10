<?php use module\application\view\src\usuario\meu_perfil\meus_dados\Atualizar as View_Atualizar; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
	<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
	<script type="text/javascript" src="/application/js/usuario/meu_perfil/meus_dados/atualizar.js"></script>
	<title>Atualizar | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Atualizar::Incluir_Menu_Usuario(); ?>
        <div class="panel-group">
            <?php View_Atualizar::Mostrar_Erros(); ?>
            <?php View_Atualizar::Mostrar_Sucesso(); ?>
            <form id="form_atualizar_usuario" name="form_atualizar_usuario" data-toggle="validator" enctype="multipart/form-data" action="/usuario/meu-perfil/meus-dados/atualizar/usuario/" method="post" role="form">
            	<div class="panel panel-default sombra_painel">
                	<div class="panel-heading sombra_painel centralizar">
                    	<label class="lbPanel">Atualizar Dados do Usuario</label>
                	</div>
                    <div class="panel-body dadosPanel">
                        <div class="col-sm-6">
                        	<div class="row">
                        		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<label for="nome" class="lbPanel">Digite Seu Nome:</label>
                                    <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("usuario", "nome"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="nome" name="nome" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "nome") ?>" placeholder="Nome" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite seu Nome. (Campo Obrigatório)" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="sobrenome" class="lbPanel">Digite Seu Sobrenome:</label>
                                    <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("usuario", "sobrenome"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="sobrenome" name="sobrenome" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "sobrenome") ?>" placeholder="Sobrenome" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite seu Sobrenome. (Campo Obrigatório)" />
                                    </div>
                                </div>
                            </div>
                            
                            <label for="email" class="lbPanel">Digite Seu E-Mail:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("usuario", "email"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "email") ?>" placeholder="E-Mail" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Este e-mail sera usado para gerenciar seu Cadastro e para acessar o Sistema. (Campo Obrigatório)" />
                            </div>
	                        <label for="email_alternativo" class="lbPanel">Digite Um E-Mail Alternativo:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("usuario", "email_alternativo"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email_alternativo" name="email_alternativo" type="email" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "email_alternativo") ?>" placeholder="E-Mail Alternativo" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Email neste campo o mesmo sera mostrado em seus dados, substituindo seu E-Mail de Usuario. (Campo Opcional)" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                        	<label for="fone" class="lbPanel">Digite Seu Numero de Telefone:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("usuario", "fone"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <input id="fone" name="fone" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "fone") ?>" placeholder="Fone Ex: (00) 0000-0000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone. (Campo Obrigatório)" />
                            </div>
                            <label for="fone_alternativo" class="lbPanel">Digite Seu Numero de Telefone Alternativo:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("entidade", "fone_alternativo"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <input id="fone_alternativo" name="fone_alternativo" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("usuario", "fone_alternativo") ?>" placeholder="Fone Ex: (00) 0000-0000" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros de seu telefone alternativo. (Campo Opcional)" />
                            </div>
	                        <div class="ui buttons linha_inteira btnAtualizar">
								<button id="salvar_usuario" name="salvar_usuario" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar_usuario" name="restaurar_usuario" value="1" type="submit" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
							</div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="form_atualizar_entidade" name="form_atualizar_entidade" data-toggle="validator" enctype="multipart/form-data" action="/usuario/meu-perfil/meus-dados/atualizar/entidade/" method="post" role="form">
                <div class="panel panel-default sombra_painel">
                    <div class="panel-heading sombra_painel centralizar">
                        <label class="lbPanel">Atualizar Dados da Entidade</label>
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
											<img id="foto" name="foto" onError="MostImgErr($this)" src="<?php View_Atualizar::Manter_Imagem() ?>">
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="cpf_cnpj" class="lbPanel">Digite Seu CPF ou CNPJ:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("entidade", "cpf_cnpj"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control disabled" disabled="disabled" value="<?php View_Atualizar::Manter_Valor("entidade", "cpf_cnpj"); ?>" placeholder="CPF / CNPJ" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os Numeros do seu CPF ou CNPJ. (Campo Obrigatório)" />
                            </div>
                            <label for="nome_comercial" class="lbPanel">Digite um Nome Comercial:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("entidade", "nome_comercial"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                <input id="nome_comercial" name="nome_comercial" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("entidade", "nome_comercial"); ?>" placeholder="Nome Comercial" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Ao Informar um Nome neste campo o mesmo sera mostrado em seus dados, substituindo seu Nome de Usuario. (Campo Opcional)" />
                            </div>
                            <label for="site" class="lbPanel">Digite o Endereço do seu Site:</label>
                            <div class="input-group <?php View_Atualizar::Incluir_Classe_Erros("entidade", "site"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                                <input id="site" name="site" type="text" class="form-control" value="<?php View_Atualizar::Manter_Valor("entidade", "site") ?>" placeholder="Ex: www.meusite.com.br" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Informe aqui o Endereço do seu site, caso você tenha. (Campo Opcional)" />
                            </div>
                            <div class="ui buttons linha_inteira btnAtualizar">
								<button id="salvar_entidade" name="salvar_entidade" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar_entidade" name="restaurar_entidade" value="1" type="submit" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
							</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>