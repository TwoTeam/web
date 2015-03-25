<?php
include_once 'header.php';
?>

<ul style="list-style-type: none;" class="cb-slideshow">
    <li><span></span><div></div></li>
    <li><span></span><div></div></li>
    <li><span></span><div></div></li>
    <li><span></span><div></div></li>
    <li><span></span><div></div></li>
    <li><span></span><div></div></li>
</ul>

<!-- Navigation -->
<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
        <li class="sidebar-brand">
            <a href="index.php">EventHub</a>
        </li>
        <li>
            <a href="#top">Predstavitev</a>
        </li>
        <li>
            <a href="#about">O aplikaciji</a>
        </li>
        <li>
            <a href="#portfolio">Slike</a>
        </li>
        <li>
            <a href="#contact">Kontakt</a>
        </li>
        <li></li>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li><a href="admin.php">Admin</a></li>';
            echo '<li><a href="logout.php">Odjava</a></li>';
        } else {
            echo '<li><a href="login.php">Prijava</a></li>';
        }
        ?>
    </ul>
</nav>

<!-- Header -->
<header id="top" class="header index-image">
    <div class="text-vertical-center">
        <h1 class="title">EventHub</h1>
        <h3 class="sub_title">Nikoli več ne zamudite dogajanja.</h3>
        <br>
        <a href="#about" class="btn btn-light btn-lg">Prenos</a>
    </div>
</header>

<!-- About -->
<section id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>EventHub mobilna aplikacija</h2>
                <p class="lead">Prenos mobilne aplikacije za operacijske sisteme Android in Windows Phone.</p>
                <a href="download.php" class="btn btn-dark btn-lg">Prenos v1.0 (Android OS)</a>&nbsp;
                <a href="download.php" class="btn btn-dark btn-lg">Prenos v1.0 (Windows Phone OS)</a>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!-- Callout -->
<aside class="callout">
    <div class="text-vertical-center">
        <h1>EventHub</h1>
        <h3>Where fun connects people together!</h3>
        <h3>Kjer zabava združuje ljudi!</h3>
    </div>
    <div class="imageOne image"></div>
    <div class="imageTwo image"></div>
</aside>

<!-- Call to Action -->
<aside class="call-to-action bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Download English Mobile Version</h3>
                <a href="#" class="btn btn-lg btn-light">Android Download!</a>
                <a href="#" class="btn btn-lg btn-dark">Windows Phone Download!</a>
            </div>
        </div>
    </div>
</aside>

<!-- Footer -->
<footer id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <h4><strong>EventHub</strong>
                </h4>
                <p>Trg mladosti 3<br />3320 Velenje, Slovenija</p>
                <ul class="list-unstyled">
                    <li><i class="fa fa-phone fa-fw"></i> +386 (0) 70 723 596</li>
                    <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:info@eventhub.com">info@eventhub.com</a>
                    </li>
                </ul>
                <br>
                <ul class="list-inline">
                    <li>
                        <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                    </li>
                </ul>
                <hr class="small">
                <p class="text-muted">Copyright &copy; 2015 EventHub<br />Vse pravice pridržane!</p>
            </div>
        </div>
    </div>
</footer>

<?php
include_once 'footer.php';
?>