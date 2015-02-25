<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        <script>
            function initialize() {
                var mapOptions = {
                    center: new google.maps.LatLng(-33.8688, 151.2195),
                    zoom: 13
                };
                var map = new google.maps.Map(document.getElementById('map-canvas'),
                        mapOptions);

                var input = /** @type {HTMLInputElement} */(
                        document.getElementById('autocomplete'));

                var types = document.getElementById('type-selector');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29),
                    draggable: true
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

        </script>
        <style>
            #locationField, #controls {
                position: relative;
                width: 480px;
            }
            #autocomplete {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 99%;
            }
            .label {
                text-align: right;
                font-weight: bold;
                width: 100px;
                color: #303030;
            }
            #address {
                border: 1px solid #000090;
                background-color: #f0f0ff;
                width: 480px;
                padding-right: 2px;
            }
            #address td {
                font-size: 10pt;
            }
            .field {
                width: 99%;
            }
            .slimField {
                width: 80px;
            }
            .wideField {
                width: 200px;
            }
            #locationField {
                height: 20px;
                margin-bottom: 2px;
            }
        </style>
    </head>

    <body onload="initialize()">
        <div id="locationField">
            <input id="autocomplete" placeholder="Vnesi kraj dogodka:"
                   onFocus="geolocate()" type="text"></input>
        </div>
        <div id="map-canvas"></div>
    </body>
</html>