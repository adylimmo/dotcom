<?php

use App\Models\MasterDivision;
use App\Repositories\MasterDivisionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterDivisionRepositoryTest extends TestCase
{
    use MakeMasterDivisionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MasterDivisionRepository
     */
    protected $masterDivisionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->masterDivisionRepo = App::make(MasterDivisionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMasterDivision()
    {
        $masterDivision = $this->fakeMasterDivisionData();
        $createdMasterDivision = $this->masterDivisionRepo->create($masterDivision);
        $createdMasterDivision = $createdMasterDivision->toArray();
        $this->assertArrayHasKey('id', $createdMasterDivision);
        $this->assertNotNull($createdMasterDivision['id'], 'Created MasterDivision must have id specified');
        $this->assertNotNull(MasterDivision::find($createdMasterDivision['id']), 'MasterDivision with given id must be in DB');
        $this->assertModelData($masterDivision, $createdMasterDivision);
    }

    /**
     * @test read
     */
    public function testReadMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $dbMasterDivision = $this->masterDivisionRepo->find($masterDivision->id);
        $dbMasterDivision = $dbMasterDivision->toArray();
        $this->assertModelData($masterDivision->toArray(), $dbMasterDivision);
    }

    /**
     * @test update
     */
    public function testUpdateMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $fakeMasterDivision = $this->fakeMasterDivisionData();
        $updatedMasterDivision = $this->masterDivisionRepo->update($fakeMasterDivision, $masterDivision->id);
        $this->assertModelData($fakeMasterDivision, $updatedMasterDivision->toArray());
        $dbMasterDivision = $this->masterDivisionRepo->find($masterDivision->id);
        $this->assertModelData($fakeMasterDivision, $dbMasterDivision->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $resp = $this->masterDivisionRepo->delete($masterDivision->id);
        $this->assertTrue($resp);
        $this->assertNull(MasterDivision::find($masterDivision->id), 'MasterDivision should not exist in DB');
    }
}
