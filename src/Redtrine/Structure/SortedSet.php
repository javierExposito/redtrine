<?php

namespace Redtrine\Structure;

use IteratorAggregate,
    ArrayIterator,
    Countable;

class SortedSet extends Base implements IteratorAggregate, Countable
{
    /**
     * Add an element to the set.
     *
     * @param $element
     */
    public function add($element, $score = 0)
    {
        $this->client->zadd($this->key, $score, $element);
    }

    /**
     * Remove an element from the set.
     *
     * @param $element
     */
    public function remove($element)
    {
        $this->client->zrem($this->key, $element);
    }

    /**
     * Check whether an element exists in the set.
     *
     * @param $element
     * @return boolean
     */
    public function exists($element)
    {
        return null !== $this->client->zscore($this->key, $element);
    }

    /**
     * Check whether an element exists in the set.
     *
     * @param $element
     * @return boolean
     */
    public function contains($element)
    {
        return $this->exists($element);
    }

    /**
     * Get an array of elements stored in the set.
     *
     * @return mixed
     */
    public function elements()
    {
        return $this->client->zrange($this->key, 0, -1);
    }

    /**
     * Returns the set cardinality (number of elements) of the set.
     *
     * @return int
     */
    public function length()
    {
        return $this->client->zcard($this->key);
    }

    /**
     * Count the elements in the object.
     *
     * @return int
     */
    public function count()
    {
        return $this->length();
    }

    public function removeAll()
    {
        $this->client->del($this->key);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->elements());
    }

    /**
     *
     * Returns the rank of the element in the sorted set, with the
     * scores ordered from low to high. The rank (or index) is 0-based,
     * which means that the member with the lowest score has rank 0.
     *
     * @param $element
     * @return mixed
     *
     * @see http://redis.io/commands/zrank
     */
    public function rank($element)
    {
        return $this->client->zrank($this->key, $element);
    }

    /**
     * Returns the score of the element in the sorted set.
     *
     * @param $element
     * @return mixed
     *
     * @see http://redis.io/commands/zscore
     */
    public function score($element)
    {
        return $this->client->zscore($this->key, $element);
    }

}
