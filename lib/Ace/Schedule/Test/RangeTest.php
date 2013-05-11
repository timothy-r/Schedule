<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\Range;

require_once(dirname(__FILE__)."/../iValue.php");
require_once(dirname(__FILE__)."/../Value/Range.php");

/**
* @group unit
* @group schedule
*/
class RangeTestCase extends \PHPUnit_Framework_TestCase {

	public function testRangeContainsManyValues() {
		$list_value = new Range(4, 20);
		$result = $list_value->contains(4);
		$this->assertTrue($result, "Expected Range(4, 20) to match '4'");
		$result = $list_value->contains(6);
		$this->assertTrue($result, "Expected Range(4, 20) to match '6'");
		$result = $list_value->contains(20);
		$this->assertTrue($result, "Expected Range(4, 20) to match '20'");
	}

	public function testRangeDoesNotContainValue() {
		$list_value = new Range(1, 2);
		$result = $list_value->contains(4);
		$this->assertFalse($result, "Did not expected Range(1, 2) to match '4'" );
	}

    public function testRangeMin()
    {
        $min = 13;
        $max = 18;
		$range = new Range($min, $max);
        $this->assertSame($min, $range->min());
    }

    public function testRangeMax()
    {
        $min = 1;
        $max = 8;
		$range = new Range($min, $max);
        $this->assertSame($max, $range->max());
    }
}
