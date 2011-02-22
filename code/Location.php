<?php
class Location extends DataObject {
	static $db = array(
	    'Title' => 'Varchar(255)',
	    'Zip'  => 'Varchar(10)',
	    'Country' => 'Varchar(255)',
	);
	
	static $has_one = array(
	   'Emblem' => 'Image'
	);
    
	
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