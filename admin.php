<?php
include_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}
?>

<!-- Navigation -->
<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
        <li class="sidebar-brand">
            <a href="#top">EventHub</a>
        </li>
        <li>
            <a href="#top">Predstavitev</a>
        </li>
        <li>
            <a href="#about">O aplikaciji</a>
        </li>
        <li>
            <a href="#services">Storitve</a>
        </li>
        <li>
            <a href="#portfolio">Izdelki</a>
        </li>
        <li>
            <a href="#contact">Kontakt</a>
        </li>
        <li></li>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li><a href="logout.php">Odjava</a></li>';
        } else {
            echo '<li><a href="login.php">Prijava</a></li>';
        }
        ?>
    </ul>
</nav>

<!-- Header -->
<header id="top" class="header admin-image">
    <div class="text-vertical-center">
        <h1>EventHub</h1>
        <h3>Pozdravljen, administrator.</h3>
        <br>
        <a href="#about" class="btn btn-light btn-lg">Dodaj dogodek</a>
    </div>
</header>

<!-- About -->
<section id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>O EventHub mobilni aplikaciji</h2>
                <p class="lead">S pomočjo GPS signala uporabniku na zemljevidu prikaže vse trenutne in prihajajoče dogodke v obsegu 30km.
                    <br />Dogodki se razvrstijo na uporabnikovi najljubši zvrsti glasbe.</p>
                <a href="download.php" class="btn btn-dark btn-lg">Prenos v1.0 (Android OS)</a>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<?php
include_once 'footer.php';
?>