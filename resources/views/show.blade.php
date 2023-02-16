<h1 id="lat"></h1>
<h1 id="lng"></h1>

<script>
    // get geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            // var pos = {
            //     lat: position.coords.latitude,
            //     lng: position.coords.longitude
            //     document.getElementById('lat').value = pos.lat;
            //     document.getElementById('lng').value = pos.lng;
            // };
            // set geolocation
            document.getElementById('lat').innerHTML = position.coords.latitude;
            document.getElementById('lng').innerHTML = position.coords.longitude;
            console.log(position.coords.latitude);
            console.log(position.coords.longitude);
        });
    }
</script>
