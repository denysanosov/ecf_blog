<?php

$navbar = ['Les publications' => '/', 'Qui sommes-nous' => '', 'FAQ' => ''];

function navbar() {
    global $navbar;

    foreach ($navbar as $onglet => $link) {
        echo '<li><a href="' . $link . '">' . $onglet . '</a></li>';
    };

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            echo '<li><a href="admin.php">Espace Admin</a></li>';
        }
    }
};

function displayConnectOrDisconnectButton() {
    if (isset($_SESSION['username'])) {
        echo '
            <div id="userCard">
                <div id="currentUser">
                    <i class="fa-solid fa-user-tie"></i>
                    <p>' . $_SESSION['username'] . '</p>
                </div>
                <div id="disconnectButton">
                    <a href="disconnect.php">Se déconnecter</a>
                </div>
            </div>
        ';
    } else {
        echo '
            <div id="userCard">
                <div id="connectButton">
                    <a href="login">Se connecter</a>
                </div>
            </div>
        ';
    };
};

function errorMessage() {
    if (isset($_SESSION['connexionError'])) {
        if ($_SESSION['connexionError'] == true) {
            echo '
                <p id="incorrectLogin">Utilisateur ou mot de passe incorrect</p>
            ';
        };
    };
};



require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Connexion.php';

function displayPosts($page) {
    $maConnexion = new Connexion();
    $maConnexion->connect();
    $connexion = $maConnexion->getConnexion();

    $postsPerPage = 12;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $startIndex = ($currentPage - 1) * $postsPerPage;

    $query = $connexion->query("SELECT posts.*, user.name
                                FROM posts
                                INNER JOIN user ON posts.userid = user.id
                                ORDER BY createdAt DESC
                                LIMIT $startIndex, $postsPerPage");

    $result = $query->fetchAll();


    foreach ($result as $post) {
        echo <<<HTML
            <article class="postArticle">
                <img src="https://images-eds-ssl.xboxlive.com/image?url=4rt9.lXDC4H_93laV1_eHM0OYfiFeMI2p9MWie0CvL99U4GA1gf6_kayTt_kBblFwHwo8BW8JXlqfnYxKPmmBRy_yZJaDwMVn4KFwVKCknVVq_vXxkQK4hFnotmQ5C7knE86nKRIgKUosotzf7QI1mOmFDeLbWybsCyMh2VaMes-&format=source" alt="">
                <p class="nameAndDate">{$post['name']}<br>{$post['createdAt']}</p>
                <strong>{$post['title']}</strong>
                <p>{$post['body']}</p>
                <form action="fullPost" method="GET">
                    <input type="hidden" name="idPost" value="{$post['id']}">
                    <button type="submit" id="buttonShowFull">Voir en entier</button>
                </form>
            </article>
        HTML;
    }
}

function showAdminPage() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();
        
            $query = $connexion->query("SELECT posts.*, user.name, CONCAT(LEFT(posts.body, 60), '...') AS shortBody
                                        FROM posts
                                        INNER JOIN user ON posts.userid = user.id
                                        ORDER BY createdAt DESC");
        
            $result = $query->fetchAll();
        
            // var_dump($result);
        
            echo '
            <table id="adminTable">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach ($result as $post) {
                        echo <<<HTML
                            <tr>
                                <td>{$post['name']}</td>
                                <td>{$post['title']}</td>
                                <td>{$post['createdAt']}</td>
                                <td>{$post['shortBody']}</td>
                                <td><a href="adminEdit.php?id={$post['id']}" class="editButton">Modifier</a></td>
                                <td><button class="deleteButton" data-post-id="{$post['id']}">Supprimer</button></td>
                            </tr>
                        HTML;
                    }
            echo '</tbody>
            </table>
            ';
        } else {
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
}

function showAdminEditPage() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            $postId = $_GET['id'];

            $maConnexion = new Connexion();
            $maConnexion->connect();
            $connexion = $maConnexion->getConnexion();
        
            $query = $connexion->query("SELECT posts.*, user.name
                                        FROM posts
                                        INNER JOIN user ON posts.userid = user.id
                                        WHERE posts.id = $postId");
        
            $result = $query->fetch();

            // var_dump($result);
            if (isset($_GET['error'])) {
                if ($_GET['error'] === 'emptyfields') {
                    echo '<div id="emptyFields">Veuillez remplir les champs</div>';
                }
            }

            if (isset($_GET['success'])) {
                if ($_GET['success'] === 'update') {
                    echo '<div id="updateSuccess">Modification validée</div>';
                }
            }

            echo <<<HTML
            <h1>Modifier la publication</h1>
            <form action="adminEditing.php" method="POST" id="adminEditForm">
                <input type="hidden" name="postId" value="{$result['id']}">
    
                <div>
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="{$result['title']}">
                </div>
    
                <div>
                    <label for="body">Contenu :</label><br>
                    <textarea id="body" name="body" rows="5">{$result['body']}</textarea>
                </div>
    
                <div>
                    <label for="author">Auteur :</label>
                    <input type="text" id="author" name="author" value="{$result['name']}" disabled>
                </div>
    
                <div>
                    <label for="date">Date :</label>
                    <input type="text" id="date" name="date" value="{$result['createdAt']}" disabled>
                </div>
    
                <button type="submit">Enregistrer les modifications</button>
            </form>
        HTML;
        } else {
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
}