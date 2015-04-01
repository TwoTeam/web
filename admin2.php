<!-- za github da bo delalo :D -->

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
        <a href="#about" class="btn btn-light btn-lg">Dodaj dogodek</a>&nbsp;
        <a href="#vrsta" class="btn btn-light btn-lg">Dodaj vrsto dogodka</a>&nbsp;
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
                    <form class="ajaxForm" action="post.php" method="post">
                        <select name="genre" class="selectpicker" data-live-search="true" data-size="auto" data-width="100%" title="Vrsta dogodka">
                            <option disabled selected>Vrsta dogodka</option>
                            <?php
                            $sql = mysqli_query($link, "SELECT * FROM genres");
                            while ($genre = mysqli_fetch_assoc($sql)) {
                                echo '<option value="' . $genre['id'] . '">';
                                echo $genre['name'];
                                echo '</option>';
                            }
                            ?>
                        </select><br /><br />

                        <input class="form-control" type="text" name="name" placeholder="Ime dogodka:" />
                        <br />

                        <input id="pac-input" class="form-control controls" type="text" placeholder="Vnesite točen naslov dogodka...">
                        <div class="form-control" id="map-canvas"></div><br />
                        <input name="lokacija" class="form-control" type="text" id="marker_location" value="" placeholder="Lokacija (premaknite marker na mapi)" /><br />
                        <input name="naslov" class="form-control" type="text" id="marker_address" value="" placeholder="Google naslov" /><br />
                        <input name="org_naslov" class="form-control" type="text" id="typed_address" value="" placeholder="Naslov" /><br />

                        <div class="input-group date datetime" data-start-view="4" lang="sl" data-date-format="dd. mm. yyyy ob hh:ii" >
                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                            <input placeholder="Datum in čas začetka dogodka" class="form-control" name="start" type="text">
                        </div><br />
                        <div class="input-group date datetime" data-start-view="4" lang="sl" data-date-format="dd. mm. yyyy ob hh:ii" >
                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                            <input placeholder="Datum in čas konca dogodka" class="form-control" name="end" type="text">
                        </div><br />
                        <textarea placeholder="Opis dogodka..." name="desc" class="form-control" rows="10"></textarea><br />
                        <br /><input class="btn btn-lg btn-success" type="submit" value="Dodaj dogodek" />
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpCfd_V_fbUoF5d2MjBfViV2M0KhrKYCk"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<!-- custom map by mausy -->
<script>
    function initialize() {
        var markers = [];

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 12
        });

        var defaultBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(46.3621265, 15.1111722),
                new google.maps.LatLng(46.3621265, 15.1111722));
        map.fitBounds(defaultBounds);

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox(
                /** @type {HTMLInputElement} */(input));

        // [START region_getplaces]
        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });

                markers.push(marker);

                //dodaj lokacijo v input + posodobi, če je marker spremenil lokacijo
                //preberi formatiran naslov iz koordinat
                google.maps.event.addListener(marker, 'dragend', function ()
                {
                    document.getElementById('marker_location').value = marker.getPosition();
                });

                document.getElementById('marker_address').value = place.formatted_address;
                document.getElementById('typed_address').value = document.getElementById('pac-input').value;
                map.setCenter(place.geometry.location);
                map.setZoom(14);
                bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
        });
        // [END region_getplaces]

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map, 'bounds_changed', function () {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php
include_once 'footer.php';
?>