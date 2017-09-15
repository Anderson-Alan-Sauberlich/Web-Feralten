<?php use application\view\src\usuario\Recuperar_Senha as View_Recuperar_Senha; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once RAIZ.'/application/view/html/include_page/head/Default.php'; ?>
	<title>Recuperar-Senha | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/application/view/html/include_page/header/Cabecalho.php'; ?>
        <script type="text/javascript" src="/application/view/js/usuario/recuperar_senha.js"></script>
    </header>
    <section class="ui container" role="main">
    	<div class="ui two column stackable grid">
    		<div class="column">
    			<h1>Recuperar Senha</h1>
        		<div id="sgm_recuperar_senha" class="ui secondary segment">
            		<form class="ui form" role="form">
                        <div id="div_email" class="field">
                            <label for="email">Digite seu e-mail. Em breve você receberá um link para redefinir sua senha</label>
                            <input id="email" name="email" placeholder="E-Mail" type="email">
                        </div>
                    	<div class="ui red button" onclick="Enviar();">Enviar Link</div>
            		</form>
            	</div>
           	</div>
           	<div class="column">
           		<h1>Recuperar E-Mail</h1>
           		<div class="ui secondary segment">
           			<p>Esqueceu seu e-mail? Envie um e-mail para Fale Conosco. O título do assunto deve ser “Esqueci meu e-mail”. Na mensagem, informe seu nome completo, telefone e CPF.</p>
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
        <?php include_once RAIZ.'/application/view/html/include_page/footer/Rodape.php'; ?>
    </footer>
</body>
</html>