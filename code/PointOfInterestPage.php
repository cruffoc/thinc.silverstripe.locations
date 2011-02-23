<?php
class PointOfInterestPage extends Page {
    static $db = array(
        'Street' => 'Varchar(255)',
        'Latitude' => 'Varchar(20)',
        'Longitude' => 'Varchar(20)',
        'Tel' => 'Varchar(40)',
    	'Mobile' => 'Varchar(40)',
        'Fax' => 'Varchar(40)',
        'Email' => 'Varchar(255)',
        'Website' => 'Varchar(255)',
    );

    static $has_one = array(
	   'Category' => 'PointOfInterestCategory',
       'Location' => 'PointOfInterestLocation'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->addFieldsToTab('Root.Content.PoiInformation',$this->scaffoldFormFields(array(
       		'tabbed'=>false,
       		'restrictFields'=>array('Tel','Mobile','Fax','Email','Website'))) 
        );
        $tableField = new HasOneComplexTableField($this, 'Location',PointOfInterestPage::$has_one['Location'] ,array('Zip'=>_t('Location.ZIP','Location.ZIP'),'Title'=>_t('Location.TITLE','Location.TITLE'),'Country'=>_t('Location.COUNTRY','Location.COUNTRY')));
        $tableField->setOneToOne();      
        $fields->addFieldToTab('Root.Content.PoiLocation', $tableField); 
        
        $fields->addFieldsToTab('Root.Content.PoiAdress',$this->scaffoldFormFields(array(
       		'tabbed'=>false,
       		'restrictFields'=>array('Street','Latitude','Longitude'))) 
        );
        
        $fields->addFieldToTab('Root.Content.PoiAdress',new FormAction('GetCoords',_t('Location.GETCOORDS','Location.GETCOORDS')));
        $fields->addFieldToTab('Root.Content.PoiAdress',new MapField('GoogleMap','GoogleMap'));
        return $fields;
    }
}

class PointOfInterestPage_Controller extends Page_Controller {

    public function init(){
        parent::init();
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::css('locations/css/locations.css');
        Requirements::javascript("http://maps.google.com/maps/api/js?sensor=false");
        Requirements::customScript('
(function($) {
	$(document).ready(function() {
		var latlng = new google.maps.LatLng('.$this->Latitude.','.$this->Longitude.');
		var myOptions = {
			zoom: 16,
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
			title: "'.$this->Title.'"
		}); 
	});
})(jQuery);
		');
    }

}

