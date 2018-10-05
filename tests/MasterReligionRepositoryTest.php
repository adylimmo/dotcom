<?php

use App\Models\MasterReligion;
use App\Repositories\MasterReligionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterReligionRepositoryTest extends TestCase
{
    use MakeMasterReligionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MasterReligionRepository
     */
    protected $masterReligionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->masterReligionRepo = App::make(MasterReligionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMasterReligion()
    {
        $masterReligion = $this->fakeMasterReligionData();
        $createdMasterReligion = $this->masterReligionRepo->create($masterReligion);
        $createdMasterReligion = $createdMasterReligion->toArray();
        $this->assertArrayHasKey('id', $createdMasterReligion);
        $this->assertNotNull($createdMasterReligion['id'], 'Created MasterReligion must have id specified');
        $this->assertNotNull(MasterReligion::find($createdMasterReligion['id']), 'MasterReligion with given id must be in DB');
        $this->assertModelData($masterReligion, $createdMasterReligion);
    }

    /**
     * @test read
     */
    public function testReadMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $dbMasterReligion = $this->masterReligionRepo->find($masterReligion->id);
        $dbMasterReligion = $dbMasterReligion->toArray();
        $this->assertModelData($masterReligion->toArray(), $dbMasterReligion);
    }

    /**
     * @test update
     */
    public function testUpdateMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $fakeMasterReligion = $this->fakeMasterReligionData();
        $updatedMasterReligion = $this->masterReligionRepo->update($fakeMasterReligion, $masterReligion->id);
        $this->assertModelData($fakeMasterReligion, $updatedMasterReligion->toArray());
        $dbMasterReligion = $this->masterReligionRepo->find($masterReligion->id);
        $this->assertModelData($fakeMasterReligion, $dbMasterReligion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $resp = $this->masterReligionRepo->delete($masterReligion->id);
        $this->assertTrue($resp);
        $this->assertNull(MasterReligion::find($masterReligion->id), 'MasterReligion should not exist in DB');
    }
}
