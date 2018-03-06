<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KursusApiTest extends TestCase
{
    use MakeKursusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKursus()
    {
        $kursus = $this->fakeKursusData();
        $this->json('POST', '/api/v1/kursuses', $kursus);

        $this->assertApiResponse($kursus);
    }

    /**
     * @test
     */
    public function testReadKursus()
    {
        $kursus = $this->makeKursus();
        $this->json('GET', '/api/v1/kursuses/'.$kursus->id);

        $this->assertApiResponse($kursus->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKursus()
    {
        $kursus = $this->makeKursus();
        $editedKursus = $this->fakeKursusData();

        $this->json('PUT', '/api/v1/kursuses/'.$kursus->id, $editedKursus);

        $this->assertApiResponse($editedKursus);
    }

    /**
     * @test
     */
    public function testDeleteKursus()
    {
        $kursus = $this->makeKursus();
        $this->json('DELETE', '/api/v1/kursuses/'.$kursus->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kursuses/'.$kursus->id);

        $this->assertResponseStatus(404);
    }
}
