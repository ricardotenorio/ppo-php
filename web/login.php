<?php $v->layout("_base") ?>

<div class="content row justify-content-center">

    <h2 class="text-center col-12">Login</h2>
    <div class="jumbotron text-center">
        <form action="<?= ROOT ?>/login" method="POST">
            
            <div class="form-group col-12">
                <label for="nome-login">Nome de Usuário</label>
                <input type="text" class="form-control" id="nome-login" placeholder="Nome">
            </div>  

            <div class="form-group col-12">
                <label for="senha-login">Senha</label>
                <input type="password" class="form-control" id="senha-login" placeholder="Senha">
            </div>

            <button type="submit" class="btn btn-primary mx-auto">Entrar</button>

        </form>
    </div>
</div>