/*
(function($) {
	$(document).ready(function() {
		var geocoder = new google.maps.Geocoder();
		var elevator = new google.maps.ElevationService();
		var marker = null;
		
		var lang = ($('input[name=Latitude]').val() != '')? parseFloat($('input[name=Latitude]').val()):0;
		var long = ($('input[name=Longitude]').val() != '')? parseFloat($('input[name=Longitude]').val()):0;
		var bMarker = true;
		if (lang == 0 || long == 0) {
			lang = 46.9547976;
			long = 7.4456344;
			bMarker = false;
		}
	    var latlng = new google.maps.LatLng(lang,long);
	    var myOptions = {
	      zoom: 16,
	      center: latlng,
	      disableDefaultUI: true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP,
	      disableDoubleClickZoom:true,
	      draggable:false,
	      keyboardShortcuts:false,
	      scrollwheel:false
	    };
	    //var map = new google.maps.Map(document.getElementById("GoogleMap"), myOptions);
	    /*
	    if (bMarker) {
	    	setMarker(latlng);
	    }
	    
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
	    }
	    
	    //lets frickel a litte
	    $('input[name^=Name]').each(function(i){
	    	if (i==0) {
	    		$(this).change(function(){
	    			var val = $(this).val();
	    			$('input[name^=Name]').each(function(j){
	    				if (j != 0) {
	    					if ($(this).val() == '')
	    						$(this).val(val);
	    				}
	    			});
	    		});
	    	}
	    });
	    $('textarea[name^=Content]').each(function(i){
	    	if (i==0) {
	    		$(this).change(function(){
	    			var val = $(this).val();
	    			$('textarea[name^=Content]').each(function(j){
	    				if (j != 0) {
	    					if ($(this).val() == '')
	    						$(this).val(val);
	    				}
	    			});
	    		});
	    	}
	    });
		
		$('input[name=action_GetCoords]').click(function(e){
			address = $('input[name=Street]').val() + ',' + $('input[name=LocationReadOnly]').val();
			if (geocoder) {
				geocoder.geocode( { 'address': address}, function(results, status) {
			        if (status == google.maps.GeocoderStatus.OK) {
			        	$('input[name=Latitude]').val(results[0].geometry.location.b);
			        	$('input[name=Longitude]').val(results[0].geometry.location.c);
			        	map.setCenter(results[0].geometry.location);
			        	setMarker(results[0].geometry.location);
			        	if (elevator) {
			        		elevator.getElevationForLocations({'locations':[results[0].geometry.location]}, function(results, status) {
			        			if (status == google.maps.ElevationStatus.OK) {
			        				// Retrieve the first result
			        				if (results[0]) {
			        					$('input[name=Elevation]').val(parseInt(results[0].elevation));
			        				}
			        			} else {
			        				alert("Elevation service failed due to: " + status);
			        			}
			        		});
			        	} else {
			        		alert("Geocode was not successful for the following reason: " + status);
			        	}
			        }
				});
			}
			return false;
		});
	});
	
})(jQuery);
*/	
