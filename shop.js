if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button') //Selection de la classe shop-item-button (tout le bouton "ajout au panier")
    for (var i = 0; i < addToCartButtons.length; i++) { //
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}

function purchaseClicked() {
    alert('Merci pour votre achat !')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateCartTotal()
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    addItemToCart(title, price, imageSrc)
    updateCartTotal()
}

//AJOUTER DES ITEMS A LA CARTE TOTAL

function addItemToCart(title, price, imageSrc) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('Cette item a déja été ajouté au panier')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-danger" type="button">SUPPRIMER</button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

//ACTUALISATION DES DONNEES DE LA CARTE TOTAL

function updateCartTotal() { //function pour update la carte de fin (prix total , etc , item)
    var cartItemContainer = document.getElementsByClassName('cart-items')[0] // get la class 'cart-items' et le premier element de celle ci
    var cartRows = cartItemContainer.getElementsByClassName('cart-row') // get la class 'cart-row'
    var total = 0 //init un total a 0
    for (var i = 0; i < cartRows.length; i++) { // init i = 0 |  si  la longueur de CartRows est superieur a i alors ajouter 1 a i
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', '')) // la variable price = transforme la chaine de caractere de la variable PriceElement et la remplace par le texte "$" et prépare un text vide "" pour le prix
        var quantity = quantityElement.value // la variable quantity (quantitée) = au value de la variable quantityElement
        total = total + (price * quantity) //calcul du total (prix*quantité)
    }
    total = Math.round(total * 100) / 100 //le Math.round permet de nous afficher un nombre arrondi a l'entier le plus proche de ce qu'on lui a demandé donc (total*100) / 100.
    document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total // le innerText reprend la valeur de base ecrite sur la page html qui est de "$0" pour ensuite remplacer par le texte "$" + le total
}