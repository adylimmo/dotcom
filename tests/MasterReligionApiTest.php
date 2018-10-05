<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterReligionApiTest extends TestCase
{
    use MakeMasterReligionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMasterReligion()
    {
        $masterReligion = $this->fakeMasterReligionData();
        $this->json('POST', '/api/v1/masterReligions', $masterReligion);

        $this->assertApiResponse($masterReligion);
    }

    /**
     * @test
     */
    public function testReadMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $this->json('GET', '/api/v1/masterReligions/'.$masterReligion->id);

        $this->assertApiResponse($masterReligion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $editedMasterReligion = $this->fakeMasterReligionData();

        $this->json('PUT', '/api/v1/masterReligions/'.$masterReligion->id, $editedMasterReligion);

        $this->assertApiResponse($editedMasterReligion);
    }

    /**
     * @test
     */
    public function testDeleteMasterReligion()
    {
        $masterReligion = $this->makeMasterReligion();
        $this->json('DELETE', '/api/v1/masterReligions/'.$masterReligion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/masterReligions/'.$masterReligion->id);

        $this->assertResponseStatus(404);
    }
}
