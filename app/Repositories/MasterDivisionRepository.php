<?php

namespace App\Repositories;

use App\Models\MasterDivision;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MasterDivisionRepository
 * @package App\Repositories
 * @version October 5, 2018, 8:56 am UTC
 *
 * @method MasterDivision findWithoutFail($id, $columns = ['*'])
 * @method MasterDivision find($id, $columns = ['*'])
 * @method MasterDivision first($columns = ['*'])
*/
class MasterDivisionRepository extends BaseRepository
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
        return MasterDivision::class;
    }
}
