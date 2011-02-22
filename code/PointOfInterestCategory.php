<?php
class PointOfInterestCategory extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)'
	);
	
	static $has_one = array(
	    'Icon' => 'Image',
	);
	
	
	static $has_many = array(
		'PointOfInterest' => 'PointOfInterestPage'
	);
	
	static $default_sort = 'Name ASC';
 	
   	public function getCMSFields(){
   		$fields = parent::getCMSFields(array('includeRelations'=>false));   		
   		return $fields;
   	}
   	
}

?>