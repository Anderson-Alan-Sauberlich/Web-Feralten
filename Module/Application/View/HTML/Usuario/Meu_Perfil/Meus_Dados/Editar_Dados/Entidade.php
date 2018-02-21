<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Meus_Dados\Editar_Dados\Entidade as View_Entidade; ?>
<div id="div_entidade" class="ui stackable centered grid">
	<div class="eight wide column">
        <div id="form_entidade" class="ui equal width form">
        	<div id="entidade_msg" class="ui hidden message">
            	<i class="close icon"></i>
            	<div id="entidade_msg_header" class="header"></div>
            	<ul id="entidade_msg_list" class="list"></ul>
            </div>
            <div class="field">
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
                                <img id="foto" name="foto" onError="MostImgErr($this)" src="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="required field">
            	<label class="ui red header" for="entidade_cpf_cnpj">Seu CPF ou CNPJ:</label>
            	<div class="ui left icon input">
					<i class="id card outline icon"></i>
               		<input id="entidade_cpf_cnpj" name="entidade_cpf_cnpj" placeholder="CPF / CNPJ" value="<?= View_Entidade::MostrarCPF_CNPJ(); ?>" type="text" <?= View_Entidade::BloquearCPF_CNPJ(); ?> data-content="Este campo não mais podera ser alterado. Digite apenas os Numeros do seu CPF ou CNPJ. (Obrigatório)">
            	</div>
            </div>
            <div class="field">
            	<label class="ui red header" for="entidade_nome_comercial">Nome Comercial:</label>
            	<div class="ui left icon input">
					<i class="building outline icon"></i>
               		<input id="entidade_nome_comercial" name="entidade_nome_comercial" placeholder="Nome Comercial" value="<?= View_Entidade::MostrarNomeComercial(); ?>" type="text" data-content="Ao Informar um Nome neste campo o mesmo sera mostrado em seus dados, substituindo seu Nome de Usuario. (Opcional)">
            	</div>
            </div>
            <div class="field">
               	<label class="ui red header" for="entidade_site">Seu Site:</label>
               	<div class="ui left icon input">
					<i class="external icon"></i>
               		<input id="entidade_site" name="entidade_site" placeholder="Ex: www.meusite.com.br" value="<?= View_Entidade::MostrarSite(); ?>" type="text" data-content="Informe aqui o Endereço do seu site, caso você tenha. (Opcional)">
            	</div>
            </div>
            <?php if (View_Entidade::VerificaLoginEntidade()) { ?>
                <div class="ui divider"></div>
                <div class="field">
                	<div class="ui fluid buttons">
                        <button id="salvar_usuario" name="salvar_usuario" value="1" type="submit" class="ui positive button"><i class="glyphicon glyphicon-floppy-saved"></i> Salvar</button>
                        <div class="or" data-text="Ou"></div>
                        <button id="restaurar_usuario" name="restaurar_usuario" value="1" type="submit" class="ui button"><i class="glyphicon glyphicon-refresh"></i> Restaurar</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="/application/js/usuario/meu_perfil/meus_dados/editar_dados/entidade.js"></script>