<?php use module\application\view\src\usuario\Login as View_Login; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/module/application/view/html/layout/head/Default.php'; ?>
	<script type="text/javascript" src="/application/js/usuario/login.js"></script>
	<title>Login | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/module/application/view/html/layout/header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
    	<div class="row margem-inferior-pouco margem-superior-pouco">
            <?php View_Login::Mostrar_Erros(); ?>
            <?php View_Login::Mostrar_Sucesso(); ?>
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            	<div class="panel panel-default borderPainel sombra_painel">
	                <form id="loginform" name="loginform" data-toggle="validator" method="post" action="/usuario/login/" role="form">
	                    <div class="panel-title titulo">
	                        <label>Acesse a sua conta</label>
	                    </div>
	                    <div class="panel-body loginPanel">
                            <label for="email" class="lbPanel">Digite seu E-mail:</label>
                            <div class="input-group menuRowMD <?php View_Login::Incluir_Classe_Erros('email'); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" value="<?php View_Login::Manter_Valor('email'); ?>" placeholder="Endereço de Email" autofocus="autofocus" />
                            </div>
                            <label for="password" class="lbPanel">Digite sua Senha:</label>
                            <div class="input-group menuRowMD <?php View_Login::Incluir_Classe_Erros('senha'); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off" value="<?php View_Login::Manter_Valor('senha'); ?>" placeholder="Senha" />
		          				<span class="input-group-addon">
			                        <div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar" name="mostrar" onchange="MostrarSenha()">
										<label for="mostrar"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
		          				</span>
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
			                        <div class="ui checked checkbox">
										<input type="checkbox" checked="checked" id="manter_login" name="manter_login" value="1"/>
										<label for="manter_login" class="lbPanel">Mantenha-me Conectado</label>
									</div>
                                </div>
                                <div class="col-sm-5">
                                	<button id="btn-login" type="submit" class="big ui green button bnt-100"><i class="sign in icon"></i>Entrar</button>
                                </div>
                            </div>
                    	</div>
                    	<div class="panel-footer sombra_painel">
                        	<div class="loginDivfooter" >
                            	<div class="row">
                                	<div class="col-sm-7">
                                    	<label>Não tem uma conta? <a href="/usuario/cadastro/">Crie uma agora!</a></label>
                                    </div>
                                    <div class="col-sm-5">
                            			<a href="/usuario/recuperar-senha/">Esqueceu a Senha ou E-mail?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/module/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>