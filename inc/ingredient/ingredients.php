<?php
class Ingredients{

	private $item;
	private $amount;
	private $unit;
	
	public function __construct($item, $amount, $unit) {
        $this->item = $item;
		$this->amount = $amount;
		try {
			$this->unit = new Unit($unit);
		} catch (Exception $e) {
			throw new Exception("Error: Unknow measuring unit");
		}
    }
	
	public function getItem(){
		return $this->item;
	}
	
	public function setItem($item){
		$this->item = $item;
	}
	
	public function getAmount(){
		return $this->amount;
	}
	
	public function setAmount($amount){
		$this->amount = $amount;
	}
	
	public function __toString(){
        return $this->item . "," .$this->amount . "," . $this->unit;
    }
}