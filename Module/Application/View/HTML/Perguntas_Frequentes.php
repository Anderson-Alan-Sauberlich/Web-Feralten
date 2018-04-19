<?php use Module\Application\View\SRC\Perguntas_Frequentes as View_Perguntas_Frequentes; ?>
<!DOCTYPE HTML>
<html lang="PT-BR">
<head>
    <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Head/Default.php'; ?>
    <script type="text/javascript" src="/application/js/perguntas_frequentes.js"></script>
    <title>Perguntas Frequentes | Feralten</title>
</head>
<body>
    <header>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Header/Cabecalho.php'; ?>    
    </header>
    <section class="ui container" role="main">
    	<img class="ui large image margem-inferior-pouco" src="/resources/img/Feralten_logo_Transparente_lateral.png"/>
        <div class="ui stackable grid">
            <div class="eleven wide column">
            	<h1 class="ui red huge dividing header">Perguntas Frequentes</h1>
                <div class="ui styled fluid accordion margem-inferior-pouco">
                    <div class="title"><i class="dropdown icon"></i>O que é o Grupo Feralten?</div>
                    <div class="content">
                        <p>O grupo Feralten é um portal de Ferros-Velhos do Brasil e nossa finalidade é aproximar consumidores e vendedores, sempre visando o melhor custo benefício para ambos os lados.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como funciona?</div>
                    <div class="content">
                        <p>O proprietário da peça ou do estabelecimento faz seu cadastro por meio de CPF ou CNPJ e após a adesão de um pacote de publicações já pode começar a postar fotos e receber ofertas para suas mercadorias.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Quem participa?</div>
                    <div class="content">
                        <p>Pessoas físicas e jurídicas podem participar.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como faço meu Cadastro?</div>
                    <div class="content">
                        <p>Assim que efetuar a primeira etapa do cadastro nesse Link: <a href="/usuario/cadastro/">Cadastro</a>, você poderá solicitar e receber orçamentos de peças totalmente grátis de todos os nossos vendedores.</p>
                        <p>Para ser um vendedor você só precisa concluir o cadastro informado seus dados de contato e endereço e já poderá cadastrar as peças que quiser.</p>
                    	<p>Manual distribuido pela nossa equipe de divulgação <a href="/application/documentos/Manual_Feralten_Frente.pdf" target="_blank">Manual Feralten Frente</a> e <a href="/application/documentos/Manual_Feralten_Verso.pdf" target="_blank">Manual Feralten Verso</a>.</p>
                    	<p>Confira os nossos <a href="/planos-mensais/" target="_blank">Planos Mensais</a>.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como vão me encontrar?</div>
                    <div class="content">
                        <p>A exibição dos anúncios é feito com base na cidade que foi cadastrada em seu perfil, ou seja, pessoas de localidades próximas a sua visualizarão seus anúncios e entrarão em contato primeiramente via E-mail. A partir desse ponto os envolvidos são livres para compartilharem novas formas de comunicação.</p>
                    	<p>Também é possivel visualizar peças de qualquer localidade do Brasil. Basta selecionar o estado e a cidade desejados no menu de filtro(azul) logo abaixo do menu de pesquisa em: <a href="/pecas/resultados/" target="_blank">Lista de Peças</a>.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Quais são as minhas vantagens?</div>
                    <div class="content">
                    	<p>São inúmeras vantagens, confira algumas delas abaixo:</p>
                    	<p>- Seus anúncios são vinculados rapidamente nos maiores buscadores da internet: GOOGLE, YAHOO, BING...</p>
                    	<p>- Tenha uma página com seus produtos e informações, além de um área de relacionamento com seus clientes, interaja e alavanque suas vendas.</p>
                    	<p>- Portal exclusivo para negociantes de peças usadas;</p>
                    	<p>- Único portal da área no Brasil;</p>
                    	<p>- Com menos de 1 café por dia você é visto pelo mês todo, lembre-se, quem é visto é  lembrado!</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como alterar meu e-mail?</div>
                    <div class="content">
                        <p>Para alterar seu e-mail siga as instruções:</p>
                        <p>1 - No menu superior clique em “<a href="/usuario/login/" target="_blank">Entrar</a>”</p>
                        <p>2 - Informe seu e-mail e senha cadastrados e clique no botão "Entrar"</p>
                        <p>3 - No menu do usuário clique em "Meus Dados" depois em "Editar Dados"</p>
                        <p>4 - No formulário do usuário informe seu novo e-mail e clique em "Salvar"</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Esqueci meu e-mail cadastrado no Feralten. Como posso recuperá-lo?</div>
                    <div class="content">
                        <p>Para realizar a recuperação do seu e-mail, preencha o formulário do <a href="/fale-conosco/" target="_blank">Fale Conosco</a> ao lado e informe seu CPF.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Tive problemas com minha senha. O que devo fazer?</div>
                    <div class="content">
                        <p>Se sua senha está inválida ou se você esqueceu sua senha, solicite uma nova senha de acesso, seguindo as instruções abaixo:</p>
                        <p>1 - No menu superior clique em “<a href="/usuario/login/" target="_blank">Entrar</a>”</p>
                        <p>2 - Na caixa de login clique na opção "<a href="/usuario/recuperar-senha/" target="_blank">Esqueceu Sua Senha ou E-mail?</a>"</p>
                        <p>3 - Informe seu e-mail cadastrado e clique no botão "Enviar Link"</p>
                        <p>4 - Em até 20 minutos, você receberá em seu e-mail cadastrado no Feralten um link para criar uma nova senha</p>
                        <p>Caso você não receba a senha em até 20 minutos, provavelmente ela deverá estar bloqueada pelo anti-spam do seu provedor.</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como atualizar meus dados pessoais?</div>
                    <div class="content">
                        <p>Para alterar os dados pessoais, siga as instruções:</p>
                        <p>1 - Clique no menu superior "<a href="/usuario/login/" target="_blank">Entrar</a>"</p>
                        <p>2 - Informe seu e-mail e senha cadastrados e clique no botão "Entrar"</p>
                        <p>3 - No menu do usuário, clique em "Meus Dados" depois "Editar Dados"</p>
                        <p>4 - Altere os dados que desejar nos formulários que desejar: Usuário, Entidade e Endereço</p>
                        <p>5 - Clique em Salvar</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como desativar o bloqueador de pop-up no meu navegador?</div>
                    <div class="content">
                        <p>Ao fazer um anúncio, para realizar o pagamento é necessário que seu navegador esteja com bloqueador de pop-up desativado. Caso contrário, você não verá o sistema de pagamento.</p>
                        <p>Para realizar o desbloqueio siga as instruções válidas para o seu navegador:</p>
                        <p><b>Internet Explorer</b></p>
                        <p>1 - Na tela do navegador, clique no menu superior “Ferramentas” > “Bloqueador de Pop-ups”</p>
                        <p>2 - Nesta janela, clique na opção “Desativar Bloqueador de Pop-ups”</p>
                        <p><b>Nas versões mais recentes do Explorer:</b></p>
                        <p>1 - Na tela do navegador, no canto superior direito clique na engrenagem;</p>
                        <p>2 - Selecione “Opções da Internet”</p>
                        <p>3 - No menu superior selecione “Privacidade”</p>
                        <p>4 - Nessa janela desabilite a opção “Ativar Bloqueado de Pop-ups”</p>
                        <p><b>Mozilla Firefox</b></p>
                        <p>1 - Na tela do navegador, clique no menu “Ferramentas” > “Opções”; nas versões mais recentes, clique no canto superior direito na aba Firefox e então em “Opções”</p>
                        <p>2 - No menu superior selecione “Conteúdo” e desabilite a opção “Bloquear janelas Pop-up”</p>
                        <p><b>Google Chrome</b></p>
                        <p>1 - Na tela do navegador, no canto superior direito, clique na chave de manutenção</p>
                        <p>2 - Selecione “Opções” e no menu lateral esquerdo “Configurações avançadas”</p>
                        <p>3 - Na área “Privacidade” selecione “Configurações de conteúdo”</p>
                        <p>4 - Na área “Pop-ups” selecione a opção “Permitir que todos os sites exibam pop-ups” e feche a tela</p>
                    </div>
                    <div class="title"><i class="dropdown icon"></i>Como realizar a limpeza de cache?</div>
                    <div class="content">
                        <p>As configurações de segurança do seu computador podem impedir que você navegue normalmente pelo Webmotors. Caso tenha algum problema, recomendamos a limpeza de cache do seu navegador. </p>
                        <p>Para realizar o desbloqueio siga as instruções válidas para o seu navegador:</p>
                        <p><b>Internet Explorer</b></p>
                        <p>1 - Na tela do navegador, clique no menu superior “Ferramentas” > “Opções da Internet”; nas versões mais novas, clique no canto superior direito na engrenagem;</p>
                        <p>2 - Na aba “Geral”, localize a área “Histórico de Navegação” e clique em “Excluir...”</p>
                        <p>3 - Nesta janela, selecione todos os itens e clique em “Excluir”</p>
                        <p>4 - Se disponível, antes de confirmar, marque a caixa “Excluir também arquivos e configurações armazenadas por complementos”</p>
                        <p>5 - Aguarde a finalização da limpeza dos arquivos temporários e clique em “OK” ou “Fechar”</p>
                        <p>6 - Feche e abra novamente o Explorer</p>
                        <p><b>Mozilla Firefox</b></p>
                        <p>1 - Na tela do navegador, clique no menu “Ferramentas” > “Opções”; nas versões mais novas, clique no canto superior direito na aba Firefox e então “Opções”</p>
                        <p>2 - No menu superior selecione “Privacidade”; aí, clique no link “Você pode desejar limpar dados pessoais mais recentes”</p>
                        <p>3 - Na janela, no item “Limpar este período”, selecione no combo “Tudo”; selecione também todos os itens abaixo, e clique em “Limpar agora”</p>
                        <p>4 - Aguarde a finalização da limpeza dos arquivos temporários e clique em “OK”</p>
                        <p>5 - Feche e abra novamente o Firefox</p>
                        <p><b>Google Chrome</b></p>
                        <p>1 - Na tela do navegador, no canto superior direito, clique na chave de manutenção</p>
                        <p>2 - Selecione “Opções” e no menu lateral esquerdo “Configurações avançadas”</p>
                        <p>3 - Na área “Privacidade” selecione “Limpar dados de navegação”</p>
                        <p>4 - Na janela, no item “Eliminar os seguintes itens de”, selecione no combo “desde o começo”; selecione também todos os itens abaixo, e clique em “Limpar dados de navegação”</p>
                        <p>5 - Feche e abra novamente o Chrome</p>
                    </div>
                </div>
            </div>
            <div class="five wide column">
            	<h1 class="ui red huge dividing header">Fale Conosco</h1>
                <div id="div_contato" class="ui secondary segment">
                    <?php View_Perguntas_Frequentes::Incluir_Form_Contato(); ?>
                </div>
                <div id="msg_contato" class="ui hidden message">
                    <i class="close icon"></i>
                    <ul id="ul_contato"></ul>
                </div>
            </div>
        </div>
        <div class="margem-inferior-pouco"></div>
    </section>
    <footer>
        <?php include_once RAIZ.'/Module/Application/View/HTML/Layout/Footer/Rodape.php'; ?>
    </footer>
</body>
</html>