<?php
class PointOfInterestCategory extends DataObject {
	static $db = array();
	
	static $has_one = array(
	    //'Icon' => 'Image',
	);
	
	
	static $has_many = array(
		'PointOfInterest' => 'PointOfInterestPage'
	);
	
    private function getLocales() {
        return Translatable::get_allowed_locales();
    }
    
    private function getContentFieldSet($contentObj=null) {
    	if (!$contentObj)
            $contentObj = new PointOfInterestCategoryContent();
        
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
            $obj = DataObject::get_one('PointOfInterestCategoryContent','PointOfInterestCategoryID = '.$this->ID . ' AND "PointOfInterestCategoryContent"."Locale" = \''.$locale.'\'');
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
    
    public function Name() {
        $obj = DataObject::get_one('PointOfInterestCategoryContent','PointOfInterestCategoryID='.$this->ID);
        if (!$obj)return 'no name';
        return $obj->Name;
    }
/*   
   public function onAfterWrite() {
   	    parent::onAfterWrite();

   	    $fieldNames = array_keys(PointOfInterestCategoryContent::$db);
        $contentObject = DataObject::get_one('PointOfInterestCategoryContent','PointOfInterestCategoryID = ' . $this->ID);
        if (!$contentObject) {
            $contentObject = new PointOfInterestCategoryContent();
            $contentObject->PointOfInterestCategoryID = $this->ID;
            $contentObject->write();
        }
        

        foreach ($this->getLocales() AS $locale) {
        	$obj = $contentObject->createTranslation($locale);
            $field_values = array();
            foreach ($fieldNames AS $name) {
                	if (isset($_REQUEST[$name.'_'.$locale]))
                	    $field_values[$name] = $_REQUEST[$name.'_'.$locale];
            }
              
            $obj->castedUpdate($field_values);
            $obj->PointOfInterestCategoryID = $this->ID;
            $obj->write();
        }
   	}
*/   	
 	
   	public function getCMSFields(){
   		$fields = parent::getCMSFields(array('includeRelations'=>false));
   		/*
    	$fields->addFieldToTab('Root.PointOfInterests',$complexTable = new ComplexTableField(
	    	$this,
	    	'PointOfInterest',
	    	'PointOfInterestPage',
	    	array('Title'=>'Title','CategoryName'=>'Category')
    	));
    	$complexTable->requirementsForPopupCallback = 'requirementsForPopup';
    	*/
   		$this->appendContentFields($fields);
   		
   		return $fields;
   	}
   	
}

?>