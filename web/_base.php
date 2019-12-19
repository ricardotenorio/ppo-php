<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= url("/web/css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= url("/web/css/style.css"); ?>">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <?php if($v->section("menu")): 
            echo $v-section("menu");
        else:
            ?>
            <a class="navbar-brand h1" href="<?= $router->route("web.home") ?>">Project</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon">
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("web.home") ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("web.postagens") ?>">Postagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("web.listas") ?>">Listas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("web.disciplinas") ?>">disciplinas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("web.assuntos") ?>">Assuntos</a>
                    </li>
                </ul>
            </div>

            <div class="justify-content-right">

                <?php if (isset($_SESSION["username"])):
                    ?>
                    <button type="button" class="btn btn-info"
                        data-toggle="collapse" data-target="#navbarLoginContent"> <?= $_SESSION["username"] ?> </button>
                    
                    <ul class="collapse justify-content-center navbar-nav" id="navbarLoginContent">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->route("login.logoutAction") ?>">Sair</a>
                        </li>
                    </ul>
                    <?php
                else:
                    ?>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active bg-danger m-2" href="<?= $router->route("signup.page") ?>">Sign-up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active bg-info m-2" href="<?= $router->route("login.page") ?>">Login</a>
                        </li>
                    </ul>
                    <?php
                endif
                ?>
            </div>
        <?php
        endif; 
        ?>
    </nav>

    <div class="container">
        <main class="main">
            <?= $v->section("content"); ?>
        </main>
    </div>

    <footer class="nav fixed-bottom bg-dark mt-auto">
        <p class="m-auto text-white h4 p-5">Project | 2019</p>
    </footer>   

    <script src="<?= url("/web/js/jquery-3.4.1.slim.min.js") ?>"></script>
    <script src="<?= url("/web/js/bootstrap.js") ?>"></script>
</body>
</html>