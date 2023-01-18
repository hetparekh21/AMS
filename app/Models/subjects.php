<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $subject_id
 * @property integer $course_id
 * @property integer $semester_id
 * @property string $subject_name
 * @property string $subject_code
 * @property Class[] $classes
 * @property Course $course
 * @property Semester $semester
 * @property Teacher[] $teachers
 */
class subjects extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'subject_id';

    /**
     * @var array
     */
    protected $fillable = ['course_id', 'semester_id', 'subject_name', 'subject_code'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany('App\Models\Class', null, 'subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', null, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester', null, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'sub_tech');
    }
}
