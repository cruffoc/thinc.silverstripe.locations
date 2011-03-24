<div class="typography">
    <% if Menu(2) %>
        <% include SideBar %>
        <div id="Content">
    <% end_if %>

    <% if Level(2) %>
        <% include BreadCrumbs %>
    <% end_if %>
<h1>
$Title
</h1>
<div class="location-info">
    <% if Emblem %><img src="$Emblem.Link" alt="" class="emblem left" /><% end_if %>
    $Zip $City<br />
    $Country
</div>
<div class="inner container">
<div class="grid_2-3">
<div class="box">
<div id="GoogleMap" class="location-map"></div>
</div>
</div>
<div class="grid_1-3">
<div class="box">
<% if PoisWithLabel %>
<div class="poi-info">  
    <% control PoisWithLabel %>
    <div class="poi-thumb">
    <img src="http://www.google.com/mapfiles/marker{$Label}.png" class="poi-label" alt="Label"/>
        <div class="location-poi-info">
        <% if Title %><h3><a href="{$Top.Link}{$URLSegment}">$Title</a></h3><% end_if %>
        <% if Street %>$Street<br /><% end_if %>
        <% if Location.City %>$Location.Zip $Location.City<br /><% end_if %>
        <% if Tel %><% _t('PoiPage.ss.Telefono','Telefono') %> $Tel<br /><% end_if %>
        <% if Mobile %><% _t('PoiPage.ss.Celular','Celular') %> $Mobile<br /><% end_if %>
        <% if Fax %><% _t('PoiPage.ss.Fax','Fax') %> $Fax<br /><% end_if %>
        <% if Website %><a href="http://$Website" target="_blank">$Website</a><br /><% end_if %>
        <% if Email %><a href="mailto:$Email">$Email</a><br /><% end_if %>
        
        </div>
    </div>
    <% if Even %>
        <div style="clear:both"></div>
    <% end_if %>
    <% end_control %>

</div>
</div>
</div>
</div>
<% end_if %>
    <% if Menu(2) %>
        </div>
    <% end_if %>
</div>


