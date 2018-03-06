<?php

use App\Models\Bimbel;
use App\Repositories\BimbelRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BimbelRepositoryTest extends TestCase
{
    use MakeBimbelTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BimbelRepository
     */
    protected $bimbelRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bimbelRepo = App::make(BimbelRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBimbel()
    {
        $bimbel = $this->fakeBimbelData();
        $createdBimbel = $this->bimbelRepo->create($bimbel);
        $createdBimbel = $createdBimbel->toArray();
        $this->assertArrayHasKey('id', $createdBimbel);
        $this->assertNotNull($createdBimbel['id'], 'Created Bimbel must have id specified');
        $this->assertNotNull(Bimbel::find($createdBimbel['id']), 'Bimbel with given id must be in DB');
        $this->assertModelData($bimbel, $createdBimbel);
    }

    /**
     * @test read
     */
    public function testReadBimbel()
    {
        $bimbel = $this->makeBimbel();
        $dbBimbel = $this->bimbelRepo->find($bimbel->id);
        $dbBimbel = $dbBimbel->toArray();
        $this->assertModelData($bimbel->toArray(), $dbBimbel);
    }

    /**
     * @test update
     */
    public function testUpdateBimbel()
    {
        $bimbel = $this->makeBimbel();
        $fakeBimbel = $this->fakeBimbelData();
        $updatedBimbel = $this->bimbelRepo->update($fakeBimbel, $bimbel->id);
        $this->assertModelData($fakeBimbel, $updatedBimbel->toArray());
        $dbBimbel = $this->bimbelRepo->find($bimbel->id);
        $this->assertModelData($fakeBimbel, $dbBimbel->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBimbel()
    {
        $bimbel = $this->makeBimbel();
        $resp = $this->bimbelRepo->delete($bimbel->id);
        $this->assertTrue($resp);
        $this->assertNull(Bimbel::find($bimbel->id), 'Bimbel should not exist in DB');
    }
}
