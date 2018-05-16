<?php use Module\Application\View\SRC\Mapa_Do_Site as View_Mapa_Do_Site; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Mapa do Site | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
        <img id="header_logo_fundo" class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
    	<h1 class="ui red huge dividing header">Mapa do Site</h1>
        <div class="margem-inferior-minimo"></div>
        <div class="ui text justified container">
            <div class="ui very relaxed divided list">
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/" class="header">Página Inicial</a>
            			<div class="description">Voltar ao início do site.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/vendedores/" class="header">Nossos Vendedores</a>
            			<div class="description">Lista de todos os usuários com peças cadastradas.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/orcamentos/" class="header">Orçamentos Solicitados</a>
            			<div class="description">Lista de todos os orçamentos de peças solicitadas.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/pecas/resultados/" class="header">Peças Cadastradas</a>
            			<div class="description">Lista de todas as peças cadastradas.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/fale-conosco/" class="header">Fale Conosco</a>
            			<div class="description">Envie um e-mail para a nossa equipe de suporte.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/usuario/cadastro/" class="header">Cadastre-se</a>
            			<div class="description">Crie um usuário e solicite ou cadastre todas as peças que você quiser.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/usuario/login/" class="header">Entrar</a>
            			<div class="description">Acesse sua conta de usuário.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/quem-somos/" class="header">Quem Somos</a>
            			<div class="description">Uma breve descrição do nosso objetivo.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/dicas-de-venda/" class="header">Dicas de Venda</a>
            			<div class="description">Algumas dicas para vender mais e melhor.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/usuario/recuperar-senha/" class="header">Recuperar Senha ou E-mail</a>
            			<div class="description">Esqueceu sua senha ou e-mail, solicite uma nova senha ou entre em contato.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/perguntas-frequentes/" class="header">Perguntas Frequentes</a>
            			<div class="description">Algumas perguntas e respostas que podem ajudar você.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/termos-de-uso/" class="header">Termos de Uso</a>
            			<div class="description">Ao se cadastrar, você concorda com os Termos de Uso do Feralten.</div>
            		</div>
            	</div>
            	<div class="item">
            		<i class="large angle double right middle aligned icon"></i>
            		<div class="content">
            			<a href="https://www.feralten.com.br/politica-de-privacidade/" class="header">Politica de Privacidade</a>
            			<div class="description">Ao se cadastrar, você concordo com a Política de Privacidade do Feralten.</div>
            		</div>
            	</div>
            </div>
        	<div class="margem-inferior-pouco"></div>
        </div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/mapa_do_site.js"></script>
    </footer>
</body>
</html>