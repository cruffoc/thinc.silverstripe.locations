<?php
class PointOfInterestCategoryContent extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)',
	);
	
	static $has_one = array(
	    'PointOfInterestCategory' => 'PointOfInterestCategory'
	);
	
    static $extensions = array(
        'Translatable'
    );	
    
   	static $default_sort = 'Name ASC'; 
	
	
    public function getCMSFields($params = null) {
    	$keys = array_keys(PointOfInterestCategoryContent::$db);
    	$params['restrictFields'] = $keys;
    	return parent::getCMSFields($params);
    }
}

?>