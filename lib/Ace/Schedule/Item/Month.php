<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\Value\iValue;
use Ace\Schedule\iMatcher;

class Month implements iMatcher {
	protected $month;
	
	public function __construct(iValue $month){
		$this->month = $month;
	}

	public function matches(\DateTime $date_time){
		return $this->month->contains(intval($date_time->format('n')));
	}
}
