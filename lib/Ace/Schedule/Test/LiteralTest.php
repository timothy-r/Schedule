<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\Literal;

require_once(dirname(__FILE__)."/../Value/iValue.php");
require_once(dirname(__FILE__)."/../Value/Literal.php");

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
}
