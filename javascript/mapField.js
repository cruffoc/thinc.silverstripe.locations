
(function($) {
    $(document).ready(function() {
        
        var map = null;
        var marker = null;
        var geocoder = new google.maps.Geocoder();
        var elevator = new google.maps.ElevationService();

        var myOptions = {
            zoom: 16,
            disableDefaultUI: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDoubleClickZoom:true,
            draggable:true,
            keyboardShortcuts:false,
            scrollwheel:true
        };
        
        function setMarker(location){
            if (marker != null) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                  position: location,
                  title:"Position"
                });
                marker.setMap(map);
            }
            map.setCenter(location) 
        }
        
        function setCoordByAddress (address) {
            
            if (geocoder) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $('input[name=Latitude]').val(results[0].geometry.location.lat());
                        $('input[name=Longitude]').val(results[0].geometry.location.lng());
                        setMarker(results[0].geometry.location);
                    }
                });
                
            }
        }
        
        //triggers
        $('input[name=action_GetCoords]').livequery('click',
                function(e) {
                    // get the data needed to ask coords
                    var location = $('input[name=LocationInfo]').val();
                    var address = $('input[name=Street]').val() + ', ' + location;
                    setCoordByAddress(address);
                    return false;
                 }
        );
        
        function initMap () {
            myOptions.center = new google.maps.LatLng($('input[name=Latitude]').val(),$('input[name=Longitude]').val());
            map = new google.maps.Map(document.getElementById("GoogleMap"), myOptions);
            
            if ($('input[name=Latitude]').val() && $('input[name=Longitude]').val()) {
                marker = null;
                setMarker(myOptions.center);
            }            
        }       
        
        initMap();
        
    });
})(jQuery);	
