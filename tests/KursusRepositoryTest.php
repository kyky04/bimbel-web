<?php

use App\Models\Kursus;
use App\Repositories\KursusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KursusRepositoryTest extends TestCase
{
    use MakeKursusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KursusRepository
     */
    protected $kursusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kursusRepo = App::make(KursusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKursus()
    {
        $kursus = $this->fakeKursusData();
        $createdKursus = $this->kursusRepo->create($kursus);
        $createdKursus = $createdKursus->toArray();
        $this->assertArrayHasKey('id', $createdKursus);
        $this->assertNotNull($createdKursus['id'], 'Created Kursus must have id specified');
        $this->assertNotNull(Kursus::find($createdKursus['id']), 'Kursus with given id must be in DB');
        $this->assertModelData($kursus, $createdKursus);
    }

    /**
     * @test read
     */
    public function testReadKursus()
    {
        $kursus = $this->makeKursus();
        $dbKursus = $this->kursusRepo->find($kursus->id);
        $dbKursus = $dbKursus->toArray();
        $this->assertModelData($kursus->toArray(), $dbKursus);
    }

    /**
     * @test update
     */
    public function testUpdateKursus()
    {
        $kursus = $this->makeKursus();
        $fakeKursus = $this->fakeKursusData();
        $updatedKursus = $this->kursusRepo->update($fakeKursus, $kursus->id);
        $this->assertModelData($fakeKursus, $updatedKursus->toArray());
        $dbKursus = $this->kursusRepo->find($kursus->id);
        $this->assertModelData($fakeKursus, $dbKursus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKursus()
    {
        $kursus = $this->makeKursus();
        $resp = $this->kursusRepo->delete($kursus->id);
        $this->assertTrue($resp);
        $this->assertNull(Kursus::find($kursus->id), 'Kursus should not exist in DB');
    }
}
