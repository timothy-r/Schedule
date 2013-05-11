<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\WildCard;

require_once(dirname(__FILE__)."/../iValue.php");
require_once(dirname(__FILE__)."/../Value/WildCard.php");

/**
* @group unit
* @group schedule
*/
class WildCardTestCase extends \PHPUnit_Framework_TestCase {
	
	public function getFixtures()
	{
		return array(
			array('1'),
			array('4'),
			array('13'),
			array('Wednesday'),
			array('June')
		);
	}

	/**
	* @dataProvider getFixtures
	*/
	public function testWildCardContainsEverything($value) {
		$always_value = new WildCard();
		$result = $always_value->contains($value);
		$this->assertTrue($result, "Expected WildCard() to match '$value'" );
	}

    public function testWildcardMinReturnsNull()
    {
		$wildcard = new WildCard();
        $this->assertSame(null, $wildcard->min());
    }

    public function testWildcardMaxReturnsNull()
    {
		$wildcard = new WildCard();
        $this->assertSame(null, $wildcard->max());
    }

    public function testWildcardGreaterThanIsAlwaysFalse()
    {
        $value = -340;
		$wildcard = new WildCard();
        $this->assertFalse($wildcard->greaterThan($value));
    }

    public function testWildcardLessThanIsAlwaysFalse()
    {
        $value = 10000;
		$wildcard = new WildCard();
        $this->assertFalse($wildcard->lessThan($value));
    }
}
