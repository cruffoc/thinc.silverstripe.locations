<h2><% _t('Locations.LOCATIONSINFORMATION','Locations') %></h2>

<div id="treepanes" style="overflow-y: auto;">
    <ul id="TreeActions">

    </ul>

    <div style="clear:both;"></div>
    
    <form class="actionparams" id="addObject" style="" action="admin/locations/add">
            <!-- - 

            <select name="PageType" id="objectType">
                <option value="location"><% _t('Locations.LOCATION','Location') %></option>
                <option value="category"><% _t('Poi.CATEGORY','Add new draft') %></option>
            </select>
        -->
        <button><% _t('CREATE','Create') %></button>
    </form>   
    
       
    <form class="actionparams" id="deletelocation_options" style="display: none" action="admin/locations/deletelocations">
        <p><% _t('SELECT','Select the pages that you want to delete and then click the button below') %></p>
        
        <input type="hidden" name="csvIDs" />
        <input type="submit" value="<% _t('DELGROUPS','Delete the selected groups') %>" class="action delete" />
    </form>
    
<ul id="sitetree" class="tree unformatted">
    <li id="record-root" class="Root">
        <a><% _t('Locations.LOCATIONS','Locations') %></a>
        <ul>
  
            <li id="categories" class="Folder unexpanded">
                <a href="javascript:void(0)"><% _t('Poi.CATEGORIES','CATEGORIES') %></a>
            </li>   
        </ul>
    </li>
</ul>
   
</div>
