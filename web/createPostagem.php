<?php 
    $v->layout("_base");
    if (session_status() != PHP_SESSION_ACTIVE):
        session_start();
    endif;
    if (!isset($_SESSION["username"])):
        $router->redirect("login.page");
    endif;
?>

<div class="content row justify-content-center">

    <h2 class="text-center col-12">Criar nova postagem</h2>
    <div class="jumbotron text-center col-sm-12 col-md-8">
        <form action="<?= url("createPostagem") ?>" method="POST">

            <div class="form-group col-12">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título" required>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownDisciplinas" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Disciplina
                </button>
                <div class="dropdown-menu col-sm-10 col-md-5" aria-labelledby="dropdownDisciplinas">
                    <?php 
                        if ($disciplinas):
                            foreach($disciplinas as $disciplina):
                                $nomeDisciplina = $disciplina->getNome();
                                ?>
                                <div class="form-check form-check-inline col-12">
                                    <input class="form-input-check dropdown-item col-3" type="radio" id="<?= $nomeDisciplina; ?>" name="disciplina" value="<?= $nomeDisciplina; ?>">
                                    <label class="form-check-label dropdown-item col-8" for="<?= $nomeDisciplina; ?>">
                                        <?= $nomeDisciplina; ?>
                                    </label>
                                </div>
                            <?php
                            endforeach;
                        endif; 
                    ?>
                </div>
            </div>

            <div class="form-group col-12">
                <label for="assunto">Assunto</label>
                <input type="text" name="assunto" class="form-control" id="assunto" placeholder="assunto" required>
            </div>

            <div class="form-group col-12">
                <label for="link">Url</label>
                <input type="text" name="link" class="form-control" id="link" placeholder="Url" required>
            </div>

            <h6 class="h6">Tipo de Mídia</h6>

            <div class="form-group">

                <div class="form-check form-check-inline col-12">
                    <input class="form-input-check col-1" type="radio" id="video" name="tipo" value="video" checked>
                    <label class="form-check-label col-sm-5 col-md-3" for="video">
                        Video
                    </label>

                    <input class="form-input-check col-1" type="radio" id="texto" name="tipo" value="texto">
                    <label class="form-check-label col-sm-5 col-md-3" for="texto">
                        Texto
                    </label>
                </div>

                <div class="form-check form-check-inline col-12">
                    <input class="form-input-check col-1" type="radio" id="audio" name="tipo" value="audio">
                    <label class="form-check-label col-sm-5 col-md-3" for="audio">
                        Audio
                    </label>

                    <input class="form-input-check col-1" type="radio" id="imagem" name="tipo" value="imagem">
                    <label class="form-check-label col-sm-5 col-md-3" for="imagem">
                        Imagem
                    </label>
                </div>

                <div class="form-check form-check-inline col-12">
                    <input class="form-input-check col-1" type="radio" id="outro" name="tipo" value="outro">
                    <label class="form-check-label col-sm-5 col-md-3" for="outro">
                        Outro
                    </label>
                </div>
            </div>

            <div class="form-group col-12">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" class="form-control" id="descricao" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-5 mx-auto col-8">Criar</button>

        </form>
    </div>
</div>