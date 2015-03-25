<?php
include_once 'database.php';
$hash = $_GET["hash"];

$sql = "SELECT * FROM users WHERE (hash='$hash')";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        include_once 'header.php';
        echo '
        <!-- dodajanje dogodka -->
        <section id="about" class="about bg-new">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Spremenitev gesla</h2><br />
                        <div class="col-lg-6 col-lg-offset-3">
                            <form class="ajaxForm" action="changedpass.php" method="post"><br /><br />
                                <input class="form-control" type="password" name="password1" placeholder="Novo geslo:" /><br />
                                <input class="form-control" type="password" name="password2" placeholder="Potrditev novega gesla:" /><br />
                                <br />
                                <input class="btn btn-lg btn-success" type="submit" value="Spremeni geslo" />
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>';
        include_once 'footer.php';
    }
} else {
    echo "0 results";
}
$link->close();
?>