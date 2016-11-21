<?php require_once RAIZ.'/application/view/src/include_page/menu_pesquisa.php'; ?>
<?php use application\view\src\include_page\Menu_Pesquisa as View_Menu_Pesquisa; ?>
<script type="text/javascript" src="/application/view/js/include_page/menu_pesquisa.js"></script>
<section>
	<div class="page-header">
		<div class="well borderPainel sombra_painel">
    		<form id="searschform" class="form-horizontal" name="searschform" action="<?php View_Menu_Pesquisa::Mostrar_Base_URL(); ?>" method="get" role="form">
				<div class="ui accordion field">
					<div class="title ui horizontal divider header"><i class="icon dropdown"></i>Categorias</div>
					<div class="content field">
						<div class="well well-sm">
					    	<div class="row">
					        	<?php View_Menu_Pesquisa::Carregar_Categorias(); ?>
					        </div>
				        </div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
							<select id="marca" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Marcas(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
		                   	<select id="modelo" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Modelos(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    	<div class="row-fluid buscaDropEspaco">
		                   	<select id="versao" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Versoes(); ?>
							</select>
						</div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            	<div class="row-fluid buscaDropEspaco">
			                    	<select id="ano_de" name="ano_de" class="ui fluid search selection dropdown">
										<option value="0">De</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
								</div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            	<div class="row-fluid buscaDropEspaco">
		                           	<select id="ano_ate" name="ano_ate" class="ui fluid search selection dropdown">
										<option value="0">Até</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-9 col-sm-8 col-xs-12">
	          			<div class="ui fluid big left icon input">
							<i class="search icon"></i>
							<input id="peca" name="peca" placeholder="Digite o que deseja Procurar..." type="text">
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="visible-xs ui horizontal divider"></div>
						<button id="pesquisa" onClick="Pesquisar()" class="ui fluid big red labeled icon button"><i class="search icon"></i>Pesquisar</button>
    				</div>
    			</div>
    		</form>
		</div>
	</div>
</section>