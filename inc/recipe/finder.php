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

	public function GetRecommendedRecipe(){
		$recommendedRecipe = null;
		$recipeExpiry = null;
		
		if(is_null($recommendedRecipe)){
			return "Order Takeout";
		}
		
		return $recommendedRecipe;
	}
	
}