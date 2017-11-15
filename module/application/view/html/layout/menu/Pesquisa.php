<?php use module\application\view\src\layout\menu\Pesquisa as View_Pesquisa; ?>
<section>
	<div class="page-header">
		<div class="well borderPainel sombra_painel">
			<div class="ui accordion field">
				<div id="title_categoria" class="title ui horizontal divider header"><i class="icon dropdown"></i>Categorias</div>
				<div id="content_categoria" class="content field">
					<div class="well well-sm wellBranco">
				    	<div class="row">
				        	<?php View_Pesquisa::Carregar_Categorias(); ?>
				        </div>
			        </div>
				</div>
			</div>
            <div class="row">
            	<div class="col-md-6 col-sm-6 col-xs-12">
                   	<div class="row-fluid buscaDropEspaco">
						<select id="marca" class="ui fluid scrolling search selection dropdown">
							<?php View_Pesquisa::Carregar_Marcas(); ?>
						</select>
					</div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   	<div class="row-fluid buscaDropEspaco">
		               	<select id="modelo" class="ui fluid scrolling search selection dropdown">
							<?php View_Pesquisa::Carregar_Modelos(); ?>
						</select>
					</div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   	<div class="row-fluid buscaDropEspaco">
		               	<select id="versao" class="ui fluid scrolling search selection dropdown">
							<?php View_Pesquisa::Carregar_Versoes(); ?>
						</select>
					</div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           	<div class="row-fluid buscaDropEspaco">
			                   	<select id="ano_de" name="ano_de" class="ui fluid scrolling search selection dropdown">
									<option value="0">Ano De</option>
									<?php View_Pesquisa::Carregar_Ano_De(); ?>
								</select>
							</div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           	<div class="row-fluid buscaDropEspaco">
		                       	<select id="ano_ate" name="ano_ate" class="ui fluid scrolling search selection dropdown">
									<option value="0">Ano Até</option>
									<?php View_Pesquisa::Carregar_Ano_Ate(); ?>
								</select>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
               	<div class="col-md-9 col-sm-12 col-xs-12">
	        		<div class="ui fluid big left icon input">
						<i class="search icon"></i>
						<input id="peca" name="peca" value="<?php View_Pesquisa::Manter_Valor_Pesquisa(); ?>" placeholder="Digite o que deseja Procurar..." type="text">
					</div>
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="visible-xs visible-sm ui horizontal divider"></div>
					<button id="pesquisa" onClick="Pesquisar()" class="ui fluid big red labeled icon button"><i class="search icon"></i>Pesquisar</button>
    			</div>
    		</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="/application/js/layout/menu/pesquisa.js"></script>