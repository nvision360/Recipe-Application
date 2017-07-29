<?php

class Unit{

	private $measure;
	
	public function __construct($measure){
		$this->setMeasure($measure);
	}
	
	public function setMeasure($measure){	
		if(in_array($measure, unserialize(UNIT))){
			$this->measure = $measure;
		}else{
			throw new Exception("Error: Unknow measuring unit");
		}
	}
	
	public function getMeasure(){
		return $this->measure;
	}
	
	public function __toString(){
        return $this->measure;
    }
}

