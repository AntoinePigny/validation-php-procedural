<nav>
    <div class="nav-wrapper pink darken-4 darken-3">
        <span class="center brand-logo"> Bonjour, <?php echo (isset($_SESSION['login']))? $_SESSION['login'] : "invité" ?>.</span>
        <ul class="right">
            <li><a href='./index.php'>Accueil</a></li>
            <li><a href='./product-list.php'>Store</a></li>
            <?php echo (!isset($_SESSION['login']))?  "<li><a href='./login.php'>Login</a></li>" : "<li><a href='./authentification.php'>Logout</a></li>"; ?>
        </ul>
    </div>
</nav>