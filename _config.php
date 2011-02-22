<?php
define('LOCATIONS_DIR','locations');
//Requirements::javascript('sapphire/thirdparty/jquery/jquery.js');
LeftAndMain::require_javascript('sapphire/thirdparty/jquery-livequery/jquery.livequery.js');
LeftAndMain::require_javascript("http://maps.google.com/maps/api/js?sensor=false");
LeftAndMain::require_javascript('locations/javascript/mapField.js');
?>