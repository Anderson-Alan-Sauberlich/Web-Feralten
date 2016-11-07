<?php require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php'; ?>
<?php use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa; ?>
<script type="text/javascript" src="/application/view/js/include_page/menu_pesquisa.js"></script>
<section>
	<div class="page-header">
		<div class="well borderPainel sombra_painel">
    		<form id="searschform" class="container-fluid menuPesquisaPanel" name="searschform" action="/menu-pesquisa/" method="get" role="form">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
							<select id="categoria" name="categoria" class="ui fluid search dropdown">
								<?php View_Menu_Pesquisa::Carregar_Categorias(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
		                   	<select id="marca" name="marca" class="ui fluid search dropdown">
								<?php View_Menu_Pesquisa::Carregar_Marcas(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
		                   	<select id="modelo" name="modelo" class="ui fluid search dropdown">
								<?php View_Menu_Pesquisa::Carregar_Modelos(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            	<div class="row-fluid buscaDropEspaco">
			                    	<select id="ano_de" name="ano_de" class="ui fluid search dropdown">
										<option value="0">Ano De</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
								</div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            	<div class="row-fluid buscaDropEspaco">
		                           	<select id="ano_ate" name="ano_ate" class="ui fluid search dropdown">
										<option value="0">Ano Até</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid hidden-xs">
					<div class="ui fluid big left icon action input">
						<i class="search icon"></i>
						<input id="peca" name="peca" placeholder="Digite aqui o que deseja Procurar..." type="text">
						<button id="pesquisa" name="pesquisa" class="ui big red labeled icon button"><i class="search icon"></i>Pesquisar</button>
					</div>
                </div>
                <div class="row-fluid visible-xs">
          			<div class="ui fluid big left icon input">
						<i class="search icon"></i>
						<input id="peca" name="peca" placeholder="Digite aqui o que deseja Procurar..." type="text">
					</div>
					<div class="ui horizontal divider"></div>
					<button id="pesquisa" name="pesquisa" class="ui fluid big red labeled icon button"><i class="search icon"></i>Pesquisar</button>
    			</div>
    		</form>
		</div>
	</div>
</section>