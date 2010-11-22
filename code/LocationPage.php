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
}

class LocationPage_Controller extends Page_Controller {
	function init() {
		parent::init();
		Requirements::css('locations/css/locations.css');
	}
	
	public function getCategories() {

		
		$cats = DataObject::get(
			'PointOfInterestCategoryContent',
			'"SiteTree"."ParentID" = '.$this->ID,
			'"SiteTree"."Title" ASC',
			'
			INNER JOIN PointOfInterestCategory ON "PointOfInterestCategoryContent"."PointOfInterestCategoryID" = "PointOfInterestCategory"."ID"
			INNER JOIN PointOfInterestPage ON "PointOfInterestCategory"."ID" = "PointOfInterestPage"."CategoryID"
			INNER JOIN SiteTree ON "SiteTree"."ID" = "PointOfInterestPage"."ID"
			'
		);
		
		
		foreach ($cats AS $cat) {
			$cat->Pois = DataObject::get(
				'PointOfInterestPage',
				'ParentID='.$this->ID.' AND CategoryID='.$cat->PointOfInterestCategoryID,
				'"SiteTree"."Title" ASC'
			);
		}
		return $cats;
		
	}
	
}

?>