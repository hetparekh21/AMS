<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Template
 * 
 * @property int $id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $course_id
 * @property int $semester_id
 * 
 * @property Course $course
 * @property Semester $semester
 * @property Subject $subject
 * @property Teacher $teacher
 *
 * @package App\Models
 */
class templates extends Model
{
	protected $table = 'templates';
	public $timestamps = false;

	protected $casts = [
		'teacher_id' => 'int',
		'subject_id' => 'int',
		'course_id' => 'int',
		'semester_id' => 'int'
	];

	protected $fillable = [
		'teacher_id',
		'subject_id',
		'course_id',
		'semester_id'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
