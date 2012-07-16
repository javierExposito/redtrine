<?php

namespace Redtrine\Tests\Structure;

use Redtrine\Redtrine;
use Redtrine\Structure\SortedSet;
use Redtrine\Tests\RedtrineTestCase;

class SortedSetTest extends RedtrineTestCase
{
    /**
     * @var SortedSet
     */
    protected $set;

    protected function setUp()
    {
        parent::setUp();
        $this->set = $this->redtrine->create('SortedSet', 'theNameOfTheSet');
        $this->set->removeAll();
    }

    /**
     * @dataProvider getElementsWithScore
     */
    public function testAdd($element, $score)
    {
        $this->set->add($element);
        $this->assertTrue($this->set->contains($element));
    }

    /**
     * @dataProvider getElementsWithScore
     */
    public function testRemove($element, $score)
    {
        $this->set->add($element);
        $this->assertTrue($this->set->contains($element));

        $this->set->remove($element);
        $this->assertFalse($this->set->contains($element));
    }

    public function testExists()
    {
        $elements = $this->getRandomElementsWithScores();
        foreach ($elements as $element) {
            $this->set->add($element);
            $this->assertTrue($this->set->contains($element));
        }

        foreach ($elements as $element) {
            $this->assertTrue($this->set->exists($element));
        }

        foreach ($elements as $element) {
            $this->set->remove($element);
            $this->assertFalse($this->set->exists($element));
        }
    }

    public function testElements()
    {
        $elements = $this->getRandomElementsWithScores();

        foreach ($elements as $element) {
            $this->set->add($element);
            $this->assertTrue($this->set->contains($element));
        }

        $setElements = array_values($this->set->elements());
        sort($setElements);

        $elements = array_values($elements);
        sort($elements);

        $this->assertEquals($setElements, $elements);

        return $elements;
    }

    public function testLenght()
    {
        $this->assertEquals(0, $this->set->length());
        $elements = $this->testElements();

        $this->assertEquals(count($elements), $this->set->length());
    }

    public function testIterator()
    {
        $elements = $this->testElements();
        foreach ($this->set as $element) {
            $this->assertContains($element, $elements);
        }
    }

    public function testRank()
    {
        $elements = $this->getRandomElementsWithScores();

        foreach ($elements as $element => $score) {
            $this->set->add($element, $score);
        }

        asort($elements);
        $rank = 0;

        foreach ($elements as $element => $score) {
            $elementRank = $this->set->rank($element);
            $this->assertTrue($elementRank >= $rank);
            $rank = $elementRank;
        }
    }

    /**
     * @dataProvider getElementsWithScore
     */
    public function testScore($element, $score)
    {
        $this->set->add($element, $score);
        $this->assertEquals($score, $this->set->score($element));
    }

    public function getElementsWithScore()
    {
        $result = array();
        foreach ($this->getRandomElementsWithScores() as $element => $score) {
            $result[] = array($element, $score);
        }

        return $result;
    }

    public function getRandomElementsWithScores()
    {
        $result = array();
        $total = 20;
        $score = rand(50, 100);;
        for ($i = 0; $i < $total; $i++) {
            $score += mt_rand(1, 100);
            $result[md5(uniqid(rand(), true))] = $score;
        }

        return $result;
    }

}
