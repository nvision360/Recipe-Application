<?php
include "config.php";

if($argc == 3){
	try{
		//initializing recipe finder
		$recipe = new Finder($argc[1],$argc[2]);
		//printing recommended recipe
		echo $recipe->GetRecommendedRecipe();
	}catch(Exception $e){
		echo $e->getMessage(), "\n\n";
		echo "Usage: /usr/bin/php -f Recipe-Finder/index.php fridge.csv recipe.json.txt";
	}
}
else{
	echo "Usage: /usr/bin/php -f Recipe-Finder/index.php fridge.csv recipe.json.txt";
}
?>
