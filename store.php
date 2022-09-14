<!DOCTYPE html>
<html>
    <head>
        <title>ThinSpace | Boutique</title>
        <meta name="description" content="ezed coding">
        <link rel="stylesheet" href="" />
        <link rel="stylesheet" href="assets/css/shop.css" />
        <link rel="stylesheet" href="assets/css/test.css" />
        <script src="shop.js" async></script>
    </head>
    <body>
        <?php require 'Header.php'; ?>
        <?php require 'menu.php'; ?>
        <section class="container content-section">
            <h2 class="section-header">THINSPACE - BOUTIQUE</h2>
            <div class="shop-items">
                <div class="shop-item">
                    <span class="shop-item-title">OBJET 1</span>
                    <img class="shop-item-image" src="Images/casque.png">
                    <div class="shop-item-details">
                        <span class="shop-item-price">$12.99</span>
                        <button class="btn btn-primary shop-item-button" type="button">AJOUTER AU PANIER</button>
                    </div>
                </div>
                <div class="shop-item">
                    <span class="shop-item-title">OBJET 2</span>
                    <img class="shop-item-image" src="Images/casque.png">
                    <div class="shop-item-details">
                        <span class="shop-item-price">$14.99</span>
                        <button class="btn btn-primary shop-item-button"type="button">AJOUTER AU PANIER</button>
                    </div>
                </div>
                <div class="shop-item">
                    <span class="shop-item-title">OBJET 3</span>
                    <img class="shop-item-image" src="Images/casque.png">
                    <div class="shop-item-details">
                        <span class="shop-item-price">$9.99</span>
                        <button class="btn btn-primary shop-item-button" type="button">AJOUTER AU PANIER</button>
                    </div>
                </div>
                <div class="shop-item">
                    <span class="shop-item-title">OBJET 4</span>
                    <img class="shop-item-image" src="Images/casque.png">
                    <div class="shop-item-details">
                        <span class="shop-item-price">$19.99</span>
                        <button class="btn btn-primary shop-item-button" type="button">AJOUTER AU PANIER</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="container content-section">
            <h2 class="section-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">OBJET</span>
                <span class="cart-price cart-header cart-column">PRIX</span>
                <span class="cart-quantity cart-header cart-column">QUANTITEE</span>
            </div>
            <div class="cart-items">
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">$0</span>
            </div>
            <button class="btn btn-primary btn-purchase" type="button">POURSUIVRE</button>
        </section>
        <form class= "form" action="envoi.php" method="POST" class="envoi">
        <div>
            <label for="">Entre ton Pseudo</label>
            <input type="text" name="nom" placeholder="Pseudo">
        </div>

        <div>
            <label for="">Entre ton avis</label>
            <input type="message" name="message" placeholder="Message">
        </div>
        
        <div>
            <label for="">Entre ta note /5</label>
            <input type="message" name="note" placeholder="Note /5">
        </div>

        <button type="submit">Envoyer</button>
    </form>

        <footer class="main-footer">
            <div class="container main-footer-container">
                <h3 class="band-name">© 2021 Thin Space, tous droits réservés | Mentions légales | Politique de confidentialité</h3>
                <script type="text/javascript" src="assets/js/script.js"></script>
            </div>
        </footer>
    </body>
</html>