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

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <?php if($v->section("menu")): 
            echo $v-section("menu");
        else:
            ?>
            <a class="navbar-brand h1" href="#">Test</a>
        <?php
        endif; 
        ?>
    </nav>
    
    <main class="main">
        <?= $v->section("content"); ?>
    </main>

    <footer class="footer">
    </footer>

    <script src="<?= url("/web/js/jquery-3.4.1.slim.min.js") ?>"></script>
    <script src="<?= url("/web/js/bootstrap.js") ?>"></script>
</body>
</html>