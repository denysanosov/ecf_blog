<main>
    <section id="pagination">
        <button id="previous">Precedent</button>
        <button id="next">Suivant</button>
    </section>

    <section id="sectionPosts">
        
        <?php if (isset($_GET['page'])) {
            $page = $_GET['page'];
        };

        // var_dump($match);

        displayPosts($page) ?>
    </section>
</main>