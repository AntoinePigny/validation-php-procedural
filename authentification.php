<?php

session_start();

//Si on est déjà log, logout et nous redirige vers l'index
if(isset($_SESSION['login']))
    {
        unset($_SESSION['login']);
        header('Location: ./login.php');
        exit;
    }

if(count($_POST) > 0)
{
    $_SESSION['error'] = "";

    //Creation de compte
    if($_POST['signin'] == 1)
    {
        $regexPW = "/^.*(?=.{6,10})(?=.*\d)(?=.*[a-zA-Z]).*$/";
        $regexMail = "/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/";
        $loginList = [];

        //On verifie si le mail est valide, sinon on redirige vers la page de login
        if(!preg_match($regexMail, $_POST['email']))
            $_SESSION['error'] .= 'Vous devez rentrer une adresse E-mail';
        if($_SESSION['error'] != "")
        {
            header('Location: ./login.php');
            exit;
        }

        //On verifie si le mdp est valide, sinon on redirige vers la page de login
        if($_POST['password'] != $_POST['password2'])
            $_SESSION['error'] .= 'Les mots de passe ne correspondent pas entre eux';
        if(!preg_match($regexPW, $_POST['password']))
            $_SESSION['error'] .= 'Le mot de passe doit contenir entre 6 & 10 caractères et contenir au moins 1 chiffre';
        if($_SESSION['error'] != "")
        {
            header('Location: ./login.php');
            exit;
        }


        
        $newClient = [
                        'email' => $_POST['email'],
                        'password' => sha1($_POST['password'])
                     ];

        //On sauvegarde le nouveau client dans le fichier clients
        $loginFile = fopen("users.txt", "c");
        $loginTxt = file_get_contents("users.txt");
        if($loginTxt != "")
        {
            $loginList = unserialize($loginTxt);
        }
        array_push($loginList, $newClient);
        fwrite($loginFile, serialize($loginList));

        $_SESSION['success'] = "Vous êtes désormais inscrit, vous pouvez vous connecter";
        header('Location: ./login.php');

    }
    //Sinon, il s'agit d'une tentative de login
    else
    {
        $loginTxt = file_get_contents("users.txt");
        $loginList = unserialize($loginTxt);

        if(count($loginList) > 0)
        {
            //On verifie si le client est deja enregistré
            foreach($loginList as $login)
            {
                if($_POST['email'] == $login['email'] && sha1($_POST['password']) == $login['password'])
                {
                    $_SESSION['login'] = $_POST['email'];
                    $_SESSION['success'] = "Vous êtes désormais connecté " . $_POST['email'] . " !";
                    header('Location: ./index.php');
                    exit;
                }
            }
        }
        $_SESSION['error'] = "Mauvais email/password.";
        header('Location: ./login.php');


    }
}