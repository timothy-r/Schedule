<?php namespace Ace\Schedule;

use DateTime;

/**
* interface for classes that match a DateTime value
* either directly or that contain a range of values that the DateTime value falls within
*/
interface MatcherInterface
{
    public function matches(DateTime $date_time);
}
