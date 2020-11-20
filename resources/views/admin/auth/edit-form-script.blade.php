<script type="text/javascript">
    const originLat = {{ Auth::user()->lat ?? 13.736717}};
    const originLng = {{ Auth::user()->lng ?? 100.523186}};

    function initMap() {
        myLatlng = {
            lat: originLat
            , lng: originLng
        };

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10
            , center: myLatlng
            , mapTypeId: "roadmap"
        , });
        // Create the initial InfoWindow.
        infoWindow = new google.maps.InfoWindow({
            content: "เลือกพิกัดนี้"
            , position: myLatlng
        , });
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon
                    , size: new google.maps.Size(71, 71)
                    , origin: new google.maps.Point(0, 0)
                    , anchor: new google.maps.Point(17, 34)
                    , scaledSize: new google.maps.Size(25, 25)
                , };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map
                        , icon
                        , title: place.name
                        , position: place.geometry.location
                    , })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            console.log(mapsMouseEvent);
            $("#lat").val(mapsMouseEvent.latLng.toJSON().lat);
            $("#lng").val(mapsMouseEvent.latLng.toJSON().lng);
            // console.log(mapsMouseEvent.latLng.toJSON().lat);
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng
            , });
            infoWindow.setContent(
                JSON.stringify("เลือกพิกัดนี้", null, 2)
            );
            infoWindow.open(map);
        });
    }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
        $("#lat").val(position.coords.latitude);
        $("lng").val(position.coords.longitude);
        newWD = new google.maps.InfoWindow({
            position: {lat: position.coords.latitude, lng: position.coords.longitude} });
        newWD.setContent(
        JSON.stringify("เลือกพิกัดนี้", null, 2)
        );
        newWD.open(map);
        map.setZoom(10);
        map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
        infoWindow.close();
    }

</script>
