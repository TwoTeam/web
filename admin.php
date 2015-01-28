<?php
include_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}

$user_id = $_SESSION['user_id'];
$user = user_data($user_id, $link);

if ($user['type'] == 0) {
    header('Location: index.php');
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
        <h3>Pozdravljen, <?php echo $user['name'].' '.$user['surname']; ?>.</h3>
        <br>
        <a href="#about" class="btn btn-light btn-lg">Dodaj dogodek</a>
    </div>
</header>

<!-- About -->
<section id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Dodaj nov dogodek</h2>
                <form action="add_event.php" method="post">
                    Vrsta dogodka:<br />
                    <select class="form-control dropdown" name="genre">
                        <?php
                        $sql = mysqli_query($link, "SELECT * FROM genres");
                        while ($genre = mysqli_fetch_assoc($sql)) {
                            echo '<option value="'.$genre['id'].'">';
                            echo $genre['name'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                    Ime dogodka:<br />
                    <input class="form-control" type="text" name="name" />
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<?php
include_once 'footer.php';
?>