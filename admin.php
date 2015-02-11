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
            <a href="index.php">EventHub</a>
        </li>
        <li>
            <a href="events.php">Pregled dogodkov</a>
        </li>
        <li>
            <a href="#about">Dodaj dogodek</a>
        </li>
        <li>
            <a href="#vrsta">Dodaj vrsto dogodka</a>
        </li>
        <li>
            <a href="#about2">Dodaj državo</a>
        </li>
        <li></li>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li><a href="logout.php">Odjava</a></li>';
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
        <a href="#vrsta" class="btn btn-light btn-lg">Dodaj vrsto dogodka</a>
        <a href="#about2" class="btn btn-light btn-lg">Dodaj državo</a>
    </div>
</header>

<!-- dodajanje dogodka -->
<section id="about" class="about bg-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Dodaj nov dogodek</h2><br />
                <div class="col-lg-6 col-lg-offset-3">
                    <form class="ajaxForm" action="add_event.php" method="post">
                        <select name="genre" class="selectpicker" data-live-search="true" data-size="auto" data-width="100%" title="Vrsta dogodka">
                            <?php
                            $sql = mysqli_query($link, "SELECT * FROM genres");
                            while ($genre = mysqli_fetch_assoc($sql)) {
                                echo '<option value="' . $genre['id'] . '">';
                                echo $genre['name'];
                                echo '</option>';
                            }
                            ?>
                        </select><br /><br />

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

<!-- dodajanje vrste dogodka -->
<aside id="vrsta" class="call-to-action bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Dodaj vrsto dogodka</h2><br />
                <div class="col-lg-6 col-lg-offset-3">
                    <form class="ajaxForm" action="add_event_type.php" method="post">
                        <input class="form-control" type="text" name="name" placeholder="Ime dogodka:" /><br />
                        <textarea placeholder="Opis vrste dogodka..." name="desc" class="form-control" rows="10"></textarea>
                        <br />
                        <input class="btn btn-lg btn-success" type="submit" value="Dodaj vrsto dogodka" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- dodajanje države -->
<section id="about2" class="about bg-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Dodaj državo</h2><br />
                <div class="col-lg-6 col-lg-offset-3">
                    <form class="ajaxForm" action="add_country.php" method="post">
                        <input class="form-control" type="text" name="name" placeholder="Ime države:" /><br />
                        <input class="form-control" type="text" name="code" placeholder="Kratica države:" /><br />
                        <br />
                        <input class="btn btn-lg btn-success" type="submit" value="Dodaj državo" />
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