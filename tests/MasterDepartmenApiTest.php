<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MasterDepartmenApiTest extends TestCase
{
    use MakeMasterDepartmenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMasterDepartmen()
    {
        $masterDepartmen = $this->fakeMasterDepartmenData();
        $this->json('POST', '/api/v1/masterDepartmens', $masterDepartmen);

        $this->assertApiResponse($masterDepartmen);
    }

    /**
     * @test
     */
    public function testReadMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $this->json('GET', '/api/v1/masterDepartmens/'.$masterDepartmen->id);

        $this->assertApiResponse($masterDepartmen->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $editedMasterDepartmen = $this->fakeMasterDepartmenData();

        $this->json('PUT', '/api/v1/masterDepartmens/'.$masterDepartmen->id, $editedMasterDepartmen);

        $this->assertApiResponse($editedMasterDepartmen);
    }

    /**
     * @test
     */
    public function testDeleteMasterDepartmen()
    {
        $masterDepartmen = $this->makeMasterDepartmen();
        $this->json('DELETE', '/api/v1/masterDepartmens/'.$masterDepartmen->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/masterDepartmens/'.$masterDepartmen->id);

        $this->assertResponseStatus(404);
    }
}
