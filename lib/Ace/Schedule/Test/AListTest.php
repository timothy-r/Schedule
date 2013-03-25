<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\AList;

require_once(dirname(__FILE__)."/../Value/iValue.iface.php");
require_once(dirname(__FILE__)."/../Value/AList.class.php");

/*
* @group unit
*/
class AListTestCase extends \PHPUnit_Framework_TestCase {

	public function testAListContainsManyValues() {
		$list_value = new AList(array('1', '2', '3'));
		$result = $list_value->contains('1');
		$this->assertTrue($result, "Expected AList(array('1', '2', '3')) to match '1'");
		$result = $list_value->contains('2');
		$this->assertTrue($result, "Expected AList(array('1', '2', '3')) to match '2'");
		$result = $list_value->contains('3');
		$this->assertTrue($result, "Expected AList(array('1', '2', '3')) to match '3'");
	}

	public function testAListDoesNotContainValue() {
		$list_value = new AList(array('1', '2', '3'));
		$result = $list_value->contains('4');
		$this->assertFalse($result, "Did not expected AList(array('1', '2', '3')) to match '4'" );
	}
}
