

<div class="typography">
    <% if Menu(2) %>
        <% include SideBar %>
        <div id="Content">
    <% end_if %>

    <% if Level(2) %>
        <% include BreadCrumbs %>
    <% end_if %>
    
<% control Poi %>
<h1>
$Title
</h1>
<% if Image %>
<img class="right" src="$Image.Link" alt="$Title" />
<% end_if %>
<% if Description %>
    <p>$Description</p>
<% end_if %>
<div class="contact">
<!-- <h3><% _t('CONTACT_LOCATION','CONTACT_LOCATION') %></h3> -->
    <div id="GoogleMap" class="poi-map"></div>
    <div class="poi-address">
         <% if Street %><span class="label"><% _t('ADDRESS','Direccion') %></span>$Street<br /><% end_if %>
         <% if Location %><span class="label">&nbsp;</span>$Location.Zip <% if Location.City %>$Location.City<% else %>$Location.Title<% end_if %><br /><% end_if %>
         <% if Tel %><span class="label"><% _t('PHONE','Telefono') %></span>$Tel<br /><% end_if %>
         <% if Mobile %><span class="label"><% _t('MOBILE','Celular') %></span>$Mobile<br /><% end_if %>
         <% if Fax %><span class="label"><% _t('FAX','Fax') %></span>$Fax<br /><% end_if %>
    
        <% if Website %><span class="label"><% _t('WEBSITE','Sitio') %></span><a href="http://$Website" target="_blank">$Website</a><br /><% end_if %>
        <% if Email %><span class="label"><% _t('EMAIL','Email') %></span><a href="mailto:$Email">$Email</a><% end_if %>
    </div>
</div>
<% end_control %>
    <% if Menu(2) %>
        </div>
    <% end_if %>
</div>