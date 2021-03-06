<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\ValueInterface;
use Ace\Schedule\MatcherInterface;
use Ace\Schedule\Exception;

class Month implements MatcherInterface {
	private $month;
	
	public function __construct(ValueInterface $month){
        if ($month->lessThan(1) || $month->greaterThan(12)){
            throw new Exception('Month value must be between 1 and 12');
        }
		$this->month = $month;
	}

	public function matches(\DateTime $date_time){
		return $this->month->contains(intval($date_time->format('n')));
	}
}
