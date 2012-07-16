<?php

namespace Redtrine\Structure;

/**
 * Common base structure.
 */
class Base
{
    protected $namespace;

    protected $name;

    protected $key;

    protected $client;

    public function __construct()
    {
        $this->key = $this->namespace . ':' . $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getKeys()
    {
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }


}
