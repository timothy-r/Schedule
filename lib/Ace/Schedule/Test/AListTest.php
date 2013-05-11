<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\AList;

require_once(dirname(__FILE__)."/../iValue.php");
require_once(dirname(__FILE__)."/../Value/AList.php");

/**
* @group unit
* @group schedule
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

    public function testAListMin()
    {
		$list = new AList(array('10', '27', '1', '3'));
        $this->assertSame('1', $list->min());
    }

    public function testAListMinForEmptyArrays()
    {
		$list = new AList(array());
        $this->assertSame(null, $list->min());
    }

    public function testAListMax()
    {
		$list = new AList(array('1', '19', '14', '11'));
        $this->assertSame('19', $list->max());
    }

    public function testAListMaxForEmptyArrays()
    {
		$list = new AList(array());
        $this->assertSame(null, $list->max());
    }
}
