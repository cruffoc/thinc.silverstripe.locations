<?php
class LocationAdmin extends LeftAndMain {

	static $url_segment = 'locations';
	
    static $url_rule = '/$Action/$ID/$OtherID';
    
    static $menu_title = 'Locations';
    
    static $tree_class = 'Location';
    
    private $locationForm = false;
    
    public function init() {
        parent::init();
        Requirements::javascript(LOCATIONS_DIR.'/javascript/LocationAdmin_left.js');
        Requirements::javascript(LOCATIONS_DIR.'/javascript/LocationAdmin_right.js');
    }
    
    public function add() {
    	/*
    	if ($_POST['PageType'] == 'location')
    		return $this->addLocation();
    	else
    	*/
    		return $this->addCategory();
    }

    public function addCategory() {
        $category = new PointOfInterestCategory();
    	$category->write();
    	$content = DataObject::get_one('PointOfInterestCategoryContent','PointOfInterestCategoryID='.$category->ID);
    	$content->Name = $category->Name = _t('Poi.NEWCategory',"New Category");
    	$content->write();
        $response = <<<JS
            var tree = $('sitetree');
            var newNode = tree.createTreeNode("category-$category->ID","$content->Name","Group","admin/locations/showcategory/$category->ID");
            var node = tree.getTreeNodeByIdx("categories");
            node.open();
            node.appendTreeNode(newNode);
            newNode.selectTreeNode();
JS;
        FormResponse::add($response);   
        return FormResponse::respond(); 
    }
    
    public function addLocation() {
        $location = new Location();
        $location->Name = _t('Location.NEWLOCATION',"New Location");
    	$location->write();
        $response = <<<JS
            var tree = $('sitetree');
            var newNode = tree.createTreeNode("location-$location->ID","$location->Name","Group","admin/locations/showlocation/$location->ID");
            var node = tree.getTreeNodeByIdx("locations");
            node.open();
            node.appendTreeNode(newNode);
            newNode.selectTreeNode();
JS;
        FormResponse::add($response);   
        return FormResponse::respond(); 
    }
    
    
    
    public function deletecategory($param) {
		$location = DataObject::get_by_id('PointOfInterestCategory', $param['ID']);
		$location->delete();
    	FormResponse::add('var node = $(\'sitetree\').getTreeNodeByIdx("category-'.$param['ID'].'");');
    	FormResponse::add('if(node && node.parentTreeNode) node.parentTreeNode.removeTreeNode(node);');
    	FormResponse::add('$(\'Form_EditForm\').innerHTML = "'._t('Locations.DELTETED','Deleted').'";');
    	
    	return FormResponse::respond();
    }
    public function deletelocation($param) {
		$location = DataObject::get_by_id('Location', $param['ID']);
		$location->delete();
    	FormResponse::add('var node = $(\'sitetree\').getTreeNodeByIdx("location-'.$param['ID'].'");');
    	FormResponse::add('if(node && node.parentTreeNode) node.parentTreeNode.removeTreeNode(node);');
    	FormResponse::add('$(\'Form_EditForm\').innerHTML = "'._t('Locations.DELTETED','Deleted').'";');
    	
    	return FormResponse::respond();
    }

    public function getEditForm($id) {
    	
    	$this->setCurrentPageID($id);
    	/*
    	if (Session::get("{$this->class}.currentEditType") == 'location')
    		return $this->getLocationForm($id);
    	else
    	*/
    		return $this->getCategoryForm($id);
    }
    
	public function EditForm($request=null) {
		// Include JavaScript to ensure HtmlEditorField works
		HtmlEditorField::include_js();
		if ($request) {
		/*
			
			//to get the iframe image thing to work... probably i get the Frickler Award for this http://www.frickler.ch
			$parts = explode('/', $request->getVar('url'));
			if ($this->currentPageID() != 0) {
				$record = $this->currentPage();
				if(!$record) return false;
				if($record && !$record->canView()) return Security::permissionFailure($this);
			}
			if ((sizeof($parts) > 4 && ($parts[5] == 'Emblem' || $parts[5] == 'PointOfInterest')) || isset($_POST['action_savelocation']) || isset($_POST['action_deletelocation']))
				$this->locationForm = true;
				*/
			return $this->getEditForm($this->currentPageID());
		} else {
			return false;
		}


		return false;
	}
    
