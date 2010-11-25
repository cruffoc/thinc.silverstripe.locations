<?php
/**
 * Field that generates a heading tag.
 * This can be used to add extra text in your forms.
 * @package forms
 * @subpackage fields-dataless
 */
class MapField extends DatalessField {
    
    /**
     * @var int $headingLevel The level of the <h1> to <h6> HTML tag. Default: 2
     */
    protected $headingLevel = 2;
    private $divId;
    function __construct($name, $title = null, $headingLevel = 2, $allowHTML = false, $form = null) {
    	$this->divId = $name;
        // legacy handling for old parameters: $title, $heading, ...
        // instead of new handling: $name, $title, $heading, ...
        $args = func_get_args();
        if(!isset($args[1]) || is_numeric($args[1])) {
            $title = (isset($args[0])) ? $args[0] : null;
            // Use "HeaderField(title)" as the default field name for a HeaderField; if it's just set to title then we risk
            // causing accidental duplicate-field creation.
            $name = 'MapField' . $title; // this means i18nized fields won't be easily accessible through fieldByName()
            $headingLevel = (isset($args[1])) ? $args[1] : null;
            $allowHTML = (isset($args[2])) ? $args[2] : null;
            $form = (isset($args[3])) ? $args[3] : null;
        } 
        
        if($headingLevel) $this->headingLevel = $headingLevel;
        $this->allowHTML = $allowHTML;
        //Requirements::javascript('http://maps.google.com/maps/api/js?sensor=false');
        //Requirements::javascript('http://jakobsweg.c-web.ch/locations/javascript/PoiPopup.js');
        parent::__construct($name, $title, null, $allowHTML, $form);
    }
    
    function Field() {
        $attributes = array(
            'class' => $this->extraClass(),
            'id' => $this->divId,
            'style' => "width:400px;height:300px;"
        );
        return $this->createTag(
            "div",
            $attributes
        );
    }
}
?>