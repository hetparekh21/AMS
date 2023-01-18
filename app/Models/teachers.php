<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $teacher_id
 * @property integer $uid
 * @property string $teacher_name
 * @property Subject[] $subjects
 * @property User $user
 */
class teachers extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'teacher_id';

    /**
     * @var array
     */
    protected $fillable = ['uid', 'teacher_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'sub_tech');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid');
    }
}
