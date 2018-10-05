<?php

use Faker\Factory as Faker;
use App\Models\MasterDivision;
use App\Repositories\MasterDivisionRepository;

trait MakeMasterDivisionTrait
{
    /**
     * Create fake instance of MasterDivision and save it in database
     *
     * @param array $masterDivisionFields
     * @return MasterDivision
     */
    public function makeMasterDivision($masterDivisionFields = [])
    {
        /** @var MasterDivisionRepository $masterDivisionRepo */
        $masterDivisionRepo = App::make(MasterDivisionRepository::class);
        $theme = $this->fakeMasterDivisionData($masterDivisionFields);
        return $masterDivisionRepo->create($theme);
    }

    /**
     * Get fake instance of MasterDivision
     *
     * @param array $masterDivisionFields
     * @return MasterDivision
     */
    public function fakeMasterDivision($masterDivisionFields = [])
    {
        return new MasterDivision($this->fakeMasterDivisionData($masterDivisionFields));
    }

    /**
     * Get fake data of MasterDivision
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMasterDivisionData($masterDivisionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $masterDivisionFields);
    }
}
