<?php

class Recipe{

	private $name;
	private $ingredients;
	
	public function __construct($name, $ingredients) {
        $this->name = $name;
		$this->ingredients = $ingredients;
    }
	
	public function getingredients(){
		return $this->ingredients;
	}
	
	public function setingredients($ingredients){
		$this->ingredients = $ingredients;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function __toString(){
        return $this->name . "," .$this->ingredients;
    }
}