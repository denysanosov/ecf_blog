let previous = document.getElementById('previous');
let next = document.getElementById('next');


document.addEventListener('DOMContentLoaded', function() {
    let page = 1;
    var totalPages = 9;

    loadPosts(page);

    previous.addEventListener('click', function() {
        if (page > 1) {
            page--;
            loadPosts(page);
            updateURL(page);
        }
    });

    next.addEventListener('click', function() {
        page++;
        loadPosts(page);
        updateURL(page);
    });

    function loadPosts(page) {
        fetch('getPost?page=' + page)
        .then(response => response.text())
        .then(data => {
            document.getElementById('sectionPosts').innerHTML = data;
            togglePaginationButtons(page);
        })
        .catch(error => console.error('Erreur Fetch:', error));
    }

    function updateURL(page) {
        var newURL = window.location.pathname + '?page=' + page;
        window.history.pushState({path:newURL},'',newURL);
    }

    function togglePaginationButtons(page) {
        
        if (page === 1) {
            previous.style.visibility = 'hidden';
        } else {
            previous.style.visibility = 'visible';
        }

        if (page === totalPages) {
            next.style.visibility = 'hidden';
        } else {
            next.style.visibility = 'visible';
        }
    }
});


document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.deleteButton');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var postId = this.getAttribute('data-post-id');

            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette publication ?");

            if(confirmation) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'adminDeleting.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        window.location.reload();
                    }
                };
                xhr.send('postId=' + postId);
            }
        });
    });
});