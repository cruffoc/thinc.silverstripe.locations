<h1>
$Title
</h1>
<div class="location-info">
    <% if Emblem %><img src="$Emblem.Link" alt="" class="emblem left" /><% end_if %>
    $Zip $City<br />
    $Country
</div>
<% if Pois %>
<div class="poi-info">  
    <% control Pois %>
    <div class="poi-thumb">
        <% if Title %><h3><a href="{$Top.Link}{$URLSegment}">$Title</a></h3><% end_if %>
        <% if Street %>$Street<br /><% end_if %>
        <% if Location.City %>$Location.Zip $Location.City<br /><% end_if %>
        <% if Tel %>$Tel<br /><% end_if %>
        <% if Mobile %>$Mobile<br /><% end_if %>
        <% if Fax %>$Fax<br /><% end_if %>
        <% if Fax %>$Email<br /><% end_if %>
    </div>
    <% end_control %>
</div>
<% end_if %>