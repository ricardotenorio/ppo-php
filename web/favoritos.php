<?php $v->layout("_base"); ?>

<h5 class="h5 text-center">Favoritos</h5>
<h6 class="h6 text-center"><?= $descricao ?></h6>

<div class="content row">
    <?php 
        if($postagens): 
            foreach($postagens as $postagem):
            ?>
                <div class="card col-md-5 col-sm-9 mx-auto my-3">
                    <h5 class="card-header text-center"><?= $postagem->getTitulo() ?></h5>
                    <div class="card-body">
                        <a class="text-muted" href="#"><?= $postagem->getAssunto()->getDisciplina()->getNome(); ?></a>
                        <a class="text-muted" href="#"><?= $postagem->getAssunto()->getNome(); ?></a>
                        <br>
                        <a class="card-link" href="<?= $postagem->getLink() ?>" target="_blank">
                            <?= $postagem->getLink() ?>
                        </a>
                        <p class="card-text text-justify"><?= $postagem->getDescricao() ?? "Sem descrição" ?></p>                    
                    </div>
                    <div class="card-footer text-center">
                        <p class="h6 font-weight-light">Postado por: <?= $postagem->getUsuario()->getNome(); ?></p>
                        <p class="h6 font-weight-light"><?= $postagem->getDataCriacao(); ?></p>
                        <button type="button" class="btn btn-primary" data-action="<?= $router->route("lista.removePostagemAction") ?>"
                            data-id="<?= $postagem->getId() ?>">Remover</button>
                        <?php if (isset($_SESSION["username"]) && $postagem->getUsuario()->getNome() == $_SESSION["username"]):
                            ?>
                            <a class="btn btn-info" href="<?= $router->route("postagens.edit", ["postagem_id" => $postagem->getId()]) ?>">Editar</a>
                            <button type="button" class="btn btn-danger" data-action="<?= $router->route("postagens.delete") ?>" 
                                data-id="<?= $postagem->getId() ?>">Deletar</button>
                            <?php
                            endif
                            ?>
                    </div>
                </div>
            <?php
            endforeach;
        else:
        ?>
            <h2 class="h2 text-center my-5 col-sm-10 col-md-12">Não existem postagens</h2>
        <?php
        endif;
    ?>
</div>


<?php $v->start("js"); ?>
<script>
    $(function() {
        function load(action) {
            var load_div = $(".ajax_load");
            if (action === "open") {
                load_div.fadeIn();   
            } else {
                load_div.fadeOut();
            }
        }

        $("body").on("click", "[data-action]", function (e) {
            e.preventDefault();
            var data = $(this).data();
            var div = $(this).parent().parent();

            $.post(data.action, data, function() {
                    div.fadeOut();
                }, "json").fail(function () {
                console.log("error");
            });
        });
    }
    );
</script>
<?php $v->end(); ?>