<?php

session_start();
require_once('./template/header.php');
require_once('./template/navbar.php');

if(isset($_SESSION['success']) && $_SESSION['success'] != "")
{
    echo '<div class="row">
            <div class="col s12">
                <div class="card-panel center-align green darken-3">
                    <span class="white-text">'. $_SESSION['success'] . '</span>
                </div>
            </div>
        </div>'; 
    unset($_SESSION['success']);
}
?>

<main class="container">
    <div class="row">
        <section class="col m8">
        <h1>That's why you always leave a note, <?php echo (isset($_SESSION['login']))? $_SESSION['login']: "dude";?>!</h1>
        <p>I care deeply for nature. Say goodbye to these, because it's the last time! That's what it said on 'Ask Jeeves.' I hear the jury's still out on science. Bad news. Andy Griffith turned us down. He didn't like his trailer.
        What's Spanish for "I know you speak English? " Bad news. Andy Griffith turned us down. He didn't like his trailer. Whoa, this guy's straight? Army had half a day. No! I was ashamed to be SEEN with you. I like being with you.</p>       
        </section>
        <section class="col m4">
        <h4>Votre Panier</h4>
        <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(isset($_SESSION['login']))
            {
                $cookieName = 'cart-' . str_replace('.', '_', $_SESSION['login']);

                if(isset($_COOKIE[$cookieName]))
                {
                    $clientCart = unserialize($_COOKIE[$cookieName]);
                    foreach($clientCart['products'] as $products)
                    {
                        echo "<tr>";
                        echo "<td>" . $products['name'] . "</td>";
                        echo "<td>" . $products['quantity'] . "</td>";
                        echo "<td>" . $products['price'] . " €</td>";
                        echo "<td>f</td>";
                        echo "</tr>";
                    }
                    echo "<tr><td>Total :</td><td></td><td>" . $clientCart['prixTotal'] . " €</td></tr>";
                }
                else
                {
                    echo "<td>Votre Panier est vide</td>";
                }
            }
            else
            {
                echo "<td>Connectez vous pour ajouter des produits dans votre panier</td>";
            }
            ?>
        </tbody>
        </table>
        <?php
       if(isset($_SESSION['login']) && isset($_COOKIE[$cookieName]))
       {
            echo '<br><button class="btn waves-effect waves-light" type="submit" name="action">Checkout
                    <i class="material-icons right">send</i>
                    </button>';
       }
       ?>
       </section>
    </div>
</main>

<?php
require_once('template/footer.php');
?>





<td><form action=""></form></td>