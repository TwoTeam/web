<?php
include_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}

$user_id = $_SESSION['user_id'];
$user = user_data($link, $user_id);

if ($user['type'] == 0) {
    header('Location: index.php');
    die();
}
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
        <h1 class="title">EventHub</h1>
        <h3 class="sub_title">Pozdravljen, <?php echo $user['name'] . ' ' . $user['surname']; ?>.</h3>
        <br>
        <a href="#about" class="btn btn-light btn-lg">Dodaj dogodek</a>
    </div>
</header>

<!-- About -->
<section id="about" class="about bg-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Dodaj nov dogodek</h2><br />
                <div class="col-lg-6 col-lg-offset-3">
                    <form action="add_event.php" method="post">
                        <select class="form-control dropdown" name="genre">
                            <option disabled selected>Vrsta dogodka:</option>
                            <?php
                            $sql = mysqli_query($link, "SELECT * FROM genres");
                            while ($genre = mysqli_fetch_assoc($sql)) {
                                echo '<option value="' . $genre['id'] . '">';
                                echo $genre['name'];
                                echo '</option>';
                            }
                            ?>
                        </select><br />
                        <input class="form-control" type="text" name="name" placeholder="Ime dogodka:" /><br />
                        <input class="form-control" type="text" name="address" placeholder="Točen naslov dogodka:" /><br />
                        <!-- <select class="form-control dropdown" name="place">
                            <option disabled selected>Kraj dogodka:</option>
                            <?php
                            /* $sql = mysqli_query($link, "SELECT * FROM places ORDER BY name ASC");
                            while ($place = mysqli_fetch_assoc($sql)) {
                                echo '<option value="' . $place['id'] . '">';
                                echo $place['name'] . ' (Poštna številka: ' . $place['number'] . ')';
                                echo '</option>';
                            } */
                            ?>
                        </select><br /><br /> -->
                        <div class="input-group date datetime" data-start-view="4" lang="sl" data-date-format="dd. mm. yyyy ob hh:ii" >
                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                            <input placeholder="Datum in čas začetka dogodka" class="form-control" name="start" type="text">
                        </div><br />
                        <div class="input-group date datetime" data-start-view="4" lang="sl" data-date-format="dd. mm. yyyy ob hh:ii" >
                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                            <input placeholder="Datum in čas konca dogodka" class="form-control" name="end" type="text">
                        </div><br />
                        <textarea placeholder="Opis dogodka..." name="desc" class="form-control" rows="10"></textarea>
                        <br />
                        <input class="btn btn-lg btn-success" type="submit" value="Dodaj dogodek" />
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<script>
    $(".datetime")datetimepicker();
</script>
<?php
include_once 'footer.php';
?>