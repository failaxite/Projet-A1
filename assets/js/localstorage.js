let inputs = [document.querySelector('.envoie > div > input[name="name"]'), document.querySelector('.envoie > div > input[name="mail"]'), document.querySelector('.envoie > div > input[name="tel"]')];

inputs.forEach(input => {
    if(window.localStorage.getItem(input.getAttribute("name")) != null){
        input.value = window.localStorage.getItem(input.getAttribute("name"));
    }
});

inputs.forEach(input => {
    input.addEventListener('input', (e) => {
        let newVal = e.target.value;
        let name = e.target.attributes.name.value;
        window.localStorage.setItem(name, newVal);
        console.log(name + " : " + window.localStorage.getItem(name));
    });
});