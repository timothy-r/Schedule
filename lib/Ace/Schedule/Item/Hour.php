<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\ValueInterface;
use Ace\Schedule\MatcherInterface;
use Ace\Schedule\Exception;

/**
* Tests whether a DateTime matches a certain hour value
*/
class Hour implements MatcherInterface {
    /**
    * @var ValueInterface
    */
	protected $hour;

	public function __construct(ValueInterface $hour){
        if ($hour->lessThan(0) || $hour->greaterThan(23)){
            throw new Exception("Hour value must be between 0 and 23");
        }
		$this->hour = $hour;
	}

	public function matches(\DateTime $date_time){
		return $this->hour->contains(intval($date_time->format('G')));
	}
}
