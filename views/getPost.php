<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

echo displayPosts($page);
?>