<?php
namespace Ace\Schedule;
use Ace\Schedule\iValue;
use DateTime;

interface iMatcher {
	public function __construct(iValue $value);
	public function matches(DateTime $date_time);
}
