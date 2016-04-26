<?php

//require_once "~/projects/benchmark/src/Timer.php";

use wtucker1664\Benchmark;

class benchmarkTest extends \PHPUnit_Framework_TestCase
{
	public function testInstance(){

		$timer = new Benchmark\Timer();
		
		$this->assertInstanceOf('wtucker1664\Benchmark\Timer',$timer,"Test Timer class");
	}
	
	public function testReturnIsArray(){
	$timer = new Benchmark\Timer();
		$timer->label("Test");
    	 $timer->start();
//     	
     	usleep(10000);
    	
     	$timer->end("Test");
     	
     	$timer->report("Test");
     	
     	$timer->label("Test1");
     	$timer->start("Test1");
     	
     	usleep(20000);
     	
     	$timer->label("Test2");
     	$timer->start("Test2");
     	
     	usleep(30000);
     	
     	$timer->end();
     	$output = $timer->report();
     	$this->assertArrayHasKey("Test",$output);
     	$this->assertArrayHasKey("Test1",$output);
     	$this->assertArrayHasKey("Test2",$output);
     	$this->assertArrayHasKey("totalExecutionTime",$output);
     	
	}
}
