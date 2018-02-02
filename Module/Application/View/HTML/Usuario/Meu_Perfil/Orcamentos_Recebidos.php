<?php use Module\Application\View\SRC\Usuario\Meu_Perfil\Orcamentos_Recebidos as View_Orcamentos_Recebidos; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <title>Meu-Perfeil | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>
    </header>
    <section class="ui container" role="main">
        <?php View_Orcamentos_Recebidos::Incluir_Menu_Usuario(); ?>
        
        
        <div class="ui stackable relaxed grid">
        	<div class="five wide column">
                <div class="ui fluid vertical menu">
                	<a class="active teal item">Inbox<div class="ui teal left pointing label">1</div></a>
                	<a class="item">Spam<div class="ui label">51</div></a>
                	<a class="item">Updates<div class="ui label">1</div></a>
                	<div class="item">
                        <div class="ui transparent icon input">
                        	<input placeholder="Search mail..." type="text">
                        	<i class="search icon"></i>
                        </div>
                	</div>
                </div>
            </div>
            <div class="eleven wide column">
            	<div class="ui raised padded secondary clearing segment">
                	<div class="ui grid">
                		<div class="twelve wide column">
                    		<h2 class="ui header">Second header</h2>
                    		<h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    		<h4 class="ui header">Ano: de 2016 até 2017</h4>
                    		
                		</div>
                		<div class="four wide column">
                			<div class="ui grid">
                    			<div class="sixteen wide column">
                    				<button class="ui primary fluid big button">Tenho</button>
                    			</div>
                    			<div class="sixteen wide column">
                    				<button class="ui secondary fluid big button">Não Tenho</button>
                    			</div>
                    		</div>
                		</div>
                	</div>
                </div>
                <div class="ui raised padded secondary clearing segment">
                	<div class="ui grid">
                		<div class="twelve wide column">
                    		<h2 class="ui header">Second header</h2>
                    		<h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    		<h4 class="ui header">Ano: de 2016 até 2017</h4>
                    		
                		</div>
                		<div class="four wide column">
                			<div class="ui grid">
                    			<div class="sixteen wide column">
                    				<button class="ui primary fluid big button">Tenho</button>
                    			</div>
                    			<div class="sixteen wide column">
                    				<button class="ui secondary fluid big button">Não Tenho</button>
                    			</div>
                    		</div>
                		</div>
                	</div>
                </div>
            	
            	
            	<div class="ui raised secondary clearing segment">
                	<h2 class="ui header">Second header</h2>
                    <h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    <h4 class="ui header">Ano: de 2016 até 2017</h4>
                    <div class="ui two bottom buttons">
                    	<div class="ui primary button">TENHO</div>
                    	<div class="ui secondary button">NÃO TENHO</div>
                	</div>
                </div>
            	<div class="ui raised secondary clearing segment">
                	<h2 class="ui header">Second header</h2>
                    <h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    <h4 class="ui header">Ano: de 2016 até 2017</h4>
                    <div class="ui two bottom buttons">
                    	<div class="ui primary button">TENHO</div>
                    	<div class="ui secondary button">NÃO TENHO</div>
                	</div>
                </div>
            	
            	
                <div class="ui raised padded secondary clearing attached segment">
                	<h2 class="ui header">Second header</h2>
                    <h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    <h4 class="ui header">Ano: de 2016 até 2017</h4>
                </div>
                <div class="ui two bottom attached buttons">
                    <div class="ui primary button">TENHO</div>
                    <div class="ui secondary button">NÃO TENHO</div>
                </div>
                <br/>
                <div class="ui raised padded secondary clearing attached segment">
                	<h2 class="ui header">Second header</h2>
                    <h4 class="ui header">Carro/Camioneta, Chevrolet, Corsa, 1.0 EFI Wind Super 8V Gasolina 2P Manual</h4>
                    <h4 class="ui header">Ano: de 2016 até 2017</h4>
                </div>
                <div class="ui two bottom attached buttons">
                    <div class="ui primary button">TENHO</div>
                    <div class="ui secondary button">NÃO TENHO</div>
                </div>


            </div>
        </div>
        
        <div class="margem-inferior-pouco"></div>
        
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
        <script type="text/javascript" src="/application/js/usuario/meu_perfil/orcamentos_recebidos.js"></script>
    </footer>
</body>
</html>