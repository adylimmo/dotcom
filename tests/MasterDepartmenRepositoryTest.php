<?php

use App\Models\MasterDepartmen;
use App\Repositories\MasterDepartmenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterDepartmenRepositoryTest extends TestCase
{
    use MakeMasterDepartmenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MasterDepartmenRepository
     */
    protected $masterDepartmenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->masterDepartmenRepo = App::make(MasterDepartmenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMasterDepartmen()
    {
        $masterDepartmen = $this->fakeMasterDepartmenData();
        $createdMasterDepartmen = $this->masterDepartmenRepo->create($masterDepartmen);
        $createdMasterDepartmen = $createdMasterDepartmen->toArray();
        $this->assertArrayHasKey('id', $createdMasterDepartmen);
        $this->assertNotNull($createdMasterDepartmen['id'], 'Created MasterDepartmen must have id specified');
        $this->assertNotNull(MasterDepartmen::find($createdMasterDepartmen['id']), 'MasterDepartmen with given id must be in DB');
        $this->assertModelData($masterDepartmen, $createdMasterDepartmen);
    }

    /**
     * @test read
     */
    public function testReadMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $dbMasterDepartmen = $this->masterDepartmenRepo->find($masterDepartmen->id);
        $dbMasterDepartmen = $dbMasterDepartmen->toArray();
        $this->assertModelData($masterDepartmen->toArray(), $dbMasterDepartmen);
    }

    /**
     * @test update
     */
    public function testUpdateMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $fakeMasterDepartmen = $this->fakeMasterDepartmenData();
        $updatedMasterDepartmen = $this->masterDepartmenRepo->update($fakeMasterDepartmen, $masterDepartmen->id);
        $this->assertModelData($fakeMasterDepartmen, $updatedMasterDepartmen->toArray());
        $dbMasterDepartmen = $this->masterDepartmenRepo->find($masterDepartmen->id);
        $this->assertModelData($fakeMasterDepartmen, $dbMasterDepartmen->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $resp = $this->masterDepartmenRepo->delete($masterDepartmen->id);
        $this->assertTrue($resp);
        $this->assertNull(MasterDepartmen::find($masterDepartmen->id), 'MasterDepartmen should not exist in DB');
    }
}
