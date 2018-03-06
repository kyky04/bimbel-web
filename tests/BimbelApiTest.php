<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BimbelApiTest extends TestCase
{
    use MakeBimbelTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBimbel()
    {
        $bimbel = $this->fakeBimbelData();
        $this->json('POST', '/api/v1/bimbels', $bimbel);

        $this->assertApiResponse($bimbel);
    }

    /**
     * @test
     */
    public function testReadBimbel()
    {
        $bimbel = $this->makeBimbel();
        $this->json('GET', '/api/v1/bimbels/'.$bimbel->id);

        $this->assertApiResponse($bimbel->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBimbel()
    {
        $bimbel = $this->makeBimbel();
        $editedBimbel = $this->fakeBimbelData();

        $this->json('PUT', '/api/v1/bimbels/'.$bimbel->id, $editedBimbel);

        $this->assertApiResponse($editedBimbel);
    }

    /**
     * @test
     */
    public function testDeleteBimbel()
    {
        $bimbel = $this->makeBimbel();
        $this->json('DELETE', '/api/v1/bimbels/'.$bimbel->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bimbels/'.$bimbel->id);

        $this->assertResponseStatus(404);
    }
}
