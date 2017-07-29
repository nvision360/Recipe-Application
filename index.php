<?php
include "config.php";

try{
	//initializing recipe finder
	$recipe = new Finder("fridge.csv","recipe.json.txt");
	//printing recommended recipe
	echo $recipe->GetRecommendedRecipe();
}catch(Exception $e){
	echo $e->getMessage(), "\n\n";
	echo "Usage: /usr/bin/php -f Recipe-Finder/index.php fridge.csv recipe.json.txt";
}
?>
