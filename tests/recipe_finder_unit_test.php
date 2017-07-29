<?php

include_once '../config.php';

class Recipe_Finder_Unit_Test extends PHPUnit_Framework_TestCase{
	
	protected $recipeFinder;
	
	protected function setUp() {
        $this->recipeFinder = new Finder("fridge.csv","recipe.json.txt");
    }
	
	protected function tearDown() {
        unset($this->recipeFinder);
    }
	
	public function testRecommendRecipe() {
        $expected = "grilled cheese on toast";
        $actual = $this->recipeFinder->GetRecommendedRecipe();
        $this->assertEquals($expected, $actual);
    }
}
