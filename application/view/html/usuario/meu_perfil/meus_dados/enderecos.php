<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
	<?php include_once(RAIZ.'/application/view/html/include_page/head.php'); ?>
	<script type="text/javascript" src="/application/view/js/usuario/meu_perfil/meus_dados/enderecos.js"></script>
	<title>Enderecos | Feralten</title>
</head>
<body>
    <header>
        <?php include_once(RAIZ.'/application/view/html/include_page/cabecalho.php'); ?>
    </header>
    <section class="ui container" role="main">
        <?php include_once(RAIZ.'/application/view/html/include_page/menu_usuario.php'); ?>
        <?php self::Mostrar_Erros(); ?>
        <?php self::Mostrar_Sucesso("atualizar_endereco"); ?>
        <form id="ender_form" name="ender_form" data-toggle="validator" action="/usuario/meu-perfil/meus-dados/enderecos/" method="post" role="form">
            <div class="panel panel-default sombra_painel">
                <div class="panel-heading sombra_painel centralizar">
                    <label class="lbPanel">Gerenciar Endereços</label>
                </div>
                <div class="panel-body">
                    <div class="row dadosPanel">
                        <div class="col-sm-6">
                            <label for="estado" class="lbPanel">Selecione Seu Estado:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("estado"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                <select id="estado" name="estado" class="form-control form_select">
                                    <option>Selecione seu Estado</option>
                                    <?php self::Mostrar_Estados(); ?>
                                </select>
                                <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                            </div>
                            <label for="cidade" class="lbPanel">Selecione Sua Cidade:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("cidade"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                <select id="cidade" name="cidade" class="form-control form_select">
                                    <?php self::Mostrar_Cidades(); ?>
                                </select>
                                <span class="glyphicon glyphicon-menu-down form-control-feedback"></span>
                            </div>
                            <label for="bairro" class="lbPanel">Digite o Nome do Bairro:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("bairro"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                <input id="bairro" name="bairro" type="text" class="form-control" value="<?php self::Pegar_Valor("bairro") ?>" placeholder="Bairro" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o Nome Completo do Bairro. (Campo Obrigatório)" />
                            </div>
                            <label for="rua" class="lbPanel">Digite o Nome da Rua:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("rua"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                <input id="rua" name="rua" type="text" class="form-control" value="<?php self::Pegar_Valor("rua") ?>" placeholder="Rua" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o nome Completo da Rua. (Campo Obrigatório)" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="numero" class="lbPanel">Digite o Numero do Estabelecimento:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("numero"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input id="numero" name="numero" type="text" class="form-control" value="<?php self::Pegar_Valor("numero") ?>" placeholder="Numero" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite o Numero do Endereço. (Campo Obrigatório)" />
                            </div>
                            <label for="cep" class="lbPanel">Digite Seu CEP:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("cep"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input id="cep" name="cep" type="text" class="form-control" value="<?php self::Pegar_Valor("cep") ?>" placeholder="CEP" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite apenas os numeros do seu CEP. (Campo Obrigatório)" />
                            </div>
                            <label for="complemento" class="lbPanel">Digite um Complemento do Endereço:</label>
                            <div class="input-group <?php self::Incluir_Classe_Erros("complemento"); ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                <input id="complemento" name="complemento" type="text" class="form-control" value="<?php self::Pegar_Valor("complemento") ?>" placeholder="Complemento" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Digite um Complememento de Referencia para o Endereço.  (Campo Obcional)" />
                            </div>
                        </div>
                   </div>
                </div>
                <div class="panel-footer sombra_painel">
                    <button type="submit" id="enderecos" name="enderecos" class="big ui green button btn-lg"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar Alterações</button>
                </div>
            </div>
        </form>
    </section>
    <footer>
        <?php include_once(RAIZ.'/application/view/html/include_page/rodape.php'); ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['endereco']); ?>