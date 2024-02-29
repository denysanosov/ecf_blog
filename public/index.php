<?php
require "../config/route.php";

if ($match !== false) {
    require "../template/header.php";
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../views/{$match['target']}.php";
    }
    require "../template/footer.php";
} else {
    require "../views/404.php";
}