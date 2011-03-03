<?php
i18n::include_locale_file('locations', 'en_US');

global $lang;

if(array_key_exists('fr_FR', $lang) && is_array($lang['fr_FR'])) {
    $lang['fr_FR'] = array_merge($lang['en_US'], $lang['fr_FR']);
} else {
    $lang['fr_FR'] = $lang['en_US'];
}

$lang['fr_FR']['Poi']['GETCOORDS'] = 'Fetch coordinates by address';
$lang['fr_FR']['Poi']['PLURALNAME'] = array(
	'Pois',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['fr_FR']['Poi']['SINGULARNAME'] = array(
	'Poi',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['fr_FR']['PoiCategory']['PLURALNAME'] = array(
	'Poi categories',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['fr_FR']['PoiCategory']['SINGULARNAME'] = array(
	'Poi category',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['fr_FR']['PoiLocationPage']['PLURALNAME'] = array(
	'Location pages',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['fr_FR']['PoiLocationPage']['SINGULARNAME'] = array(
	'Location page',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);
$lang['fr_FR']['PoiLocationPage']['TITLE'] = 'Lieu';
$lang['fr_FR']['PoiPage.ss']['ADDRESS'] = 'Adresse';
$lang['fr_FR']['PoiPage.ss']['CONTACT_LOCATION'] = 'Contact & plan';
$lang['fr_FR']['PoiPage.ss']['EMAIL'] = 'Email';
$lang['fr_FR']['PoiPage.ss']['FAX'] = 'Fax';
$lang['fr_FR']['PoiPage.ss']['MOBILE'] = 'Mobil';
$lang['fr_FR']['PoiPage.ss']['PHONE'] = 'Tel';
$lang['fr_FR']['PoiPage.ss']['WEBSITE'] = 'Web';




?>