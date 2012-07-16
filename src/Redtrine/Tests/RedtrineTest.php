<?php

namespace Redtrine\Tests;

use Redtrine\Redtrine;

class RedtrineTest extends RedtrineTestCase
{
    /**
     * @covers Redtrine\Redtrine::getClient
     */
    public function testGetClient()
    {
        $this->assertNotNull($this->redtrine->getClient());
    }

    public function testCreate()
    {
        $set = $this->redtrine->create('Set', 'theNameOfTheSet');
        $this->assertInstanceOf('Redtrine\Structure\Set', $set);
    }
}
