if(typeof SiteTreeHandlers == 'undefined') SiteTreeHandlers = {};
SiteTreeHandlers.loadPage_url = null;
SiteTreeHandlers.showRecord_url = 'admin/locations/show/';
SiteTreeHandlers.loadTree_url = 'admin/locations/loadTree';

SiteTree.prototype = {
		castAsTreeNode: function(li) {
			behaveAs(li, SiteTreeNode, this.options);
		},
		
		getIdxOf : function(treeNode) {
			if(treeNode && treeNode.id)
				return treeNode.id;
		},
		
		getTreeNodeByIdx : function(idx) {
			if(!idx) idx = "0";
			return document.getElementById(idx);
		},
		
		initialise: function() {
			this.observeMethod('SelectionChanged', this.changeCurrentTo);	
		},
		
		createTreeNode : function(idx, title, pageType, link) {
			var i;
			var node = document.createElement('li');
			node.id = idx;
			node.className = pageType;
			var aTag = document.createElement('a');
			aTag.href = link;
			aTag.innerHTML = title;
			node.appendChild(aTag);

			SiteTreeNode.create(node, this.options);
			
			return node;
		},

	}

var addObject = {		
	form_submit : function() {
		var st = $('sitetree');
		Ajax.SubmitForm(this, null, {
			onSuccess : Ajax.Evaluator,
			onFailure : function(response) {
				errorMessage('Error adding page', response);
			}
		});
		
		return false;
	}
}

SiteTreeNode.prototype.getPageFromServer = function() {
	
    var match = this.id.match(/(location|category)-([\d]+)$/);
    if (match) 
    	$('Form_EditForm').getPageFromServer(match[2],this);
	
		
}

Behaviour.addLoader(function () {
	if($('addObject')) {
		$('addObject').onsubmit = addObject.form_submit;
	}
});
