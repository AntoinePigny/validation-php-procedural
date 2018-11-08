<?php

session_start();

if(isset($_COOKIE[$cookieName]))
{
    $clientCart = unserialize($_COOKIE[$cookieName]);
}

if (count($_POST > 0)) {
    $productToDel = [];
    $productToDel = ['name' => $_POST['productName'],
                    'price' => $_POST['productPrice'],
                    'quantity' => 1];
    if(isset($clientCart) && $clientCart != "")
    {
        $i = 0;

        foreach($clientCart['products'] as $products)
        {
            if($productToDel['name'] == $products['name'])
            {
                $clientCart['products'][$i]['quantity']--;
                $clientCart['prixTotal'] = $clientCart['prixTotal'] - $products['price'];
            }
            $i++;
        }
    }
    setcookie($cookieName, serialize($clientCart), time() + 3600);
}
