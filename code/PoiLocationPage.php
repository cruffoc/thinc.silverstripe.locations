<?php
class PoiLocationPage extends Page {
	static $db = array(
	    'Zip'  => 'Varchar(10)',
	    'City' => 'Varchar(255)',
	    'Country' => 'Varchar(255)'
	);
	
	static $has_one = array(
	   'Emblem' => 'Image'
	);
	
	static $has_many = array(
	   'Pois' => 'Poi'
	);
	
	public function getCMSFields() {
	    $fields = parent::getCMSFields();
	    $fields->addFieldsToTab(
	    	'Root.Content.Location', 
	        $this->scaffoldFormFields(array('tabbed'=>false,'restrictFields'=>array('Emblem','City','Zip','Country')))
	    );
	    $poiTable = new ComplexTableField($this, 'Pois', 'Poi');
	    $fields->addFieldsToTab(
	    	'Root.Content.Pois', 
	        $poiTable
	    );
	    return $fields;
	}
	
}

class PoiLocationPage_Controller extends Page_Controller {

    public static $url_handlers = array(
        '' => 'handleAction',
        '$poiSegment' => 'showPoi'
    );
    
    public function init() {
        parent::init();
        Requirements::css('locations/css/locations.css');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript("http://maps.google.com/maps/api/js?sensor=false");
    }
    
    public function index() {
        Requirements::javascript('locations/javascript/poiLocationPage.js');
        $jsPois = "var poiArray = new Array();\n";
        $i = 0;
        foreach ($this->getPoisWithLabel() AS $poi) {
            $jsPois .= "poiArray.push({
            			label:'".$poi->Label."',
            			title:'".$poi->Title."',
            			lat:'".$poi->Latitude."',
            			lng:'".$poi->Longitude."'
        	}); \n";
            $i++;
        }
        Requirements::customScript($jsPois);
        return $this->renderWith(array('PoiLocationPage','Page'));
    }
    
    public function getPoisWithLabel() {
        $pois = $this->obj('Pois');
        if (!$pois)return null;
        
        $i = 0;        
        foreach ($pois AS $poi) {
            $poi->Label = chr(65 + $i);
            $i++;
        } 
        return $pois;       
    }
    
    public function showPoi() {
        if ($this->urlParams['ID'])
            $this->httpError(404, "The action '$this->action' does not exist in class $this->class");
        $urlSegment = $this->urlParams['Action'];
        $poi = DataObject::get_one('Poi','URLSegment=\''.$urlSegment . '\'');
        if (!$poi)
            $this->httpError(404, "Poi with Segment \"".$urlSegment."\" doesn't exist");

        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::css('locations/css/locations.css');
        Requirements::javascript("http://maps.google.com/maps/api/js?sensor=false");
        Requirements::customScript('
(function($) {
	$(document).ready(function() {
		var latlng = new google.maps.LatLng('.$poi->Latitude.','.$poi->Longitude.');
		var myOptions = {
			zoom: 14,
			center: latlng,
			disableDefaultUI: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			disableDoubleClickZoom:true,
			draggable:true,
			keyboardShortcuts:false,
			scrollwheel:true
    	};
		var map = new google.maps.Map(document.getElementById("GoogleMap"), myOptions);
		var marker = new google.maps.Marker({
			position: latlng, 
			map: map,
			title: "'.$poi->Title.'"
		}); 
	});
})(jQuery);
		');
            
        return $this->renderWith(array('PoiPage','Page'),array('Poi'=>$poi));
    }
    
}

?>