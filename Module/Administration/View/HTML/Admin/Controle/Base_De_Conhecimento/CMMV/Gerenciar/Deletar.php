<?php use Module\Administration\View\SRC\Admin\Controle\Base_De_Conhecimento\CMMV\Gerenciar\Deletar as View_Deletar; ?>
<div class="margem-superior-pouco"></div>
<div id="del_div_msg"></div>
<form class="ui form">
    <h4 class="ui dividing header">Selecione a sequência a ser Deletada:</h4>
    <div class="two fields">
        <div class="field">
            <select id="del_categoria" name="del_categoria" class="ui fluid scrolling search selection dropdown">
                <?php View_Deletar::Carregar_Categorias(); ?>
            </select>
        </div>
        <div class="field">
            <select id="del_marca" name="del_marca" class="ui fluid scrolling search selection dropdown">
                <option value="0">Marca</option>
            </select>
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <select id="del_modelo" name="del_modelo" class="ui fluid scrolling search selection dropdown">
                <option value="0">Modelo</option>
            </select>
        </div>
        <div class="field">
            <select id="del_versao" name="del_versao" class="ui fluid scrolling search selection dropdown">
                <option value="0">Versão</option>
            </select>
        </div>
    </div>
    <h4 class="ui dividing header">Nome e URL da sequência selecionada:</h4>
    <div class="two fields">
        <div class="field">
            <input type="text" id="del_nome" name="del_nome" placeholder="Nome (1° Letra Maiuscula)" class="ui disabled fluid"/>
        </div>
        <div class="field">
            <input type="text" id="del_url" name="del_url" placeholder="URL (Não pode conter Caracteres Especiais" class="ui disabled fluid"/>
        </div>
    </div>
</form>
<div class="cmmv_salvar">
    <h4 class="ui dividing header">A Deletar: <label class="ui big label" id="del_lb_item">Nada</label></h4>
       <button id="del_salvar" name="del_salvar" onclick="SalvarDeletar()" class="ui fluid inverted red button ">Salvar e Deletar</button>
</div>
<script type="text/javascript" src="/administration/js/admin/controle\base_de_conhecimento\cmmv\gerenciar\deletar.js"></script>