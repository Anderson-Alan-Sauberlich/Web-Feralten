<?php require_once(RAIZ.'/application/view/src/include_page/cabecalho.php'); ?>
<?php use application\view\src\include_page\Cabecalho; ?>
<section class="margem-inferior-pouco">
<script type="text/javascript" src="/application/view/js/include_page/cabecalho.js"></script>
	<nav class="navbar navbar-default navbar-fixed-top navbar-titulo" role="navigation">
		<div class="ui container">
 			<div class="navbar-header">
 				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
 					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Feralten</a>
			</div>
			<div class="collapse navbar-collapse" id="collapseNav">
				<ul class="nav navbar-nav navbar-left pull-left">
                    <li><a href="/"><i class="home icon"></i>INÍCIO</a></li>
                    <li id="auto_pecas_item"><a href="#"><i class="puzzle icon"></i>AUTO PEÇAS</a></li>
					<div class="ui fluid popup">
						<div class="ui four column relaxed divided grid">
					    	<div class="column">
					        	<h4 class="ui header">Fabrics</h4>
					        	<div class="ui link list">
					          		<a class="item">Cashmere</a>
					          		<a class="item">Linen</a>
					          		<a class="item">Cotton</a>
					          		<a class="item">Viscose</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Size</h4>
					        	<div class="ui link list">
					          		<a class="item">Small</a>
					          		<a class="item">Medium</a>
					          		<a class="item">Large</a>
					          		<a class="item">Plus Sizes</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Colors</h4>
					        	<div class="ui link list">
					          		<a class="item">Neutrals</a>
					          		<a class="item">Brights</a>
					          		<a class="item">Pastels</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Types</h4>
					        	<div class="ui link list">
					          		<a class="item">Knitwear</a>
					          		<a class="item">Outerwear</a>
					          		<a class="item">Pants</a>
					          		<a class="item">Shoes</a>
					        	</div>
					        </div>
					    </div>
					</div>
                    <li id="ferro_velho_item"><a href="#"><i class="configure icon"></i>FERRO VELHO</a></li>
					<div class="ui fluid popup">
						<div class="ui four column relaxed divided grid">
					    	<div class="column">
					        	<h4 class="ui header">Fabrics</h4>
					        	<div class="ui link list">
					          		<a class="item">Cashmere</a>
					          		<a class="item">Linen</a>
					          		<a class="item">Cotton</a>
					          		<a class="item">Viscose</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Size</h4>
					        	<div class="ui link list">
					          		<a class="item">Small</a>
					          		<a class="item">Medium</a>
					          		<a class="item">Large</a>
					          		<a class="item">Plus Sizes</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Colors</h4>
					        	<div class="ui link list">
					          		<a class="item">Neutrals</a>
					          		<a class="item">Brights</a>
					          		<a class="item">Pastels</a>
					        	</div>
					      	</div>
					      	<div class="column">
					        	<h4 class="ui header">Types</h4>
					        	<div class="ui link list">
					          		<a class="item">Knitwear</a>
					          		<a class="item">Outerwear</a>
					          		<a class="item">Pants</a>
					          		<a class="item">Shoes</a>
					        	</div>
					        </div>
					    </div>
					</div>
                </ul>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <?php Cabecalho::Verificar_Usuario_Autenticado(); ?>
                </ul>
            </div>
		</div>
	</nav>
</section>