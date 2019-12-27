<?php $v->layout("_base"); ?>

<div class="jumbotron">
    <?php if (isset($data["error"])):
        ?>
        <h3 class="h3 text-danger"><?= $data["error"]; ?></h3>
        <?php 
        endif;
    ?>
    <h4 class="h4 text-center">this is a test</h4>
</div>