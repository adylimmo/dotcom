<?php

use Faker\Factory as Faker;
use App\Models\MasterReligion;
use App\Repositories\MasterReligionRepository;

trait MakeMasterReligionTrait
{
    /**
     * Create fake instance of MasterReligion and save it in database
     *
     * @param array $masterReligionFields
     * @return MasterReligion
     */
    public function makeMasterReligion($masterReligionFields = [])
    {
        /** @var MasterReligionRepository $masterReligionRepo */
        $masterReligionRepo = App::make(MasterReligionRepository::class);
        $theme = $this->fakeMasterReligionData($masterReligionFields);
        return $masterReligionRepo->create($theme);
    }

    /**
     * Get fake instance of MasterReligion
     *
     * @param array $masterReligionFields
     * @return MasterReligion
     */
    public function fakeMasterReligion($masterReligionFields = [])
    {
        return new MasterReligion($this->fakeMasterReligionData($masterReligionFields));
    }

    /**
     * Get fake data of MasterReligion
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMasterReligionData($masterReligionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $masterReligionFields);
    }
}
