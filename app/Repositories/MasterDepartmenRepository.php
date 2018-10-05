<?php

namespace App\Repositories;

use App\Models\MasterDepartmen;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MasterDepartmenRepository
 * @package App\Repositories
 * @version October 5, 2018, 9:00 am UTC
 *
 * @method MasterDepartmen findWithoutFail($id, $columns = ['*'])
 * @method MasterDepartmen find($id, $columns = ['*'])
 * @method MasterDepartmen first($columns = ['*'])
*/
class MasterDepartmenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'division_id',
        'departmen'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MasterDepartmen::class;
    }
}
