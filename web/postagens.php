<?php $v->layout("_base") ?>

<div class="content row justify-content-center">
    <?php 
        if($postagens): 
            foreach($postagens as $postagem):
            ?>
                <div class="card col-5 m-auto">
                    <div class="card-body">
                        <h5 class="card-header"><?= $postagem->getTitulo() ?></h5>
                        <a class="card-link" href="<?= "https://" . $postagem->getLink() ?>" target="_blank">
                            <?= $postagem->getLink() ?>
                        </a>
                        <p class="card-text"><?= $postagem->getDescricao() ?? "Sem descrição" ?></p>
                        
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