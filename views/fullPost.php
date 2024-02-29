<main id="mainFullPost">
<?php
    $idPost = $_GET['idPost'];

    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Connexion.php';

    $maConnexion = new Connexion();

    $maConnexion->connect();

    $connexion = $maConnexion->getConnexion();

    $queryPost = $connexion->prepare("SELECT posts.*, user.name
                                    FROM posts
                                    INNER JOIN user ON posts.userid = user.id
                                    WHERE posts.id = ?");
    $queryPost->execute([$idPost]);
    $post = $queryPost->fetch(PDO::FETCH_ASSOC);

    $queryComments = $connexion->prepare("SELECT * FROM comments WHERE postId = ?");
    $queryComments->execute([$idPost]);
    $comments = $queryComments->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($post);
    ?>

    <section id="fullPost">
        <img src="img/doge.png" alt="">
        <div>
            <p><?php echo $post['name']; ?> <br> <?php echo $post['createdAt']; ?></p>
            <h1><?php echo $post['title']; ?></h1>
            <p><?php echo $post['body']; ?></p>
        </div>
    </section>

    <section id="commentsPart">
    <h2>Commentaires</h2>
    <?php foreach ($comments as $comment): ?>
        <article class="fullPostArticle">
            <p><?php echo $comment['email'] . ' - ' . $comment['createdAt']; ?></p>
            <p><?php echo $comment['body']; ?></p>
        </article>
    <?php endforeach; ?>
    </section>
</main>




    




<?php include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'footer.php' ?>