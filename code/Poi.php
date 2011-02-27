<?php
class Poi extends DataObject {
    static $db = array(
        'Title' => 'Varchar(255)',
        'Street' => 'Varchar(255)',
        'Latitude' => 'Varchar(20)',
        'Longitude' => 'Varchar(20)',
        'Tel' => 'Varchar(40)',
    	'Mobile' => 'Varchar(40)',
        'Fax' => 'Varchar(40)',
        'Email' => 'Varchar(255)',
        'Website' => 'Varchar(255)',
        'URLSegment' => 'Varchar(255)',
        'Description' => 'Text'
    );

    static $has_one = array(
	   'Category' => 'PoiCategory',
       'Location' => 'PoiLocationPage'
    );

    public function getCMSFields() {
        $fields = $this->scaffoldFormFields(array(
       		'tabbed'=>false,
       		'restrictFields'=>array('Title','Description','Category','Tel','Mobile','Fax','Email','Website','Street'))
        );
        
        //take the location page title if no city is given
        $city = ($this->Location()->City) ? $this->Location()->City : $this->Location()->Title;
        $cityField = new ReadonlyField('LocationInfo',_t('PoiLocationPage.TITLE','PoiLocationPage.TITLE'),$this->Location()->Zip . ' ' . $city . ', ' . $this->Location()->Country );
        $fields->push($cityField);
        $fields->merge($this->scaffoldFormFields(array(
       		'tabbed'=>false,
       		'restrictFields'=>array('Latitude','Longitude'))) 
        );
        
        $fields->push(new FormAction('GetCoords',_t('Poi.GETCOORDS','Poi.GETCOORDS')));
        $fields->push(new MapField('GoogleMap','GoogleMap'));
        
        return $fields;
    }
    
    function onBeforeWrite() {
        parent::onBeforeWrite();
        $this->URLSegment = $this->generateURLSegment($this->Title);
    }
    
	/**
	 * Generate a URL segment based on the title provided.
	 * 
	 * If {@link Extension}s wish to alter URL segment generation, they can do so by defining
	 * updateURLSegment(&$url, $title).  $url will be passed by reference and should be modified.
	 * $title will contain the title that was originally used as the source of this generated URL.
	 * This lets decorators either start from scratch, or incrementally modify the generated URL.
	 * 
	 * @param string $title Page title.
	 * @return string Generated url segment
	 */
	function generateURLSegment($title){
		$t = (function_exists('mb_strtolower')) ? mb_strtolower($title) : strtolower($title);
		$t = Object::create('Transliterator')->toASCII($t);
		$t = str_replace('&amp;','-and-',$t);
		$t = str_replace('&','-and-',$t);
		$t = ereg_replace('[^A-Za-z0-9]+','-',$t);
		$t = ereg_replace('-+','-',$t);
		if(!$t || $t == '-' || $t == '-1') {
			$t = "poi-$this->ID";
		}
		$t = trim($t, '-');
		return $t;
	}
}