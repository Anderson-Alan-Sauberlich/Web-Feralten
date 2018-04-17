<?php use Module\Application\View\SRC\Inicio as View_Inicio; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Peças Novas e Usadas de Carros, Motos, Camihões, Ônibus e Muito Mais em Ferro Velho, Oficinas e Lojas | Feralten</title>
	<?php include_once RAIZ.'/Module/Application/View/HTML/Common/Util/Gtag.php'; ?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
    	(adsbygoogle = window.adsbygoogle || []).push({
    		google_ad_client: "ca-pub-6647185654470379",
        	enable_page_level_ads: true
      	});
	</script>
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
       				O site Feralten é um portal de anúncios, que visa aumentar os lucros e facilitar as vendas entre Ferros-Velhos, Oficinas Mecânicas e Pessoas Interessadas em peças originais, novas e usadas.
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
            	<a href="/pecas/resultados/carro-camioneta/audi/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_audi.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/bmw/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_bmw.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="/pecas/resultados/carro-camioneta/chevrolet/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_chevrolet.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/citroen/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_citroen.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/fiat/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_fiat.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/ford/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_ford.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/honda/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_honda.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/hyundai/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_hyundai.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="/pecas/resultados/carro-camioneta/jaguar/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_jaguar.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/kia/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_kia.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/land-rover/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_land_rover.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/mercedes-benz/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_mercedes_benz.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/mitsubishi/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_mitsubishi.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="/pecas/resultados/carro-camioneta/nissan/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_nissan.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/peugeot/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_peugeot.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/renault/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_renault.jpg"/>
            	</a>
			</div>
			<div class="column">
            	<a href="/pecas/resultados/carro-camioneta/subaru/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_subaru.jpg"/>
            	</a>
            </div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/toyota/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_toyota.jpg"/>
            	</a>
            </div>
            <div class="column">
           		<a href="/pecas/resultados/carro-camioneta/volkswagen/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_volkswagen.jpg"/>
            	</a>
           	</div>
            <div class="column">
            	<a href="/pecas/resultados/carro-camioneta/volvo/" class="ui fluid bordered rounded image">
            		<img src="/resources/img/logos_montadoras/logo_volvo.jpg"/>
            	</a>
			</div>
        </div>
	</section>
    <div class="margem-superior-pouco"></div>
	<div class="ui middle aligned equal width stackable celled grid">
    	<div class="center aligned row">
        	<div class="column">
          		<h2 class="ui disabled header"><b>Em breve</b> disponível para Mobile:</h2>
				<img src="/resources/img/googleplay-badge.png" class="ui centered small image" />
        	</div>
        	<div class="column">
          		<div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12';
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            	<div class="fb-page" data-href="https://www.facebook.com/FeraltenOMundoDasPecasNaWeb/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/FeraltenOMundoDasPecasNaWeb/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FeraltenOMundoDasPecasNaWeb/">Feralten</a></blockquote></div>
        	</div>
      	</div>
    </div>
    <div class="margem-superior-minimo"></div>
    <section class="ui center aligned container" role="main">
        <div class="hidden-xs">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Início -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6647185654470379"
                 data-ad-slot="9701981152"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <div class="margem-superior-minimo"></div>
        </div>
        <h2 class="ui dividing header">Siga o Feralten nas redes sociais:</h2>
        <a href="https://www.facebook.com/FeraltenOMundoDasPecasNaWeb/" target="_blank" class="ui facebook button"><i class="facebook icon"></i>Facebook</a>
        <a href="https://twitter.com/feralten" target="_blank" class="ui twitter button"><i class="twitter icon"></i>Twitter</a>
        <a href="https://plus.google.com/u/0/104720802526462232204" target="_blank" class="ui google plus button"><i class="google plus icon"></i>Google Plus</a>
        <a href="https://www.linkedin.com/company/feralten/" target="_blank" class="ui linkedin button"><i class="linkedin icon"></i>LinkedIn</a>
        <a href="https://www.instagram.com/feralten/" target="_blank" class="ui instagram button"><i class="instagram icon"></i>Instagram</a>
        <div class="margem-superior-minimo"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>