<?php use Module\Application\View\SRC\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Peças Novas e Usadas de Carros, Motos, Camihões, Ônibus e Muito Mais em Ferro Velho, Oficinas e Lojas | Feralten</title>
	<?php include_once RAIZ.'/Module/Application/View/HTML/Common/Util/Gtag.php'; ?>
</head>
<body>
    <?php View_Inicio::Carregar_Loader(); ?>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <img class="ui fluid image headIMG" src="/resources/img/header_fundo.jpg"/>
    <section class="ui container" role="main">
        <form id="searschform" class="form-horizontal" name="searschform" action="/pecas/resultados/" method="get" role="form">
            <?php View_Inicio::Incluir_Menu_Pesquisa(); ?>
        </form>
    </section>
    <div class="margem-inferior-minimo"></div>
    <section class="ui container" role="main">
    	<h1 class="ui red huge center aligned dividing header"><i class="settings icon"></i>COMO FUNCIONA</h1>
    	<div class="ui three column very relaxed stackable grid">
    		<div class="column">
    			<h2 class="ui header">
    				<div class="sub header"><i class="hand point right outline icon"></i>Pesquise pela sua peça, se não encontrar, envie-nos sua solicitação de orçamento pelo formulário clicando em Solicitar Orçamentos.</div>
    			</h2>
    		</div>
    		<div class="column">
    			<h2 class="ui header">
    			<div class="sub header"><i class="hand point right outline icon"></i>Sua solicitação é encaminhada para todos os nossos vendedores: lojas de auto peças, ferros-velho, desmanches...</div>
    			</h2>
    		</div>
    		<div class="column">
    			<h2 class="ui header">
    			<div class="sub header"><i class="hand point right outline icon"></i>Receba os orçamentos de peças inteiramente grátis em seu e-mail. Com vários orçamentos, avalie e faça o melhor negócio.</div>
    			</h2>
    		</div>
    	</div>
    </section>
    <div class="margem-inferior-minimo"></div>
    <div class="ui basic secondary vertical segment">
    	<div class="margem-inferior-minimo"></div>
    	<section class="ui container" role="main">
       		<h2 class="ui red header">
       			<div class="content">
       				Chega de perder tempo correndo atrás de peças, encontre e anuncie todas aqui no Feralten.
       			</div>
       		</h2>
       		<h2 class="ui header">
       			<div class="sub header">
       				O site Feralten é um portal de anúncios, que visa aumentar os lucros e facilitar as vendas entre Ferros Velhos, Oficinas Mêcanicas e Pessoas Interessadas em peças originais, usadas ou novas.
       			</div>
       		</h2>
       		<div class="margem-inferior-minimo"></div>
    		<img src="/resources/img/fundo_pecas1_grey.jpg" class="ui fluid image" />
    		<div class="margem-inferior-minimo"></div>
    		<div class="ui two column very relaxed stackable grid">
        		<div class="column">
               		<h2 class="ui red header">Por que Anunciar no Feralten?</h2>
               		<h2 class="ui header">
               			<div class="sub header">
               				Portal exclusivo para negociantes de peças usadas;<br/>
               				Com menos de 1 café por dia você é visto pelo mês todo, lembre-se, quem é visto é  lembrado!
               			</div>
               		</h2>
           		</div>
           		<div class="column">
           			<h2 class="ui red header">Confira as nossas dicas para vender mais e melhor! Acesse: <a href="/dicas-de-venda/">Dicas de Venda</a></h2>
           		</div>
       		</div>
    	</section>
    	<div class="margem-inferior-minimo"></div>
    </div>
    <div class="margem-inferior-minimo"></div>
    <div class="ui basic  vertical segment">
    	<section class="ui container" role="main">
           	<h1 class="ui grey center aligned header">
           		Possui uma loja de autopeças, desmanche, ferro velho, peças usadas? <br/><a href="/usuario/cadastro/">Cadastre-se e comece a vender online agora!</a>
           		<div class="sub header">
           			Comece já a vender peças pela internet para todo o Brasil!
           		</div>
           	</h1>
       	</section>
    </div>
    <div class="margem-superior-pouco"></div>
    <section class="ui container" role="main">
        <h1 class="ui red huge dividing header">Peças Nacionais e Importadas</h1>
        <div class="ui ten column doubling grid">
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_audi.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_bmw.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_chevrolet.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_citroen.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_fiat.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_ford.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_honda.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_hyundai.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_jaguar.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_kia.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_land_rover.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_mercedes_benz.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_mitsubishi.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_nissan.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_peugeot.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_renault.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_subaru.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_toyota.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_volkswagen.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="#" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_volvo.jpg"/>
            	</a>
			</div>
        </div>
	</section>
    <div class="margem-superior-minimo"></div>
    <div class="ui center aligned container">
    	<h2 class="ui disabled header"><b>Em breve</b> disponível para Mobile:</h2>
		<img src="/resources/img/googleplay-badge.png" class="ui centered small image" />
	</div>
    <div class="margem-superior-minimo"></div>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>