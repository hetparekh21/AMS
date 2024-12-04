<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $class_code
 * @property string $dynamic_code
 * @property string $Timestamp
 */
class dynamic_mapper extends Model
{

    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'class_code';

    /**
     * @var array
     */
    protected $fillable = ['dynamic_code', 'Timestamp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo('App\Models\Class', null, 'class_id');
    }

    public function sus(){
        return $this->hasMany('App\Models\sus');
    }

}
