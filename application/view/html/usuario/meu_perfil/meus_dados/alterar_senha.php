<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once(RAIZ.'/application/view/html/include_page/head.php'); ?>
	<script type="text/javascript" src="/application/view/js/usuario/meu_perfil/meus_dados/alterar_senha.js"></script>
	<title>Alterar-Senha | Feralten</title>
</head>
<body>
    <header>
        <?php include_once(RAIZ.'/application/view/html/include_page/cabecalho.php'); ?>
    </header>
    <section class="ui container" role="main">
        <?php self::Incluir_Menu_Usuario(); ?>
        <?php self::Mostrar_Erros(); ?>
        <form id="form_alterar_senha" name="form_alterar_senha" data-toggle="validator" action="/usuario/meu-perfil/meus-dados/alterar-senha/" method="post" role="form">
            <div class="panel panel-default sombra_painel">
                <div class="panel-heading sombra_painel centralizar">
                    <label class="lbPanel">Alterar Senha</label>
                </div>
                <div class="panel-body">
                	<div class="row">
	                    <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
	                        <label for="senha_antiga" class="lbPanel">Digite A Senha Antiga:</label>
	                        <div class="input-group <?php self::Incluir_Classe_Erros("senha_antiga"); ?>">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="senha_antiga" name="senha_antiga" type="password" class="form-control" value="<?php self::Manter_Valor("senha_antiga") ?>" placeholder="Senha Antiga" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Informe a Senha Antiga Para Alterar Por Uma Nova. (Campo Obrigatório)" />
								<span class="input-group-addon">
			                        <div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar_senha_antiga" name="mostrar_senha_antiga" onchange="Mostrar_Senha_Antiga()">
										<label for="mostrar_senha_antiga"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
							    </span>
	                        </div>
	                        <label for="senha_nova" class="lbPanel_Senha">Digite Uma Nova Senha:</label>
	                        <div class="input-group <?php self::Incluir_Classe_Erros("senha_nova"); ?>">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="senha_nova" name="senha_nova" type="password" class="form-control" value="<?php self::Manter_Valor("senha_nova") ?>" placeholder="Nova Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A Senha deve ter no minimo 8 caracteres e no maximo 20. (Campo Obrigatório)" />
								<span class="input-group-addon">
			                        <div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar_senha_nova" name="mostrar_senha_nova" onchange="Mostrar_Senha_Nova()">
										<label for="mostrar_senha_nova"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
								</span>
	                        </div>
	                        <label for="confsenha_nova" class="lbPanel">Digite a Nova Senha Novamente:</label>
	                        <div class="input-group <?php self::Incluir_Classe_Erros("confsenha_nova"); ?>">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                            <input id="confsenha_nova" name="confsenha_nova" type="password" class="form-control" value="<?php self::Manter_Valor("confsenha_nova") ?>" placeholder="Confirmar Nova Senha" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Digite a Senha novamente da mesma forma para Confirmila. (Campo Obrigatório)" />
								<span class="input-group-addon">
									<div class="ui checkbox passCheck">
										<input type="checkbox" id="mostrar_confsenha_nova" name="mostrar_confsenha_nova" onchange="Mostrar_Confsenha_Nova()">
										<label for="mostrar_confsenha_nova"><i class="hidden-xs">Mostrar Senha </i><i class="unlock alternate icon"></i></label>
									</div>
								</span>
	                        </div>
		                    <div class="ui buttons linha_inteira btnAtualizar">
								<button id="salvar" name="salvar" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
								<div class="or" data-text="Ou"></div>
								<button id="restaurar" name="restaurar" value="1" type="reset" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Limpar</button>
							</div>
	                    </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <footer>
        <?php include_once(RAIZ.'/application/view/html/include_page/rodape.php'); ?>
    </footer>
</body>
</html>