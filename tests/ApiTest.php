<?php

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('api/v1/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * test create truckers.
     *
     * @return void
     */
    public function testCreateTrucker()
    {
        $response = $this->post( '/api/v1/trucks', [
            "name" => "Bruno",
            "age" => '29',
            "sex" => "M",
            "trucks_code" => 1,
            "cnh" => "E",
            "is_own" => "Y",
            "is_loaded" =>"N",
            "number" => "150",
            "street" => "cristiano viana",
            "neighborhood" => "Pinheiros",
            "city" => "São Paulo",
            "state" => "SP",
            "country" => "Brazil",
            "lat" => "-23.56105360",
            "lng" => "-46.67558830",
            "created_at" => "2019-02-07 12:22:24",
            "updated_at" => "2019-02-07 12:22:24"])
            ->seeJson(["name" => "Bruno",
                "age" => '29',
                "sex" => "M",
                "trucks_code" => 1,
                "cnh" => "E",
                "is_own" => "Y",
                "is_loaded" =>"N",
                "number" => "150"
            ]);

        $this->assertResponseOk($response);
    }

    /**
     * get all unloaded truckers.
     * @return void
     */
    public function testGetUnloadedTruckers()
    {
        $response = $this->get( '/api/v1/trucks-notloaded')
            ->seeJson([
                "body" => "No results found unloaded trucks",
                "error" => false
            ]);
        $this->assertResponseOk($response);
    }

    /**
     * get all filtered truckers.
     * @return void
     */
    public function testGetFilteredTruckers()
    {
        $response = $this->post( '/api/v1/trucks-filter' , ['is_own' => 'Y'])
            ->seeJson([
                "body" => "No results found for specific filter",
                "error" => false
            ]);
        $this->assertResponseOk($response);
    }

    /**
     * get all unloaded truckers.
     * @return void
     */
    public function testGetAllTruckers()
    {
        $response = $this->get( '/api/v1/trucks')
            ->seeJson([
                "body" => "No results found",
                "error" => false
            ]);
        $this->assertResponseOk($response);
    }
}
