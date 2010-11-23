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
    
    public function deletecategory($param) {
		$location = DataObject::get_by_id('PointOfInterestCategory', $param['ID']);
		$location->delete();
    	FormResponse::add('var node = $(\'sitetree\').getTreeNodeByIdx("category-'.$param['ID'].'");');
    	FormResponse::add('if(node && node.parentTreeNode) node.parentTreeNode.removeTreeNode(node);');
    	FormResponse::add('$(\'Form_EditForm\').innerHTML = "'._t('Locations.DELTETED','Deleted').'";');
    	
    	return FormResponse::respond();
    }

    public function getEditForm($id) {
    	
    	$this->setCurrentPageID($id);
    	return $this->getCategoryForm($id);
    }
    
	public function EditForm($request=null) {
		// Include JavaScript to ensure HtmlEditorField works
		HtmlEditorField::include_js();
		if ($request) {
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
    
    public function savecategory($params, $form) {
		$id = $_REQUEST['ID'];
		$record = DataObject::get_by_id('PointOfInterestCategory', $id);
		$form->saveInto($record);
		$record->write();
		FormResponse::add('$(\'Form_EditForm\').getPageFromServer('.$record->ID.');');
		FormResponse::add('$(\'sitetree\').setNodeTitle("category-'.$record->ID.'","'.$record->Name().'");');
		FormResponse::add('$(\'Form_EditForm\').updateStatus(\'Saved (update)\');');
		FormResponse::status_message(_t('Category.SAVED','Saved'), 'good');
		$result = $this->getActionUpdateJS($record);
		return FormResponse::respond();
    }
    
    public function showcategory($request) {
    	$params = $request->allParams();
    	Session::set("{$this->class}.currentEditType", "category");
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