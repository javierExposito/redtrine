<?php

namespace Redtrine\Tests\Structure;

use Redtrine\Redtrine;
use Redtrine\Structure\Rlist;
use Redtrine\Tests\RedtrineTestCase;

class RlistTest extends RedtrineTestCase
{
    /**
     * @var Rlist
     */
    protected $list;

    protected function setUp()
    {
        parent::setUp();
        $this->list = $this->redtrine->create('List', 'listName');
        $this->list->removeAll();
    }

    /**
     * @dataProvider getValues
     */
    public function testLeftPush($value)
    {
        $this->list->leftPush($value);
        $this->assertEquals($this->list->get(0), $value);
    }

    /**
     * @dataProvider getValues
     */
    public function testRightPush($value)
    {
        $this->list->rightPush($value);
        $this->assertEquals($this->list->get($this->list->length() - 1), $value);
    }

    public function testRightPop()
    {
        $this->populateList();

        do {
            $previousLengh = $this->list->length();
            $this->list->rightPop();
            $this->assertEquals($previousLengh-1, $this->list->length());
        } while ($this->list->length() > 0);
    }

    public function testLeftPop()
    {
        $this->populateList();

        do {
            $head = array_shift($this->list->head());
            $this->list->leftPop();
            $this->assertNotContains($head, $this->list);
        } while ($this->list->length() > 0);
    }

    public function testInsertBefore()
    {
        $this->populateList();
        $value = 'insertBefore' . rand();
        $pivot = $this->list->get(5);

        $this->list->insertBefore($pivot, $value);
        $this->assertEquals($this->list->get(5), $value);
    }

    public function testInsertAfter()
    {
        $this->populateList();
        $value = 'insertAfter' . rand();
        $pivot = $this->list->get(5);

        $this->list->insertAfter($pivot, $value);
        $this->assertEquals($this->list->get(6), $value);
    }

    public function testSet()
    {
        $this->populateList();
        $value = 'set' . rand();

        $this->list->set(5, $value);
        $this->assertEquals($this->list->get(5), $value);
    }

    public function getValues()
    {
        $result = array();
        foreach ($this->getRandomValues() as $value) {
            $result[] = array($value);
        }

        return $result;
    }

    protected  function getRandomValues($total = 20)
    {
        $result = array();
        for ($i = 0; $i < $total; $i++) {
            $result[] = md5(uniqid(rand(), true));
        }

        return $result;
    }

    protected function populateList()
    {
        foreach ($this->getRandomValues() as $value) {
            $this->list->leftPush($value);
        }
    }
}
