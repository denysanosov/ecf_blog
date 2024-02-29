<?php errorMessage() ?>

<?php if (isset($_SESSION['username'])) {
    header('Location: /');
} else {
    echo <<<HTML
        <main id="loginPage">
            <section>
                <form id="form" action="../cli/loggingPDO.php" method="POST">
                    <h2>Login</h2>
                    <div id="userField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div id="passwordField">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div id="remember">
                        <input type="checkbox" id="rememberMe" name="rememberMe">
                        <label for="rememberMe">Se souvenir de moi</label>
                    </div>
                    <input id="submitButton" type="submit" value="Se connecter">
                    <a href="" id="forgettenPassword">Mot de passe oublié ?</a>
                </form>               
            </section>

            <p id="createAccount">Pas encore de compte ? <a href="">Créer un compte</a></p>
    
        </main>
    HTML;
}; ?>