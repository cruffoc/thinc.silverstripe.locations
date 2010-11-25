<?php
i18n::include_locale_file('locations', 'en_US');

global $lang;

if(array_key_exists('de_DE', $lang) && is_array($lang['de_DE'])) {
    $lang['de_DE'] = array_merge($lang['en_US'], $lang['de_DE']);
} else {
    $lang['de_DE'] = $lang['en_US'];
}


$lang['de_DE']['LocationAdmin']['MENUTITLE'] = 'Ortsinformationen';
$lang['de_DE']['Locations']['LOCATIONSINFORMATION'] = 'Ortsinformationen';
$lang['de_DE']['Locations']['LOCATIONS'] = 'Orte';
$lang['de_DE']['Locations']['LOCATION'] = 'Ort';
$lang['de_DE']['Poi']['CATEGORIES'] = 'Kategorien';
$lang['de_DE']['Poi']['CATEGORY'] = 'Kategorie';


?>