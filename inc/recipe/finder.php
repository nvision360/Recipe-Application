<?php
final class Finder{

	private $fridgeCsvFile;
	private $recipeJsonFile;
	private $fridgeIngredients = array();
	private $recipes = array();
	
	public function __construct($fridgeCsvFile, $recipeJsonFile){
		$this->fridgeCsvFile = $fridgeCsvFile;
		$this->recipeJsonFile = $recipeJsonFile;
		$this->readCSV($this->fridgeCsvFile);
		$this->readJSON($this->recipeJsonFile);
	}
	//getting recommended recipe based on the most available ingredients
	public function GetRecommendedRecipe(){
		$recommendedRecipe = null;
		$recipeExpiry = null;
		//looping through all the available recipes in the JSON
		for($rcpCounter=0;$rcpCounter<count($this->recipes);$rcpCounter++){
			$currentRecipe = $this->recipes[$rcpCounter];
			$ingredientsRequired = $currentRecipe->getingredients();
			//storing recipes in the list along with expiry dates
			list($ingredientAvailableToMakeRecipe, $recipeExpiryDate) =  $this->GetAvailableIngredients($ingredientsRequired);	
			//check if ingredient is not expired
			if($ingredientAvailableToMakeRecipe){
				if(is_null($recipeExpiry)){
					$recommendedRecipe = $currentRecipe->getName();
					$recipeExpiry = $recipeExpiryDate;
				}else if($recipeExpiryDate < $recipeExpiry){
					$recommendedRecipe = $currentRecipe->getName();
					$recipeExpiry = $recipeExpiryDate;
				}
			}
		}
		//if no recipe found then return default message
		if(is_null($recommendedRecipe)){
			return "Order Takeout";
		}
		//return the most available recipe
		return $recommendedRecipe;
	}
	
	//getting available ingredients
	private function GetAvailableIngredients($requiredingredients){
		$recipeExpireDate = null;
		//looping through all required ingredients
		for($i=0;$i<count($requiredingredients);$i++){
			$ingrdntInFrdge = false;		
			$ingredient = $requiredingredients[$i]; //required for recipe
			$ingredientRequiredForRecipe = $ingredient->getItem();
			$ingredientAmtRequiredForRecipe = $ingredient->getAmount();
			//looping through fridge ingredients
			for($m=0;$m<count($this->fridgeIngredients);$m++){
				$currentFrdgIngrdnt = $this->fridgeIngredients[$m];
				$currentFrdgIngrdntName = $currentFrdgIngrdnt->getIngredient()->getItem();
				$currentFrdgIngrdntAmt = $currentFrdgIngrdnt->getIngredient()->getAmount();
				$currentFrdgIngrdntUseByDate = $currentFrdgIngrdnt->getUseByDate();
				//skip non required ingredients
				if($ingredientRequiredForRecipe != $currentFrdgIngrdntName){
					continue;
				}else{
					//checking for ingredient quantity & expiry date
					if($ingredientAmtRequiredForRecipe <= $currentFrdgIngrdntAmt  && !$currentFrdgIngrdnt->isExpired()){
						$ingrdntInFrdge = true;
						if(is_null($recipeExpireDate)){
							$recipeExpireDate = $currentFrdgIngrdnt->getUseByDate();
						}else if($currentFrdgIngrdnt->getUseByDate() < $recipeExpireDate){
							$recipeExpireDate = $currentFrdgIngrdnt->getUseByDate();
						}
					}else{
						return array(false, null);
					}
				}
			}
			
			if($ingrdntInFrdge){
				continue;
			}else{
				return array(false, null);
			}
		}
		return array(true, $recipeExpireDate);
	}
	
	//reading fridge csv file
	private function readCSV($fridgeCvFile){
		$frdgCsvHndlr = fopen($fridgeCvFile,"r");
		while(!feof($frdgCsvHndlr)){
			list($item, $amount, $unit, $useByDate) = fgetcsv($frdgCsvHndlr);
			if(!is_numeric($amount))continue;
					
			$ingredient = new Ingredients(trim($item), trim($amount), trim($unit));
			$fridgeIngredient = new Items($ingredient, trim($useByDate));
			array_push($this->fridgeIngredients, $fridgeIngredient);
		}
		fclose($frdgCsvHndlr);
	}

	//reading recipe JSON file
	private function readJSON($recipeJsonFile){
		$recipeJson = json_decode(file_get_contents($recipeJsonFile), true);
		if($recipeJson){
			$recipeName;
			$ingredientsRequired = array();
			//looping through JSON file
			foreach($recipeJson as $recipeCounter => $recipe){
				//storing information in array
				$recipeName = $recipeJson[$recipeCounter]['name'];
				$ingredients = $recipeJson[$recipeCounter]['ingredients'];
				$ingredientCollection = array();
				//storing ingredients informaiton with respect to recipe
				foreach($ingredients as $ingredientCounter => $ingredient){
					$item = $ingredients[$ingredientCounter]['item'];
					$amount = $ingredients[$ingredientCounter]['amount'];
					$unit = $ingredients[$ingredientCounter]['unit'];
					$ingredientObj = new Ingredients(trim($item), trim($amount), trim($unit));
					array_push($ingredientCollection, $ingredientObj);
				}
				$recipe = new Recipe($recipeName, $ingredientCollection);			
				array_push($this->recipes, $recipe);
			}
		}else{
			throw new Exception("Error: file format error, expecting JSON recipe file");
		}
	}
}