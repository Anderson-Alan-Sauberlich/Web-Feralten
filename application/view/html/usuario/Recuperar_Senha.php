<?php use application\view\src\usuario\Recuperar_Senha as View_Recuperar_Senha; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/layout/head/Default.php'; ?>
	<title>Recuperar-Senha | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/layout/header/Cabecalho.php'; ?>
        <script type="text/javascript" src="/js/usuario/recuperar_senha.js"></script>
    </header>
    <section class="ui container" role="main">
    	<div class="ui two column stackable grid">
    		<div class="column">
    			<h1>Recuperar Senha</h1>
        		<div id="sgm_recuperar_senha" class="ui secondary segment">
            		<?php if (View_Recuperar_Senha::Verificar_Codigo_Setado()) { ?>
            			<form data-toggle="validator" role="form">
							<label for="senha_nova" class="lbPanel">Digite Uma Nova Senha:</label>
	                        <div id="div_senha_nova" class="input-group">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="senha_nova" name="senha_nova" type="password" autocomplete="off" class="form-control" placeholder="Nova Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A Senha deve ter no minimo 6 caracteres e no maximo 20. (Campo Obrigatório)" />
								<span class="input-group-addon">
			                        <div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar_senha_nova" name="mostrar_senha_nova" onchange="Mostrar_Senha_Nova()">
										<label for="mostrar_senha_nova"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
								</span>
	                        </div>
	                        <label for="senha_confnova" class="lbPanel">Digite a Nova Senha Novamente:</label>
	                        <div id="div_senha_confnova" class="input-group">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="senha_confnova" name="senha_confnova" type="password" autocomplete="off" class="form-control" placeholder="Confirmar Nova Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite a Senha novamente da mesma forma para Confirma-lá. (Campo Obrigatório)" />
								<span class="input-group-addon">
									<div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar_senha_confnova" name="mostrar_senha_confnova" onchange="Mostrar_Senha_ConfNova()">
										<label for="mostrar_senha_confnova"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
								</span>
	                        </div>
		                    <div class="ui buttons linha_inteira btnAtualizar">
								<div id="salvar" onclick="Salvar('<?php View_Recuperar_Senha::Mostrar_Codigo(); ?>');" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</div>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar" type="reset" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Limpar</button>
							</div>
            			</form>
            		<?php } else { ?>
                		<form class="ui form" data-toggle="validator" role="form">
                            <div id="div_email" class="field">
                                <label for="email">Digite seu e-mail. Em breve você receberá um link para redefinir sua senha</label>
                                <input id="email" name="email" placeholder="E-Mail" type="email">
                            </div>
                        	<div class="ui red button" onclick="Enviar();">Enviar Link</div>
                		</form>
            		<?php } ?>
            	</div>
           	</div>
           	<div class="column">
           		<h1>Recuperar E-Mail</h1>
           		<div class="ui secondary segment">
           			<p>Esqueceu seu e-mail? Envie uma mensagem atravez da pagina Fale Conosco. O título do assunto deve ser “Esqueci meu e-mail”. Na mensagem, informe seu nome completo, telefone e CPF.</p>
           		</div>
           	</div>
    	</div>
        <div id="mdl_enviar" class="ui modal">
            <div id="mdl_header" class="header"></div>
            <div id="mdl_content" class="content"></div>
            <div class="actions">
                <div class="ui approve positive right labeled icon button">Continuar <i class="checkmark icon"></i></div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/application/view/html/layout/footer/Rodape.php'; ?>
    </footer>
</body>
</html>