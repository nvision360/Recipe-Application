<?php
//setting application constants
define('PATH', dirname(__FILE__).'/'); 
define('DATE_FORMAT' , 'd/m/Y');
define('UNIT' , serialize(array('slices', 'ml', 'grams')));

//including required classes
include_once PATH . 'inc/ingredient/unit.php';
include_once PATH . 'inc/ingredient/ingredients.php';
include_once PATH . 'inc/ingredient/items.php';
include_once PATH . 'inc/recipe/recipe.php';
include_once PATH . 'inc/recipe/finder.php';
//settting default timezone
date_default_timezone_set("Australia/Sydney"); 
?>