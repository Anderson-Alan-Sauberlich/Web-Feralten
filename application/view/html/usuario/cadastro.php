<?php require_once RAIZ.'/application/view/src/usuario/cadastro.php'; ?>
<?php use application\view\src\usuario\Cadastro as View_Cadastro; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/default.php'; ?>
	<script type="text/javascript" src="/application/view/js/usuario/cadastro.js"></script>
	<title>Cadastro | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <div class="row margem-superior-pouco margem-inferior-pouco">
        	<?php View_Cadastro::Mostrar_Erros(); ?>
           	<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default borderPainel sombra_painel">
                    <form id="cadform" name="cadform" data-toggle="validator" action="/usuario/cadastro/" method="post" role="form">
                        <div class="panel-title titulo">
                           	<label>Crie uma conta</label>
                        </div>
                        <div class="panel-body cadPanel">
                            <label for="nome" class="lbPanel">Digite Seu Nome Completo:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("nome");  ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nome" name="nome" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("nome") ?>" placeholder="Nome" autofocus="true" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite seu nome Completo. (Campo Obrigatório)" />
                            </div>
                            <label for="email" class="lbPanel">Digite Seu E-Mail:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("email");  ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control" value="<?php View_Cadastro::Manter_Valor("email") ?>" placeholder="E-Mail" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Este email sera usado para realizar a confirmação de seu Cadastro e para acessar o Sistema. (Campo Obrigatório)" />
                            </div>
                            <label for="confemail" class="lbPanel">Digite Novamente Seu E-Mail:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("confemail");  ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="confemail" name="confemail" type="email" class="form-control" value="<?php View_Cadastro::Manter_Valor("confemail") ?>" placeholder="Repetir E-Mail" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite seu e-mail novamente da mesma forma para Comfirmilo. (Campo Obrigatório)" />
                            </div>
                            <label for="senha" class="lbPanel">Digite Uma Senha:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("senha");  ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="senha" name="senha" autocomplete="off" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("senha") ?>" placeholder="Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A Senha deve ter no minimo 6 caracteres e no maximo 20. (Campo Obrigatório)" />
			          			<span class="input-group-addon">
			          				<div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar" name="mostrar" onchange="MostrarSenha()">
										<label for="mostrar"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
			          			</span>
                            </div>
                        </div>
                        <div class="panel-footer sombra_painel">
                        	<button type="submit" class="big ui green button"><i class="add user icon"></i>Criar Conta</button>
                        	<label>Já possui uma conta? <a href="/usuario/login/">Clique aqui para Entrar!</a></label>
                        	<div class="ui checkbox">
								<input type="checkbox" checked="checked" id="email_marketing" name="email_marketing" value="1">
								<label for="email_marketing">Desejo receber promoções e oportunidades exclusivas do Feralten e de seus parceiros</label>
							</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/include_page/footer/rodape.php'; ?>
    </footer>
</body>
</html>