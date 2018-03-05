<?php use Module\Application\View\SRC\Layout\Menu\Filtro as View_Filtro; ?>
<aside class="row redutorMenuLateral">
    <nav id="menu_filtro" class="ui vertical inverted left demo blue fluid sombra_painel menu">
        <div class="active item">
            <div class="ui grid">
                <div class="eleven wide column">
                    <h3>Filtro de Busca</h3>
                </div>
                <div class="one wide column">
                    <button onClick="Pesquisar()" class="ui inverted icon button"><i class="refresh icon"></i></button>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="header"><h4>Localização</h4></div>
            <div class="menu">
                <div class="ui container fluid">
                    <select id="estado" name="estado" class="ui fluid scrolling search dropdown" form="searschform">
                        <option value="0">Selecione o Estado</option>
                        <?php View_Filtro::Mostrar_Estados(); ?>
                    </select>
                </div>
            </div>
            <div class="menu">
                <div class="ui container fluid">
                    <select id="cidade" name="cidade" class="ui fluid scrolling search dropdown" form="searschform">
                        <?php View_Filtro::Mostrar_Cidades(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="header"><h4>Ordenar Pelo Preço</h4></div>
            <div class="menu">
                <div class="ui container fluid">
                    <div class="row-fluid">
                          <div class="ui radio checkbox">
                            <input type="radio" name="ordem_preco" value="por_menor" <?php View_Filtro::Manter_Valor('ordem_preco', 'por_menor'); ?> id="ordenar_menor_preco" form="searschform">
                            <label for="ordenar_menor_preco">Menor Preço</label>
                          </div>
                      </div>
                      <div class="row-fluid">
                          <div class="ui radio checkbox">
                            <input type="radio" name="ordem_preco" value="por_maior" <?php View_Filtro::Manter_Valor('ordem_preco', 'por_maior'); ?> id="ordenar_maior_preco" form="searschform">
                            <label for="ordenar_maior_preco">Maior Preço</label>
                          </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="header"><h4>Estado de Conservação</h4></div>
            <div class="menu">
                <div class="ui container fluid">
                    <select id="estado_uso" name="estado_uso" class="ui fluid dropdown" form="searschform">
                        <option value="0">Selecione o Status</option>
                        <?php View_Filtro::Mostrar_Estado_Uso(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="header"><h4>Data de Publicação</h4></div>
            <div class="menu">
                <div class="ui container fluid">
                    <div class="row-fluid">
                          <div class="ui radio checkbox">
                            <input type="radio" name="ordem_data" value="mais_recente" <?php View_Filtro::Manter_Valor('ordem_data', 'mais_recente'); ?> id="ordenar_mais_recente" form="searschform">
                            <label for="ordenar_mais_recente">Mais Recente</label>
                          </div>
                      </div>
                      <div class="row-fluid">
                          <div class="ui radio checkbox">
                            <input type="radio" name="ordem_data" value="menos_recente" <?php View_Filtro::Manter_Valor('ordem_data', 'menos_recente'); ?> id="ordenar_menos_recente" form="searschform">
                            <label for="ordenar_menos_recente">Menos Recente</label>
                          </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="header"><h4>Preferência de Entrega</h4></div>
            <div class="menu">
                <div class="ui container fluid">
                    <select id="preferencia_entrega" name="preferencia_entrega" class="ui fluid dropdown" form="searschform">
                        <option value="0">Preferência de Entrega</option>
                        <?php View_Filtro::Mostrar_Preferencia_Entrega(); ?>
                    </select>
                </div>
            </div>
        </div>
        <?php if (View_Filtro::Verificar_Login()) { ?>
            <div class="item">
                <div class="header"><h4>Status da Peça</h4></div>
                <div class="menu">
                    <div class="ui container fluid">
                        <select id="status_peca" name="status_peca" class="ui fluid dropdown" form="searschform">
                            <option value="0">Status da Peça</option>
                            <?php View_Filtro::Mostrar_Status_Peca(); ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="item">
            <button onClick="Pesquisar()" class="ui fluid inverted large icon button"><i class="refresh icon"></i> Atualizar</button>
        </div>
    </nav>
</aside>
<div class="visible-xs">
    <div class="ui fluid blue labeled icon toggle button"><i class="left arrow icon"></i>Abrir Filtro de Busca</div>
    <div class="ui horizontal divider"></div>
</div>
<script type="text/javascript" src="/application/js/layout/menu/filtro.js"></script>