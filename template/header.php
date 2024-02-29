<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecf Blog</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/js/app.js" defer></script>
    <?php include_once dirname(__DIR__). DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'function.php';
    session_start() ?>

</head>
<body>
    <header>
        <div id="logoAndNav">
            <img src="assets/img/vk.PNG" alt="logo">
            <nav>
                <ul> <?php navbar() ?> </ul>
            </nav>
        </div>
        <?php displayConnectOrDisconnectButton() ?>
    </header>