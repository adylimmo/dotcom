<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="MasterDepartmen",
 *      required={"division_id", "departmen"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="division_id",
 *          description="division_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="departmen",
 *          description="departmen",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class MasterDepartmen extends Model
{
    use SoftDeletes;

    public $table = 'master_departmens';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'division_id',
        'departmen'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'division_id' => 'string',
        'departmen' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'division_id' => 'required',
        'departmen' => 'required'
    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function modivision()
    {
        return $this->belongsTo('\App\Models\MasterDivision', 'division_id', 'id', 'nama');
    }

    
}
