let btns = document.querySelectorAll('.btn');

btns.forEach(btn => {
    btn.addEventListener('click', () => {
        /*'btn-livre btn'
        ['btn-livre', 'btn'];
        'btn-livre';
        ['btn', 'livre'];*/
        let cat = btn.className.split(" ")[0].split("-")[1];
        //Sélectionne tout les articles
        let articles = document.querySelectorAll('.article');
        //pour chaque article
        articles.forEach(article => {
            let categorie = article.className.split(" ")[2];
            if(categorie != cat) { //si la catégorie n'est pas = a la cat defini
                article.style.display = 'none'; //display none (pas affiché)
            } else { //sinon
                article.style.display = 'block'; //display block (affiché)
            }
        });
    });
});