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

                        <input class="form-control" type="text" name="name" placeholder="Ime dogodka:" />
                        <div id="locationField">
                            <input id="autocomplete" class="form-control" placeholder="Vnesi kraj dogodka:" onFocus="geolocate()" type="text" />
                        </div><br />
                        <div id="map" class="form-control" onkeydown="enter();" style="height: 300px;"></div><br />
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<!--<script type="text/javascript">
    var marker;
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            center: {lat: 46.3621265, lng: 15.1111722},
            zoom: 14
        };
        map = new google.maps.Map(document.getElementById('map'),
                mapOptions);
        marker = new google.maps.Marker({
            position: {lat: 46.3621265, lng: 15.1111722},
            map: map,
            draggable: true,
            title: 'Lokacija dogodka'
        });
    }

    $(document).on("change", "[name=mapaddress]", function () {
        var address = document.getElementById('mapaddress').value;
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    });

    google.maps.event.addDomListener(window, 'load', initialize);
</script>-->
<!-- <script>
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(46.3621265, 15.1111722);
        var mapOptions = {
            zoom: 14,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

    function codeAddress() {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script> -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script>
    var geocoder;
    var marker;
    function enter() {
        $(document).keypress(function (e) {
            if (e.which === 13) {
                var address = document.getElementById('autocomplete').value;
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        marker.setVisible(false);
                        var place = results[0];
                        if (!place.geometry) {
                            return;
                        }
                        document.getElementById('autocomplete').value = place.formatted_address;
                        alert(place.geometry.location);
                        // console.log(place);
                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(14);  // Why 17? Because it looks good.
                        }
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                        infowindow.open(map, marker);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        });
    }

    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            center: new google.maps.LatLng(46.3621265, 15.1111722),
            zoom: 13
        };
        var map = new google.maps.Map(document.getElementById('map'),
                mapOptions);

        var input = /** @type {HTMLInputElement} */(
                document.getElementById('autocomplete'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        marker = new google.maps.Marker({
            position: {lat: 46.3621265, lng: 15.1111722},
            map: map,
            draggable: true,
            title: 'Lokacija dogodka'
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(14);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            google.maps.event.addDomListener(radioButton, 'click', function () {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
    }

    $(document).ready(function () {
        initialize();
    });
</script>

<?php
include_once 'footer.php';
?>