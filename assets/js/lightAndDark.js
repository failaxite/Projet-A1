let themeBtn = document.querySelector(".sombre"); //on get la class sombre
let body = document.querySelector('body'); // selection du body

if(window.localStorage.getItem("theme") != null){ //création themes
    if(window.localStorage.getItem("theme") == "dark"){ //si le theme = dark
        setDark();//execution de la fonction setDark
    } else { //Sinon
        setLight();//execution de la fonction setLight
    }
}

themeBtn.addEventListener('click', () => { //au clique
    if(body.style.backgroundColor == "#333" || body.style.backgroundColor == "rgb(51, 51, 51)"){
        setLight(); //execution de la fonction setLight
        window.localStorage.setItem("theme", "light"); 
    } else {
        setDark(); //execution de la fonction setDark
        window.localStorage.setItem("theme", "dark");
    }
});

function setDark(){
    themeBtn.textContent = "Thème Clair"; // on change le texte du bouton
    body.style.backgroundColor = "#333"; // changement de la couleur du background noir
}

function setLight(){
    themeBtn.textContent = "Thème Sombre"; // on change le texte du bouton
    body.style.backgroundColor = "#fff"; // changement de la couleur du background en blanc
}