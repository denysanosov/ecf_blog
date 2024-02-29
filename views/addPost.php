<form action="../cli/adminAdding.php" method="POST" id="addPostForm">
    <div>
        <label for="addAuthor">Auteur :</label>
        <input type="text" name="addAuthor" id="addAuthor" value="Jhon Doe" disabled>
    </div>

    <div>
        <label for="addTitle">Titre :</label>
        <input type="text" name="addTitle" id="addTitle">
    </div>

    <div>
        <label for="addBody">Contenu :</label>
        <textarea name="addBody" id="addBody" cols="30" rows="10"></textarea>
    </div>

    <button type="submit">Valider</button>
</form>