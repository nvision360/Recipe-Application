<?php

class Items{

	private $ingredient;
	private $useByDate;
	private $expired = false;

	public function __construct($ingredient, $useByDate) {
		$this->ingredient = $ingredient;
		$this->useByDate = DateTime::createFromFormat(DATE_FORMAT, $useByDate);
		if(new DateTime() > $this->useByDate){
			$this->expired = true;
		}
		else{
			$this->expired = false;
		}
    }
	
	public function getIngredient(){
		return $this->ingredient;
	}
	
	public function setIngredient($ingredient){
		$this->ingredient = $ingredient;
	}
	
	public function isExpired(){
		return $this->expired;
	}
	
	public function setExpired($expired){
		$this->expired = $expired;
	}
	
	public function getUseByDate(){	
		return $this->useByDate;
	}
	
	public function setUseByDate($useByDate){	
		$this->useByDate = DateTime::createFromFormat(DATE_FORMAT, $useByDate);
	}
	
	public function __toString(){
        return $ingredient . "," . $this->useByDate->format(DATE_FORMAT) . "," . $this->expired;
    }

}
