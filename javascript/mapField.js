
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
        initMap();
        
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
                        initMap();
                    }
                });
                
            }
        }
        
        //triggers
        $('input[name=action_GetCoords]').livequery('click',
                function(e) {
                    // get the data needed to ask coords
                    var col = $('#Form_EditForm_Location').find('input:checked').parent().next('td');
                    var location = col.html() + ' ' + col.next('td').html() + ', ' + col.next('td').next('td').html();
                    var address = $('#Form_EditForm_Street').val() + ', ' + location
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
        
        // problems initializing google maps in hidden field, so init when tab poi adress is opened
        $('#tab-Root_Content_set_PoiAdress').livequery('click',
                function(e) {
                    initMap();
                    return false;
                 }
        );        
        
        
        
    });
})(jQuery);	
