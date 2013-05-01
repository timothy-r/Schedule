<?php
namespace Ace\Schedule;
use Ace\Schedule\Value\iValue;

interface iMatcher {
	public function __construct(iValue $value);
	public function matches(\DateTime $date_time);
}
