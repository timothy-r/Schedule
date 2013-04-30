<?php
namespace Ace\Schedule;

/**
* contains a single schedule entry
*/
class Entry {
	/**
	* @var array of iMatcher instances
	*/
	protected $matchers;

	public function __construct(array $matchers = array()){
		$this->matchers = $matchers;
	}

	/**
	* for a schedule to match all its items must match
	* @return boolean
	*/
	public function matches(\DateTime $date_time){
		foreach($this->matchers as $matcher){
			if (!$matcher->matches($date_time)){
				return false;
			}
		}
		return true;
	}

	public function isValid() {
		return is_array($this->matchers);
	}
}
