<?php

namespace Redtrine\Structure;

use IteratorAggregate,
    ArrayIterator,
    Countable;

class Set extends Base implements IteratorAggregate, Countable
{

    /**
     * Add an element to the set.
     *
     * @param $element
     */
    public function add($element)
    {
        $this->client->add($this->key, $element);
    }

    /**
     * Remove an element from the set.
     *
     * @param $element
     */
    public function remove($element)
    {
        $this->client->srem($this->key, $element);
    }

    /**
     * Check whether an element exists in the set.
     *
     * @param $element
     * @return boolean
     */
    public function exists($element)
    {
        return $this->client->sismember($element);
    }

    /**
     * Get an array of elements stored in the set.
     *
     * @return mixed
     */
    public function elements()
    {
        return $this->client->smembers($this->key);
    }

    /**
     * Returns the set cardinality (number of elements) of the set.
     *
     * @return int
     */
    public function length()
    {
        return $this->client->scard($this->key);
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

    public function getIterator()
    {
        return new ArrayIterator($this->elements());
    }


}
