<?php $v->layout("_base") ?>

<div class="content row justify-content-center">

    <h2 class="text-center col-12">Cadastro</h2>
    <div class="jumbotron text-center">
        <form action="<?= url("signup") ?>" method="POST">

            <div class="form-group col-12">
                <label for="nome">Nome de Usuário</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
            </div>

            <div class="form-group col-12">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>

            <div class="form-group col-12">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
            </div>

            <button type="submit" class="btn btn-primary mx-auto">Entrar</button>

        </form>
    </div>
</div>