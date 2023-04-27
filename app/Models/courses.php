<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $course_id
 * @property integer $course_fees
 * @property string $course_name
 * @property string $course_code
 * @property Student[] $students
 * @property Subject[] $subjects
 */
class courses extends Model
{

    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'course_id';

    /**
     * @var array
     */
    protected $fillable = ['course_fees', 'course_name', 'course_code','semesters'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', null, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Models\Subjects', 'course_id', 'course_id');
    }
}
