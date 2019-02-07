<?php
class DatabaseTest extends TestCase
{
    /**
     * test db:seed.
     * @return void
     */
    public function testTableSeed()
    {
        $this->seeInDatabase('trucks', ['vehicle_type' => 'Caminhão 3/4','code' => 1]);

    }

}
