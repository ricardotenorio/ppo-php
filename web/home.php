<?php $v->layout("_base") ?>

<div class="postagens">
    <?php 
        if($postagens): 
            foreach($postagens as $postagem):
            ?>
                <article class="postagens_postagem">
                    <h3><?= $postagem->getTitulo() ?></h3>
                </article>
            <?php
            endforeach;
        else:
        ?>
            <h2>Não existem postagens</h2>
        <?php
        endif;
    ?>
</div>

<div>
        <a href="<?= $router->route("web.home") ?>">Voltar</a>
        <a href="<?= $router->route("test.hello") ?>">Hello</a>
</div>