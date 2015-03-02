<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\Literal;

/**
* @group unit
* @group schedule
*/
class LiteralTestCase extends \PHPUnit_Framework_TestCase {

	public function testLiteralContainsOwnValue() {
		$always_value = new Literal('1');
		$result = $always_value->contains('1');
		$this->assertTrue($result, "Expected Literal(1) to match 1" );
	}

	public function testLiteralValueDoesNotContainOther() {
		$always_value = new Literal('1');
		$result = $always_value->contains('5');
		$this->assertFalse($result, "Did not expected Literal(1) to match 5" );
	}

    public function testLiteralMin()
    {
        $value = 13;
		$literal = new Literal($value);
        $this->assertSame($value, $literal->min());
    }

    public function testLiteralMax()
    {
        $value = 13;
		$literal = new Literal($value);
        $this->assertSame($value, $literal->max());
    }

    public function getGreaterThanFixtures()
    {
        return array(
            array(13, 0, true),
            array(1, -90, true),
            array(1, 90, false),
        );
    }

    /**
    * @dataProvider getGreaterThanFixtures
    */
    public function testLiteralGreaterThan($value, $test, $result)
    {
		$literal = new Literal($value);
        $this->assertSame($result, $literal->greaterThan($test));
    }

    public function getLessThanFixtures()
    {
        return array(
            array(13, 0, false),
            array(1, -90, false),
            array(1, 90, true),
        );
    }

    /**
    * @dataProvider getLessThanFixtures
    */
    public function testLiteralLessThan($value, $test, $result)
    {
		$literal = new Literal($value);
        $this->assertSame($result, $literal->lessThan($test));
    }
}
