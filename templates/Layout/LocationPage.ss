<h1>
$Title
</h1>
<% if Emblem %>
<img src="$Emblem.Link" alt="" class="emblem left" />
<% end_if %>
$Zip
$Country
<div class="info-poi">
<% if Categories %>
    <% control Categories %>
	    <div class="poi-category">
	        <img class="category-icon" src="$Icon.Link" alt="$Name" title="$Name"/>
	    </div>
	    <table class="poi-table">
	        <tbody>
	        <% control Pois %>
	            <tr>
	                <td class="column-name"><% if Title %><a href="$Link">$Title</a> <br /><% end_if %>
	                    <% if Street %>$Street<br /><% end_if %>
	                    <% if Tel %>$Tel<br /><% end_if %>
	                    <% if Mobile %>$Mobile<br /><% end_if %>
	                    <% if Fax %>$Fax<br /><% end_if %>
	                </td>
	                <td class="column-email">
	                    <% if Website %><a href="$PointOfInterest.Website">$Website</a><br /><% end_if %>
	                    <% if Email %><a href="mailto:$PointOfInterest.Email">$Email</a><% end_if %>
	                </td>
	            </tr>
	        <% end_control %>
	        </tbody>       
	   </table>
    <% end_control %>
<% end_if %>
</div>