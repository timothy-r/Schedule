<?php
namespace Ace\Schedule;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\ValueInterface;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;


/**
* builds parts of a Schedule 
*/
class Builder implements BuilderInterface
{
	/**
	* @var array
	*/
	private $matchers = array();

	/**
	* @param ValueInterface $value
	*/
	public function buildMinute(ValueInterface $value){
		$this->matchers['minute'] = new Minute($value);
	}

	/**
	* @param ValueInterface $value
	* @return Hour
	*/
	public function buildHour(ValueInterface $value){
		$this->matchers['hour'] = new Hour($value);
	}

	/**
	* @param ValueInterface $value
	* @return Day
	*/
	public function buildDay(ValueInterface $value){
		$this->matchers['day'] = new Day($value);
	}

	/**
	* @param ValueInterface $value
	* @return Month
	*/
	public function buildMonth(ValueInterface $value){
		$this->matchers['month'] = new Month($value);
	}

	/**
	* @param ValueInterface $value
	* @return WeekDay
	*/
	public function buildWeekDay(ValueInterface $value){
		$this->matchers['week_day'] = new WeekDay($value);
	}
    
    /*
    * @return Entry
    */
	public function getProduct()
	{
		return $this->createEntry($this->matchers);
	}
    
    /*
    * implementing this method allows tests to assert the $matchers array passed to the Entry
    * @return Entry
    */
    private function createEntry(array $matchers)
    {
        return new Entry($matchers);
    }
}
