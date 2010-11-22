<?php
class PointOfInterestPage extends Page {
    static $db = array(
        'Street' => 'Varchar(255)',
        'Latitude' => 'Varchar(10)',
        'Longitude' => 'Varchar(10)',
        'Elevation' => 'Int',
        'Tel' => 'Varchar(40)',
    	'Mobile' => 'Varchar(40)',
        'Fax' => 'Varchar(40)',
        'Email' => 'Varchar(255)',
        'Website' => 'Varchar(255)',
	    'ImageDescription' => 'Varchar(255)',
    );

    static $has_one = array(
	   'Category' => 'PointOfInterestCategory',
       'Image'  => 'Image'
    );
    
    static $defaults = array(
        "ProvideComments" => false,
        'ShowInMenus' => false
    );
    
    
    
    private function getLocales() {
        return Translatable::get_allowed_locales();
    }
    
    private function getContentFieldSet($contentObj=null) {
    	if (!$contentObj)
            $contentObj = new PointOfInterestContent();
        
        $fieldSet = $contentObj->getCMSFields(array('tabbed'=>false));
        //populate Content with values from DataObject
        foreach($fieldSet AS $f) {
            $name= $f->Name();
            $f->setValue($contentObj->$name);
        }
        return $fieldSet;
    }
    
    private function appendContentFields($fieldSet) {
        foreach ($this->getLocales() AS $locale) {
            $obj = DataObject::get_one('PointOfInterestContent','PointOfInterestID = '.$this->ID . ' AND "PointOfInterestContent"."Locale" = \''.$locale.'\'');
            	
            if ($obj) {
                $contentFields = $this->getContentFieldSet($obj);
            } else {
            	$contentFields = $this->getContentFieldSet();
            }
            foreach ($contentFields AS $field) {
                $field->setName($field->Name() . '_' . $locale);
                
            }
            $fieldSet->addFieldsToTab('Root.Content ('.substr($locale,0,2).')',$contentFields);
        }
        return $fieldSet;
    }
    
    public function getCMSFields() {
    	$fields = parent::getCMSFields();

    	$categories = DataObject::get('PointOfInterestCategory');
    	$cat_source = array(0=>'--');
    	foreach ($categories AS $cat) {
    		$cat_source[$cat->ID] = $cat->Name();
    	}    
    	$select_category = new DropdownField('CategoryID','Category',$cat_source);
    	$select_category->setValue($this->CategoryID);	
    	$fields->addFieldToTab('Root.Content.Poi', $select_category);
    	$restriced = array_keys(PointOfInterestPage::$db);
    	$restriced[] = 'Image';
		$fields->addFieldsToTab('Root.Content.Poi', $this->scaffoldFormFields(array('tabbed'=>false,'restrictFields'=>$restriced)));

        $fields->addFieldToTab('Root.Content.Poi',$location = new ReadonlyField('LocationReadOnly','LocationReadOnly'),'Street');
        //$location->setValue($this->Parent->Zip . ' '. $this->Parent->Title . ', ' . $this->Parent->Country);
        //$fields->addFieldToTab('Root.Content.Poi',new FormAction('GetCoords',_t('Location.GETCOORDS','Location.GETCOORDS')),'Latitude');
        //$fields->addFieldToTab('Root.Content.Poi',new MapField('GoogleMap','GoogleMap'),'Latitude');
        
       
    	
    	
    	
        return $fields;
    }
/*	
   public function onAfterWrite() {
   	    parent::onAfterWrite();
   	}
*/ 
}
class PointOfInterestPage_Controller extends Page_Controller {
	
	public function init(){
		parent::init();
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::css('locations/css/locations.css');
		Requirements::javascript("http://maps.google.com/maps/api/js?sensor=false");
		Requirements::customScript('
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
		');
	}
	
}

