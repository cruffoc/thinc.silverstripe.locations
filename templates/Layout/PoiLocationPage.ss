<h1>
$Title
</h1>
<div class="info-location clearfix">
<% if Emblem %>
<img src="$Emblem.Link" alt="" class="emblem left" />
<% end_if %>
$Zip
$Country
</div>

<div class="info-poi">
<h2><% _t('LocationInformation','LocationInformation') %></h2>
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
                    <% if Website %><a  href="http://$Website" target="_blank">$Website</a><br /><% end_if %>
                    <% if Email %><a href="mailto:$Email">$Email</a><% end_if %>

                    <% if InfoBooklet %>
                        <div ><% _t('Poi.INFOS_BOOKLETS','Poi.INFOS_BOOKLETS') %></div>
                    <% end_if %>
                    <% if PilgrimStamp %>
                        <div ><% _t('Poi.PILGRIM_STAMP_AVAILABLE','Poi.PILGRIM_STAMP_AVAILABLE') %></div>
                    <% end_if %>
                    <% if DogsAllowed %>
                        <div ><% _t('Poi.DOGS_ALLOWED','Poi.DOGS_ALLOWED') %></div>
                    <% end_if %>
                    <% if PilgrimPassMandatory %>
                        <div ><% _t('Poi.PILGRIM_PASS_MANDATORY','Poi.PILGRIM_PASS_MANDATORY') %></div>
                    <% end_if %>
                    <% if HandicappedAccessible %>
                        <div ><% _t('Poi.HANDICAPPED_ACCESIBLE','Poi.HANDICAPPED_ACCESIBLE') %></div>
                    <% end_if %>
                    <% if PriceCategory %>
                        <div ><% _t('Poi.PRICE_CATEGORY','Poi.PRICE_CATEGORY') %>: $PriceCategoryText</div>
                    <% end_if %>
                    <% if FoodCategory %>
                        <div ><% _t('Poi.FOOD_CATEGORY','Poi.FOOD_CATEGORY') %>: $FoodCategoryText</div>
                    <% end_if %>
                    <% if NumberBeds %>
                        <div ><% _t('Poi.NUMBER_OF_BEDS','Poi.NUMBER_OF_BEDS') %>: $NumberBeds</div>
                    <% end_if %>
                    <% if NumberGroups %>
                        <div ><% _t('Poi.NUMBER_OF_GROUPS','Poi.NUMBER_OF_GROUPS') %>: $NumberGroups</div>
                    <% end_if %>

                    <!--
                    <div class="acc-icons-overview" style="clear:both">
                    <% if InfoBooklet %>
                        <span class="acc-icon acc-icon-booklet left" title="<% _t('Accomondation.BOOKLET','Accomondation.BOOKLET') %>"></span>
                    <% end_if %>                
                    <% if PilgrimStamp %>
                        <span class="acc-icon acc-icon-stamp left" title="<% _t('Accomondation.STAMP','Accomondation.STAMP') %>"></span>
                    <% end_if %>
                    <% if DogsAllowed %>
                        <span class="acc-icon acc-icon-dogs left" title="<% _t('Accomondation.DOGS','Accomondation.DOGS') %>"></span>
                    <% end_if %>
                    <% if PilgrimPassMandatory %>
                        <span class="acc-icon acc-icon-passmandatory left" title="<% _t('Accomondation.PASS_MANDATORY','Accomondation.PASS_MANDATORY') %>"></span>
                    <% end_if %>
                    <% if HandicappedAccessible %>
                        <span class="acc-icon acc-icon-handicapped left" title="<% _t('Accomondation.HANDICAPPED','Accomondation.HANDICAPPED') %>"></span>
                    <% end_if %>
                    <% if Restaurant %>
                        <span class="acc-icon acc-icon-restaurant left" title="<% _t('Accomondation.RESTAURANT','Accomondation.RESTAURANT') %>"></span>
                    <% end_if %>
                    </div>
                    -->
                </td>
            </tr>
        <% end_control %>
        </tbody>       
   </table>
</div>