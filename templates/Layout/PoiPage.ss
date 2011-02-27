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
<h3><% _t('CONTACT_LOCATION','CONTACT_LOCATION') %></h3>
    <div id="GoogleMap" style="width:300px;height:300px;"></div>
    <div class="adress">
         <% if Street %><span class="label"><% _t('ADDRESS','ADDRESS') %></span>$Street<br /><% end_if %>
         <% if Location %><span class="label">&nbsp;</span>$Location.Zip <% if Location.City %>$Location.City<% else %>$Location.Title<% end_if %><br /><% end_if %>
         <% if Tel %><span class="label"><% _t('PHONE','PHONE') %></span>$Tel<br /><% end_if %>
         <% if Mobile %><span class="label"><% _t('MOBILE','MOBILE') %></span>$Mobile<br /><% end_if %>
         <% if Fax %><span class="label"><% _t('FAX','FAX') %></span>$Fax<br /><% end_if %>
    
        <% if Website %><span class="label"><% _t('WEBSITE','WEBSITE') %></span><a href="http://$Website" target="_blank">$Website</a><br /><% end_if %>
        <% if Email %><span class="label"><% _t('EMAIL','EMAIL') %></span><a href="mailto:$Email">$Email</a><% end_if %>
    </div>
</div>
<% end_control %>