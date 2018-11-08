<?php

session_start();

$productList = [];

$productTxt = file_get_contents("./products.txt");
if($productTxt != "")
    {
        $productList = unserialize($productTxt);
    }

if(count($_POST) > 0)
{
    $newProduct =   ['name' => $_POST['productName'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price']];

    //On sauvegarde le nouveau produit dans le fichier produits
    $productFile = fopen("./products.txt", "c");
    array_push($productList, $newProduct);
    fwrite($productFile, serialize($productList));
}

header('Location: ./product-list.php');



