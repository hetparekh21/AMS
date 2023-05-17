<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $subject_id
 * @property integer $teacher_id
 * @property Subject $subject
 * @property Teacher $teacher
 */
class sub_tech extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sub_tech';

    /**
     * @var array
     */
    protected $fillable = ['subject_id','teacher_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', null, 'subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', null, 'teacher_id');
    }
}
