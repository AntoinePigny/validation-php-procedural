<?php

session_start();

require_once('./template/header.php');
require_once('./template/navbar.php');
?>

<main class="container"> 
    <?php
    if(isset($_SESSION['error']) && $_SESSION['error'] != "")
    {
        echo '<div class="row">
                <div class="col s12">
                    <div class="card-panel center-align red darken-3">
                        <span class="white-text">'. $_SESSION['error'] . '</span>
                    </div>
                </div>
            </div>';
        unset($_SESSION['error']);
    }
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
    
      

    <div class="row">
        <section class="col s6">
            <h4>Vous avez déjà un compte ?</h4>
            <h3 >Log in</h3  >
            <form action="./authentification.php" method="POST">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="validate">
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="validate">
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Connection
                    <i class="material-icons right">send</i>
                </button>
                <input type="hidden" name="signin" value="0">
                
            </form>
        </section>
        <section class="col s6">
            <h4>Créez un nouveau compte</h4>
            <h3 >Sign in</h3 >
            <form action="./authentification.php" method="POST">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="validate">
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="validate">
                </div>
                <div class="input-field">
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" class="validate">
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Creer
                    <i class="material-icons right">send</i>
                </button>
                <input type="hidden" name="signin" value="1">
            </form>
        </section>
    </div>
</main>

<?php

require_once('./template/footer.php');

?>