<?php
namespace wtucker1664\Benchmark;

class Timer{
	private $timers = array();
	private $timerStarted = false;
	private $currentLabel = '';
	public function __construct($timezone="Europe/London"){
		date_default_timezone_set($timezone);
	}
	
	public function label($label){
		try{
			if(is_string($label)){
				
					$this->timers[$label] = array();
				
				$this->currentLabel = $label;
			}else{
				throw Exception("Label must be a string");
			}
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	
	public function start($label = ''){
		try{
			if($label == ""){
				if($this->currentLabel != ""){
					if(isset($this->timers[$this->currentLabel])){
						$this->timers[$this->currentLabel]["startTime"] = microtime(true);
						$this->timers[$this->currentLabel]["startTime"] = microtime(true);
					}else{
						throw Exception("Label ".$this->currentLabel." does not exist");
					}
				}else{
					if(isset($this->timers[$label])){
						$this->timers[$label]["startTime"] = microtime(true);
					}else{
						throw Exception("Label not set");
					}
				}
			}else{
				$this->timers[$label]["startTime"] = microtime(true);
			}
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	
	public function end($label = ""){
	
		if($label == ""){
			$keys = array_keys($this->timers);
			for($i=0;$i<sizeof($keys);$i++){
				if(!isset($this->timers[$keys[$i]]["endTime"])){
					$this->timers[$keys[$i]]["endTime"] = microtime(true);
				}
			}
		}elseif(isset($this->timers[$label])){
				$this->timers[$label]["endTime"] = microtime(true);	
			
		}else{
			throw Exception("Label does not exist");
		}
	
	}
	
	
	
	public function report($label = ""){
		$totalExecutionTime = 0;
		if($label == ""){
			$keys = array_keys($this->timers);
			
			for($i=0;$i<sizeof($keys);$i++){
				$this->timers[$keys[$i]]["totalTime"] = $this->timers[$keys[$i]]["endTime"] - $this->timers[$keys[$i]]["startTime"];
				
				$totalExecutionTime += $this->timers[$keys[$i]]["totalTime"];
			}
		}else{
				$this->timers[$label]["totalTime"] = $this->timers[$label]["endTime"] - $this->timers[$label]["startTime"];
				
				$totalExecutionTime += $this->timers[$label]["totalTime"];
		}
		$output["totalExecutionTime"] = $totalExecutionTime;
		$output = array_merge($this->timers,$output);
		
		return $output;		
	}
	
}
?>