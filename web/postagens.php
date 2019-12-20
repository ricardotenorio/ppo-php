<?php $v->layout("_base") ?>

<div class="content row justify-content-center">
    <?php 
        if($postagens): 
            foreach($postagens as $postagem):
            ?>
                <div class="card col-md-5 col-sm-10 mx-auto">
                    <h5 class="card-header"><?= $postagem->getTitulo() ?></h5>
                    <div class="card-body">
                        <a class="text-muted" href="#"><?= $postagem->getAssunto()->getDisciplina()->getNome(); ?></a>
                        <a class="text-muted" href="#"><?= $postagem->getAssunto()->getNome(); ?></a>
                        <br>
                        <a class="card-link" href="<?= $postagem->getLink() ?>" target="_blank">
                            <?= $postagem->getLink() ?>
                        </a>
                        <p class="card-text"><?= $postagem->getDescricao() ?? "Sem descrição" ?></p>                    
                    </div>
                    <div class="card-footer">
                        <p class="h6">Postado por: <?= $postagem->getUsuario()->getNome(); ?></p>
                        <p class="h6"><?= $postagem->getDataCriacao(); ?></p>
                    </div>
                </div>
            <?php
            endforeach;
        else:
        ?>
            <h2 class="h2">Não existem postagens</h2>
        <?php
        endif;
    ?>
</div>