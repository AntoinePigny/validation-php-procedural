<?php

session_start();
require_once('./template/header.php');
require_once('./template/navbar.php');
?>
<main class="container">
    <div class="row">
    <h2>Liste des Produits</h2>
    <section class="col m8">
        
        <div class="row">
        <?php 
            $productList = [];

            $productTxt = file_get_contents("products.txt");
            if($productTxt != "")
                {
                    $productList = unserialize($productTxt);
                }

            if(count($productList) >0)
            {
                foreach($productList as $product)
                {
                    echo '<div class="col m12 l6">
                            <form action="./cart.php" method="POST">
                                <div class="card pink darken-3">
                                    <div class="card-content white-text">
                                        <span class="card-title">' . $product['name'] . '</span>
                                        <p>Prix: ' . $product['price'] . '€</p>
                                        <br>
                                        <p>Description: ' . $product['description'] . '</p>
                                        <input type="hidden" name="productName" value=' . $product['name'] . '>
                                        <input type="hidden" name="productPrice" value=' . $product['price'] . '>
                                        <input type="hidden" name="productDescription" value=' . $product['description'] . '>
                                        </div>
                                        <div class="card-action">';
                                        if(isset($_SESSION['login']))
                                        {
                                            echo '<button class="btn waves-effect waves-light" type="submit" name="action">Ajouter au Panier
                                                    <i class="material-icons right">send</i>
                                                </button>';
                                        }
                                        else
                                        {
                                            echo '<button class="btn waves-effect waves-light disabled" type="submit" name="action">Connectez vous
                                                    <i class="material-icons right">send</i>
                                                </button>';
                                        }
                                        
                                        echo '</div></div></form></div>';
                        }
                }
                else
                {
                    echo "<p>Plus de stock :(</p>";
                }
                ?>
         </div>
    </section>
    <section class="col m4">
        <h4>Votre Panier :</h4>
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
                echo "<td>Connectez vous pour ajouter des produits a votre panier</td>";
            }
            ?>
        </tbody>
        </table>
        <?php
       if(isset($_SESSION['login']) && isset($_COOKIE[$cookieName]))
       {
            echo '<br><button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                    </button>';
       }
       ?>
        <br><br><br>
        <h4>Nouveau Produit</h4>
        <form action="./products.php" method="POST">
            <div class="input-field">
                <label for="productName">Nom</label>
                <input type="text" name="productName" required>
            </div>
            <div class="input-field">
                <label for="price">Prix (€)</label>
                <input type="number" name="price" required>
            </div>
            <div class="input-field">
                <label for="description">Description</label>
                <textarea id="description" class="materialize-textarea" name="description"></textarea>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                <i class="material-icons right">send</i>
            </button>
        </form>
    </section>
    </div>
</main>

<?php
require_once('./template/footer.php');
?>