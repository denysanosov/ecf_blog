<?php include_once __DIR__ . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'header.php' ?>

<main>
    <h1>Créez votre compte</h1>
    <form action="creatingPDO.php" method="POST" id="formCreateAccount">
        <div>
            <label for="createFirstname">Prenom</label>
            <input type="text" name="createFirstname" id="createFirstname" required>
        </div>
        <div>
            <label for="createLastname">Nom</label>
            <input type="text" name="createLastname" id="createLastname" required>
        </div>
        <div>
            <label for="createLogin">Login</label>
            <input type="text" name="createLogin" id="createLogin" required>
        </div>
        <div>
            <label for="createSexe">Sexe</label>
            <select name="createSexe" id="createSexe">
                <option value="Male" selected>Homme</option>
                <option value="Female">Femme</option>
            </select>
        </div>
        <div>
            <label for="createPassword">Mot de passe</label>
            <input type="password" name="createPassword" id="createPassword" required>
        </div>
        <input type="submit" value="Valider">
    </form>
</main>
</body>
</html>