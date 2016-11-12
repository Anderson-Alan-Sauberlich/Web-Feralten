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
				<div class="ui form">
	                <div class="four fields">
	                    <div class="field">
							<select id="categoria" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Marcas(); ?>
							</select>
	                    </div>
	                    <div class="field">
			                <select id="marca" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Marcas(); ?>
							</select>
	                    </div>
	                    <div class="field">
			                <select id="modelo" class="ui fluid search selection dropdown">
								<?php View_Menu_Pesquisa::Carregar_Modelos(); ?>
							</select>
	                    </div>
	                    <div class="field">
	                        <div class="two fields">
	                            <div class="field">
				                    <select id="ano_de" class="ui fluid search selection dropdown">
										<option value="0">De</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
	                            </div>
	                            <div class="field">
			                        <select id="ano_ate" class="ui fluid search selection dropdown">
										<option value="0">Até</option>
										<?php View_Menu_Pesquisa::Carregar_Anos(); ?>
									</select>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="two fields">
	                	<div class="twelve wide field">
		          			<div class="ui fluid big left icon input">
								<i class="search icon"></i>
								<input id="peca" placeholder="Digite o que deseja Procurar..." type="text">
							</div>
						</div>
						<div class="four wide field">
							<button id="pesquisa" onClick="Pesquisar()" class="ui fluid big red labeled icon button"><i class="search icon"></i>Pesquisar</button>
	    				</div>
	    			</div>
    			</div>
    		</form>
		</div>
	</div>
</section>