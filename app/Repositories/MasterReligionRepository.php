<?php

namespace App\Repositories;

use App\Models\MasterReligion;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MasterReligionRepository
 * @package App\Repositories
 * @version October 5, 2018, 8:48 am UTC
 *
 * @method MasterReligion findWithoutFail($id, $columns = ['*'])
 * @method MasterReligion find($id, $columns = ['*'])
 * @method MasterReligion first($columns = ['*'])
*/
class MasterReligionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MasterReligion::class;
    }
}
