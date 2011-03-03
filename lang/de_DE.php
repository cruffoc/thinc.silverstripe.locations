<?php
i18n::include_locale_file('locations', 'en_US');

global $lang;

if(array_key_exists('de_DE', $lang) && is_array($lang['de_DE'])) {
    $lang['de_DE'] = array_merge($lang['en_US'], $lang['de_DE']);
} else {
    $lang['de_DE'] = $lang['en_US'];
}

$lang['de_DE']['Poi']['GETCOORDS'] = 'Fetch coordinates by address';
$lang['de_DE']['Poi']['PLURALNAME'] = array(
	'Pois',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['de_DE']['Poi']['SINGULARNAME'] = array(
	'Poi',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['de_DE']['PoiCategory']['PLURALNAME'] = array(
	'Poi categories',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['de_DE']['PoiCategory']['SINGULARNAME'] = array(
	'Poi category',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['de_DE']['PoiLocationPage']['PLURALNAME'] = array(
	'Location pages',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['de_DE']['PoiLocationPage']['SINGULARNAME'] = array(
	'Location page',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['de_DE']['PoiLocationPage']['TITLE'] = 'Ort';
$lang['de_DE']['PoiPage.ss']['ADDRESS'] = 'Adresse';
$lang['de_DE']['PoiPage.ss']['CONTACT_LOCATION'] = 'Kontakt & Lageplan';
$lang['de_DE']['PoiPage.ss']['EMAIL'] = 'Email';
$lang['de_DE']['PoiPage.ss']['FAX'] = 'Fax';
$lang['de_DE']['PoiPage.ss']['MOBILE'] = 'Handy';
$lang['de_DE']['PoiPage.ss']['PHONE'] = 'Telefon';
$lang['de_DE']['PoiPage.ss']['WEBSITE'] = 'Webseite';
?>
