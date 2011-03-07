(function($) {
    $(document).ready(function() {
        var gMap = null;
        var mapBounds = null;
        var gMapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scaleControl: true,
                scrollwheel: false
        }

        if (poiArray) {
            gMap = new google.maps.Map(document.getElementById("GoogleMap"),gMapOptions);
            mapBounds = new google.maps.LatLngBounds();
            for (i=0;i<poiArray.length;i++) {
                var poiData = poiArray[i];
                var lableIcon = "http://www.google.com/mapfiles/marker" + poiData.label + ".png";
                var latLng = new google.maps.LatLng(poiData.lat,poiData.lng)
                
                var poiMarker = new google.maps.Marker({
                    position:latLng,
                    map:gMap,
                    icon:lableIcon
                });
                
                mapBounds.extend(latLng);
            } 
        }
        gMap.fitBounds(mapBounds);
        //gMap.setCenter(mapBounds.getCenter());
        console.log('asdasd');
        //gMap = new google.maps.Map(document.getElementById("GoogleMap"),{center:mapBounds.getCenter()});
    });
})(jQuery); 