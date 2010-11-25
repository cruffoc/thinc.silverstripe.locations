<h1>
$Title
</h1>
<% if Image %>
<img class="right" src="$Image.Link" alt="$Title" />
<% end_if %>
$Content


<h3><% _t('Poi.LOCATION_CONTACT','Poi.LOCATION_CONTACT') %></h3>
<div id="GoogleMap" style="width:100%;height:300px;"></div>
<div class="adress">
     <% if Street %>$Street<br /><% end_if %>
     <% if Tel %>$Tel<br /><% end_if %>
     <% if Mobile %>$Mobile<br /><% end_if %>
     <% if Fax %>$Fax<br /><% end_if %>

    <% if Website %><a href="$PointOfInterest.Website">$Website</a><br /><% end_if %>
    <% if Email %><a href="mailto:$PointOfInterest.Email">$Email</a><% end_if %>
</div>