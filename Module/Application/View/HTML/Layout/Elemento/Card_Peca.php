<?php use Module\Application\View\SRC\Layout\Elemento\Card_Peca as View_Card_Peca ?>
<div class="ui card">
    <a href="/pecas/detalhes/<?= View_Card_Peca::RetornarPecaURL(); ?>/" class="content">
        <div class="meta"><?= View_Card_Peca::RetornarPecaNome(); ?></div>
    </a>
    <a href="/pecas/detalhes/<?= View_Card_Peca::RetornarPecaURL(); ?>/" class="ui medium bordered image">
        <img width="200" height="150" class="ui <?= View_Card_Peca::RetonrarStatusPecaImagem(); ?> image" onerror="this.src='/resources/img/imagem_indisponivel.png'" src="<?= View_Card_Peca::RetornarPecaImagem(); ?>">
    </a>
    <a href="/pecas/detalhes/<?= View_Card_Peca::RetornarPecaURL(); ?>/" class="content">
        <?php if (View_Card_Peca::VerificarPecaPreco() AND View_Card_Peca::VerificaPecaEstadoUso()) { ?>
            <div class="right floated header">R$: <?= View_Card_Peca::RetornarPecaPreco(); ?></div>
            <div class="meta">
                <span class="date"><?= View_Card_Peca::RetornarPecaEstadoUso(); ?></span>
            </div>
        <?php } else if (View_Card_Peca::VerificarPecaPreco() AND !View_Card_Peca::VerificaPecaEstadoUso()) { ?>
            <div class="header">R$: <?= View_Card_Peca::RetornarPecaPreco(); ?></div>
        <?php } else if (!View_Card_Peca::VerificarPecaPreco() AND View_Card_Peca::VerificaPecaEstadoUso()) { ?>
            <div class="header">R$: A Negociar</div>
            <div class="meta">
            <span class="date"><?= View_Card_Peca::RetornarPecaEstadoUso(); ?></span>
            </div>
        <?php } else if (!View_Card_Peca::VerificarPecaPreco()) { ?>
            <div class="header">R$: A Negociar</div>
        <?php } ?>
        <?php if (View_Card_Peca::VerificaPecaFabricante()) { ?>
            <div class="description"><?= View_Card_Peca::RetornarPecaFabricante(); ?></div>
        <?php } ?>
    </a>
    <a href="/pecas/detalhes/<?= View_Card_Peca::RetornarPecaURL(); ?>/" class="extra content">
        <span class="right floated"><?= View_Card_Peca::RetornarPecaData(); ?></span>
    </a>
    <?php if (View_Card_Peca::VerificarUsuarioAutenticado()) { ?>
        <div class="extra content">
            <div class="ui two buttons">
                <a id="atualizar" href="/usuario/meu-perfil/pecas/atualizar/<?= View_Card_Peca::RetornarPecaURL(); ?>/" class="ui inverted green button">Atualizar</a>
                <a id="opcoes" onclick="Mostrar_Modal(<?= View_Card_Peca::RetornarPecaID(); ?>);" class="ui inverted red button">Opções</a>
            </div>
        </div>
        <div id="modal_<?= View_Card_Peca::RetornarPecaID(); ?>" class="ui tiny modal">
            <div class="header"><?= View_Card_Peca::RetornarPecaNome(); ?></div>
            <div class="content">
                <div class="ui container fluid">
                    <div class="grouped fields">
                        <label>Deseja Deletar a Peça?</label>
                        <label class="ui red basic label">Cuidado, Irreversível!</label>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" onchange="Change_Checkbox(<?= View_Card_Peca::RetornarPecaID(); ?>)" id="deletar_<?= View_Card_Peca::RetornarPecaID(); ?>" name="deletar_<?= View_Card_Peca::RetornarPecaID(); ?>">
                                <label for="deletar_<?= View_Card_Peca::RetornarPecaID(); ?>">Deletar Peça</label>
                            </div>
                        </div>
                        <div class="ui divider"></div>
                        <label>Selecione o Status da Peça:</label>
                        <div class="field">
                            <div id="div_visivel_<?= View_Card_Peca::RetornarPecaID(); ?>" class="ui radio checkbox">
                                <input type="radio" id="visivel_<?= View_Card_Peca::RetornarPecaID(); ?>" <?php if (View_Card_Peca::RetornarPecaStatus() === 1) { echo 'checked="checked"'; } ?> name="status_<?= View_Card_Peca::RetornarPecaID(); ?>">
                                <label for="visivel_<?= View_Card_Peca::RetornarPecaID(); ?>">Visível Para Todos</label>
                            </div>
                        </div>
                        <div class="field">
                            <div id="div_desativada_<?= View_Card_Peca::RetornarPecaID(); ?>" class="ui radio checkbox">
                                <input type="radio" id="desativada_<?= View_Card_Peca::RetornarPecaID(); ?>" <?php if (View_Card_Peca::RetornarPecaStatus() === 2) { echo 'checked="checked"'; } ?> name="status_<?= View_Card_Peca::RetornarPecaID(); ?>">
                                <label for="desativada_<?= View_Card_Peca::RetornarPecaID(); ?>">Desativada Temporariamente</label>
                            </div>
                        </div>
                        <div class="field">
                            <div id="div_invisivel_<?= View_Card_Peca::RetornarPecaID(); ?>" class="ui radio checkbox">
                                <input type="radio" id="invisivel_<?= View_Card_Peca::RetornarPecaID(); ?>" <?php if (View_Card_Peca::RetornarPecaStatus() === 3) { echo 'checked="checked"'; } ?> name="status_<?= View_Card_Peca::RetornarPecaID(); ?>">
                                <label for="invisivel_<?= View_Card_Peca::RetornarPecaID(); ?>">Invisível Para Todos</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                <div onclick="Cancelar_Opcoes_Peca()" class="ui cancel button">Cancelar</div>
                <div onclick="Salvar_Opcoes_Peca(<?= View_Card_Peca::RetornarPecaID(); ?>)" class="ui approve positive right labeled icon button">Salvar <i class="checkmark icon"></i></div>
            </div>
        </div>
    <?php } ?>
</div>