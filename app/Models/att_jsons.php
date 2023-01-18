<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $att_json_id
 * @property integer $class_id
 * @property string $att_json
 * @property Class $class
 */
class att_jsons extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'att_json_id';

    /**
     * @var array
     */
    protected $fillable = ['class_id', 'att_json'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo('App\Models\Class', null, 'class_id');
    }
}
