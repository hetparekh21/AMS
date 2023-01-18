<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $semester_id
 * @property string $semester_name
 * @property Student[] $students
 * @property Subject[] $subjects
 */
class semesters extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'semester_id';

    /**
     * @var array
     */
    protected $fillable = ['semester_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', null, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', null, 'semester_id');
    }
}
