<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $class_id
 * @property integer $subject_id
 * @property string $class_code
 * @property string $date
 * @property AttJson[] $attJsons
 * @property Subject $subject
 */
class classes extends Model
{
    public $timestamps = false;
    
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'class_id';

    /**
     * @var array
     */
    protected $fillable = ['subject_id', 'class_code', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attJsons()
    {
        return $this->hasMany('App\Models\AttJson', null, 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', null, 'subject_id');
    }
}
