<?php

namespace App\Repositories;

use App\Models\Product;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version October 3, 2018, 11:18 am UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
*/
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'image',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
