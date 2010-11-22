
CMSRightForm.prototype.getPageFromServer = function(id, treeNode) {
	var match = treeNode.id.match(/(location|category)-([\d]+)$/);
	id = parseInt(match[2]);
	//var url = SiteTreeHandlers.loadPage_url + '?ID=' + id + '&formtype='+match[1];
	this.receivingID = id;

	// Treenode might not exist if that part of the tree is closed
	if(!treeNode) treeNode = $('sitetree').getTreeNodeByIdx(treeNode.id);
	
	if(treeNode) {
		$('sitetree').loadingNode = treeNode;
		treeNode.addNodeClass('loading');
		url = treeNode.aTag.href + (treeNode.aTag.href.indexOf('?')==-1?'?':'&') + 'ajax=1';
	}
	statusMessage("loading...");	
	this.loadURLFromServer(url);
	
}


CMSRightForm.prototype.successfullyReceivedPage = function(response,pageID) {
    var loadingNode = $('sitetree').loadingNode;
    var match = loadingNode.id.match(/(location|category)-([\d]+)$/);
        
    // must wait until the javascript has finished
    document.body.style.cursor = 'wait';

    this.loadNewPage(response.responseText);
    
    var subform;
    if(subform = $('Form_MemberForm')) subform.close();
    if(subform = $('Form_SubForm')) subform.close();
    
    if(this.elements.ID) {
        this.notify('PageLoaded', this.elements.ID.value);
    }
    
    if(this.receivingID) {          
        // Treenode might not exist if that part of the tree is closed
        var treeNode = loadingNode ? loadingNode : $('sitetree').getTreeNodeByIdx(this.receivingID);
        if(treeNode) {
            $('sitetree').setCurrentByIdx(treeNode.getIdx());
            treeNode.removeNodeClass('loading');
        }
        statusMessage('');
    }
    
    // must wait until the javascript has finished
    document.body.style.cursor = 'default';
    
}
