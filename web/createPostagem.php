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
    <div class="jumbotron text-center">
        <form action="<?= url("createPostagem") ?>" method="POST">

            <div class="form-group col-12">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título">
            </div>

            <div class="form-group col-12">
                <label for="link">Url</label>
                <input type="text" name="link" class="form-control" id="link" placeholder="Url">
            </div>

            <div class="form-group col-12">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" class="form-control" id="descricao" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mx-auto">Criar</button>

        </form>
    </div>
</div>