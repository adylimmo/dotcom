<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterDivisionApiTest extends TestCase
{
    use MakeMasterDivisionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMasterDivision()
    {
        $masterDivision = $this->fakeMasterDivisionData();
        $this->json('POST', '/api/v1/masterDivisions', $masterDivision);

        $this->assertApiResponse($masterDivision);
    }

    /**
     * @test
     */
    public function testReadMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $this->json('GET', '/api/v1/masterDivisions/'.$masterDivision->id);

        $this->assertApiResponse($masterDivision->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $editedMasterDivision = $this->fakeMasterDivisionData();

        $this->json('PUT', '/api/v1/masterDivisions/'.$masterDivision->id, $editedMasterDivision);

        $this->assertApiResponse($editedMasterDivision);
    }

    /**
     * @test
     */
    public function testDeleteMasterDivision()
    {
        $masterDivision = $this->makeMasterDivision();
        $this->json('DELETE', '/api/v1/masterDivisions/'.$masterDivision->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/masterDivisions/'.$masterDivision->id);

        $this->assertResponseStatus(404);
    }
}
