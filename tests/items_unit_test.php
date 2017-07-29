<?php

include_once '../config.php';

class Items_Unit_Test extends PHPUnit_Framework_TestCase{

	protected $item;
	
    protected function setUp() {
        $this->item = new Items(new Items("butter", "250", "grams"), "25/12/2017");
    }
	
	protected function tearDown() {
        unset($this->item);
    }
	
	public function testIsExpired() {
        $expected = false;
        $actual = $this->item->isExpired();
        $this->assertEquals($expected, $actual);
    }
}
