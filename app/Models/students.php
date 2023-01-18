<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $student_id
 * @property integer $uid
 * @property integer $course_id
 * @property integer $semester_id
 * @property integer $roll_no
 * @property string $student_name
 * @property Semester $semester
 * @property User $user
 * @property Course $course
 */
class students extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'student_id';

    /**
     * @var array
     */
    protected $fillable = ['uid', 'course_id', 'semester_id', 'roll_no', 'student_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester', null, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', null, 'course_id');
    }
}
