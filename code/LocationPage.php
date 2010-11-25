<?php
class LocationPage extends Page {
	static $db = array(
	    'Zip'  => 'Varchar(10)',
	    'Country' => 'Varchar(255)',
	);
	
	static $has_one = array(
	   'Emblem' => 'Image'
	);
	
    static $defaults = array(
        "ProvideComments" => false,
        'ShowInMenus' => false
    );
    
    function getCMSFields() {
    	$fields = parent::getCMSFields();
    	$fields->addFieldToTab('Root.Content.Main', new TextField('Zip','Plz'),'Content');
    	$fields->addFieldToTab('Root.Content.Main', new TextField('Country','Land'),'Content');
    	$fields->addFieldToTab('Root.Content.Main', new ImageField('Emblem','Wappen'),'Content');
    	return $fields;
    }
}

class LocationPage_Controller extends Page_Controller {
	function init() {
		parent::init();
		Requirements::css('locations/css/locations.css');
	}
	
	public function getCategories() {
		$cats = DataObject::get(
			'PointOfInterestCategory',
			'"SiteTree"."ParentID" = '.$this->ID,
			'"SiteTree"."Title" ASC',
			'
			INNER JOIN PointOfInterestPage ON "PointOfInterestCategory"."ID" = "PointOfInterestPage"."CategoryID"
			INNER JOIN SiteTree ON "SiteTree"."ID" = "PointOfInterestPage"."ID"
			'
		);
		
		
		foreach ($cats AS $cat) {
			$cat->Pois = DataObject::get(
				'PointOfInterestPage',
				'ParentID='.$this->ID.' AND CategoryID='.$cat->ID,
				'"SiteTree"."Title" ASC'
			);
		}
		return $cats;
		
	}
	
}

?>