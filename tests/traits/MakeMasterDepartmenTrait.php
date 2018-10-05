<?php

use Faker\Factory as Faker;
use App\Models\MasterDepartmen;
use App\Repositories\MasterDepartmenRepository;

trait MakeMasterDepartmenTrait
{
    /**
     * Create fake instance of MasterDepartmen and save it in database
     *
     * @param array $masterDepartmenFields
     * @return MasterDepartmen
     */
    public function makeMasterDepartmen($masterDepartmenFields = [])
    {
        /** @var MasterDepartmenRepository $masterDepartmenRepo */
        $masterDepartmenRepo = App::make(MasterDepartmenRepository::class);
        $theme = $this->fakeMasterDepartmenData($masterDepartmenFields);
        return $masterDepartmenRepo->create($theme);
    }

    /**
     * Get fake instance of MasterDepartmen
     *
     * @param array $masterDepartmenFields
     * @return MasterDepartmen
     */
    public function fakeMasterDepartmen($masterDepartmenFields = [])
    {
        return new MasterDepartmen($this->fakeMasterDepartmenData($masterDepartmenFields));
    }

    /**
     * Get fake data of MasterDepartmen
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMasterDepartmenData($masterDepartmenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'division_id' => $fake->word,
            'departmen' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $masterDepartmenFields);
    }
}
