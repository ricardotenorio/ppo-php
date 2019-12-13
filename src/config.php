<?php
declare(strict_types = 1);

define("ROOT", "http://localhost/ppo-php");

function url(string $uri = null): string
{
    if($uri) {
        return ROOT . "/{$uri}";
    }

    return ROOT;
}
 