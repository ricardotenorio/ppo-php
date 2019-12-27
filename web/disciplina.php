<?php $v->layout("_base"); ?>

<?php if (isset($data["error"])):
    ?>
    <h5 class="h5 text-danger"><?= $data["error"] ?></h5>
    <?php
    endif
?>

<?php $v->section("header"); ?>

<div class="content row">

    <div class="dropdown justify-content-center col-12">
        <form action="<?= $router->route("disciplina.page") ?>" method="GET">
            <button class="btn btn-secondary btn-block col-5 dropdown-toggle" type="button" id="dropdownDisciplinas" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Disciplina
            </button>
            <div class="dropdown-menu col-sm-10 col-md-5" aria-labelledby="dropdownDisciplinas">
                <?php 
                    if ($disciplinas):
                        $count = 0;
                        foreach($disciplinas as $disciplina):
                            $nomeDisciplina = $disciplina->getNome();
                            ?>
                            <div class="form-check form-check-inline col-12">
                                <input class="form-input-check dropdown-item col-3" type="radio" 
                                    id="<?= $nomeDisciplina; ?>" name="disciplina" value="<?= $nomeDisciplina; ?>" <?php if ($count++ == 0): echo "checked"; endif; ?>>
                                <label class="form-check-label dropdown-item col-8" for="<?= $nomeDisciplina; ?>">
                                    <?= $nomeDisciplina; ?>
                                </label>
                            </div>
                        <?php
                        endforeach;
                    endif; 
                ?>
            </div>

            <button class="btn btn-primary col-3" type="submit">Filtrar</button>
        </form>
    </div>

    <?php 
        if($postagens): 
            foreach($postagens as $postagem):
            ?>
                <div class="card col-md-5 col-sm-9 mx-auto my-3">
                    <h5 class="card-header text-center"><?= $postagem->getTitulo() ?></h5>
                    <div class="card-body">
                        <a class="text-muted" href="<?php $router->route("disciplina.page",
                            ["disciplina" => $postagem->getAssunto()->getDisciplina()->getNome()]);
                            ?>"><?= $postagem->getAssunto()->getDisciplina()->getNome(); ?></a>
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
                        <?php if (isset($_SESSION["username"])):
                            ?>
                            <button type="button" class="btn btn-primary" data-action="<?= $router->route("postagens.add") ?>" 
                                data-id="<?= $postagem->getId() ?>">Adicionar</button>
                            <?php if ($postagem->getUsuario()->getNome() == $_SESSION["username"]):
                                ?>
                                <a class="btn btn-info" href="<?= $router->route("postagens.edit", ["postagem_id" => $postagem->getId()]) ?>">Editar</a>
                                <button type="button" class="btn btn-danger delete-post" data-action="<?= $router->route("postagens.delete") ?>" 
                                    data-id="<?= $postagem->getId() ?>">Deletar</button>
                                <?php
                                endif
                                ?>
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