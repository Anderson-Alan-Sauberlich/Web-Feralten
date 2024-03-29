<?php use Module\Application\View\SRC\Usuario\Cadastro as View_Cadastro; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=pt" async defer></script>
    <title>Cadastro | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
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
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="nome" class="lbPanel">Seu Nome:</label>
                                    <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("nome"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="nome" name="nome" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("nome") ?>" placeholder="Nome" autofocus="autofocus" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite Apenas seu Nome. (Campo Obrigatório)" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="sobrenome" class="lbPanel">Seu Sobrenome:</label>
                                    <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("sobrenome"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="sobrenome" name="sobrenome" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("sobrenome") ?>" placeholder="Sobrenome" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite seu Sobrenome. (Campo Obrigatório)" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="telefone" class="lbPanel">Seu Telefone:</label>
                                    <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("telefone"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                        <input id="telefone" name="telefone" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("telefone") ?>" placeholder="Ex.: (00) 0000-0000" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite Apenas os Números (Campo Obrigatório)" />
                                    </div>
                                </div>
                            </div>
                            <label for="email" class="lbPanel">Seu E-Mail:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("email"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control" value="<?php View_Cadastro::Manter_Valor("email") ?>" placeholder="E-Mail" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Este e-mail sera usado para gerenciar seu Cadastro e acessar o Sistema. (Campo Obrigatório)" />
                            </div>
                            <label for="senha" class="lbPanel">Crie Uma Senha:</label>
                            <div class="input-group <?php View_Cadastro::Incluir_Classe_Erros("senha"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="senha" name="senha" autocomplete="off" type="text" class="form-control" value="<?php View_Cadastro::Manter_Valor("senha") ?>" placeholder="Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A Senha deve ter no minimo 6 caracteres e no máximo 20. (Campo Obrigatório)" />
                                  <span class="input-group-addon">
                                      <div class="ui checkbox passCheck">
                                        <input type="checkbox" id="mostrar" name="mostrar" onchange="MostrarSenha()">
                                        <label for="mostrar"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
                                    </div>
                                  </span>
                            </div>
                            <div class="lbPanel">
                                <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeGszcUAAAAAJe8rA1Id_3ecGcA5GvceGO572jQ"></div>
                            </div>
                        </div>
                        <div class="panel-footer sombra_painel">
                            <button id="btn_cadastrar" type="submit" onclick="BtnCadastrarLoading()" class="ui big green button"><i class="add user icon"></i>Criar Conta</button>
                            <label>Já possui uma conta? <a href="/usuario/login/">Clique aqui para Entrar!</a></label>
                            <p>Ao me cadastrar, eu concordo com os Termos de Uso e a Política de Privacidade do Feralten.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
    	<script type="text/javascript" src="/resources/packages/jquery/jquery.mask-1.14.11.min.js"></script>
    	<script type="text/javascript" src="/application/js/usuario/cadastro.js"></script>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>