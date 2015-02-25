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
            <a href="#about">Uredi dogodek</a>
        </li>
        <li>
            <a href="#vrsta">Uredi vrsto dogodka</a>
        </li>
        <li>
            <a href="#about2">Uredi državo</a>
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
        <a href="#about" class="btn btn-light btn-lg">Pregled dogodkov</a>
    </div>
</header>

<!-- pregled dogodkov -->
<section id="about" class="about bg-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Razpredelnica dogodkov</h2><br />
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="info">
                                <td><b>#</b></td>
                                <td><b>Ime dogodka</b></td>
                                <td><b>Kraj dogodka</b></td>
                                <td><b>Začetek dogodka</b></td>
                                <td><b>Konec dogodka</b></td>
                                <td><b>Opis dogodka</b></td>
                            </tr>
                            <?php
                            $stv = 1;
                            $sql = mysqli_query($link, "SELECT * FROM events ORDER BY event_start");
                            $barva1 = 'class="success"';
                            $barva2 = 'class="warning"';
                            while ($event = mysqli_fetch_assoc($sql)) {
                                $barva = ($stv % 2 == 0) ? $barva1 : $barva2;
                                echo '<tr '.$barva.'>';
                                echo '<td>'.$stv.'</td>';
                                echo '<td>'.$event['name'].'</td>';
                                echo '<td>'.$event['address'].'</td>';
                                echo '<td>'.dateToHuman($event['event_start']).'</td>';
                                echo '<td>'.dateToHuman($event['event_end']).'</td>';
                                if (strlen($event['description']) > 50) {
                                    echo '<td>'.substr($event['description'], 0, 50).'...</td>';
                                } else {
                                    echo '<td>'.$event['description'].'</td>';
                                }
                                echo '</tr>';
                                $stv++;
                            }
                            ?>
                        </tbody>
                    </table>
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