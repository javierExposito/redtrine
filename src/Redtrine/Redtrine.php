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

}