    public function getCategoryForm($id) {
		$record = DataObject::get_by_id('PointOfInterestCategory', $id);
    	$fields = $record->getCMSFields();
    	$fields->push(new HiddenField('ID',$id));
        $actions = new FieldSet(
                //new FormAction('addmember',_t('SecurityAdmin.ADDMEMBER','Add Member')),
                new FormAction('deletecategory',_t('Locations.DELETE','Delete')),
                new FormAction('savecategory',_t('Locations.SAVE','Save'))
        );
        $form = new Form($this, "EditForm", $fields, $actions);
        $form->setHTMLID('Form_EditForm');
        $form->loadDataFrom($record);
		return $form;
    }
	
    
    public function getLocationForm($id) {
		$record = DataObject::get_by_id('Location', $id);
    	$fields = $record->getCMSFields($this);
    	$fields->push(new HiddenField('ID',$id));
        $actions = new FieldSet(
                //new FormAction('addmember',_t('SecurityAdmin.ADDMEMBER','Add Member')),
                new FormAction('deletelocation',_t('Locations.DELETE','Delete')),
                new FormAction('savelocation',_t('Locations.SAVE','Save'))
        );
        $form = new Form($this, "EditForm", $fields, $actions);
        $form->setHTMLID('Form_EditForm');
        $form->loadDataFrom($record);
        return $form;
    } 
    
    public function savecategory($params, $form) {
		$id = $_REQUEST['ID'];
		$record = DataObject::get_by_id('PointOfInterestCategory', $id);
		$form->saveInto($record);
		$record->write();
		FormResponse::add('$(\'sitetree\').setNodeTitle("category-'.$record->ID.'","'.$record->Name().'");');
		FormResponse::status_message(_t('Locations.SAVED','Saved'), 'good');
		$result = $this->getActionUpdateJS($record);
		return FormResponse::respond();
    }
       
    public function savelocation($params, $form) {
		$id = $_REQUEST['ID'];
		$record = DataObject::get_by_id('Location', $id);
		$form->saveInto($record);
		$record->write();
		FormResponse::add('$(\'sitetree\').setNodeTitle("location-'.$record->ID.'","'.$record->Name.'");');
		FormResponse::status_message(_t('Locations.SAVED','Saved'), 'good');
		$result = $this->getActionUpdateJS($record);
		return FormResponse::respond();
    }
    
    public function showcategory($request) {
    	$params = $request->allParams();
    	Session::set("{$this->class}.currentEditType", "category");
		return $this->getEditForm($params['ID'])->formHtmlContent();
    }
    
    public function showlocation($request) {
    	$params = $request->allParams();
    	Session::set("{$this->class}.currentEditType", "location");
		return $this->getEditForm($params['ID'])->formHtmlContent();
    }
    
    
    public function loadTree($request){
    	$tree = '';
    	if ($request->getVar('ID') == 'categories') {
    		$items = DataObject::get('PointOfInterestCategory','','');
    		$id = 'category';
    	   	foreach($items AS $loc) {
    			$tree .= '<li id="'.$id.'-'.$loc->ID.'"><a href="admin/locations/show'.$id.'/'.$loc->ID.'" title="'.$loc->Name().'">'.$loc->Name().'</a></li>';
    		}
    	} else {
    		$items = DataObject::get('Location','','Name');
    		$id = 'location';
    	    foreach($items AS $loc) {
    			$tree .= '<li id="'.$id.'-'.$loc->ID.'"><a href="admin/locations/show'.$id.'/'.$loc->ID.'" title="'.$loc->Name.'">'.$loc->Name.'</a></li>';
    		}
    	}
    	

    	return $tree;
    }    
}