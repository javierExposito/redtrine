<?php

namespace Redtrine;

use Predis\Client as Redis;

class Redtrine
{
    protected $client;

    public function __construct()
    {

    }

    public function setClient(Redis $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function create($structure, $name)
    {
        $class = 'Redtrine\\Structure\\' . $structure;

        if (class_exists($class)) {
            $obj = new $class($name);
            $obj->setClient($this->client);

            return $obj;

        } else {
            throw new \InvalidArgumentException(sprintf('Impossible to create structure %s, class %s not found.', $structure, $class));
        }
    }
}
