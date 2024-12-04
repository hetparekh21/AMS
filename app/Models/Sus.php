<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sus extends Model
{
    use HasFactory;

    public $table = "sus";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'class_code',
        'ip',
        'student_id'
    ];

    public function student(){
        return $this->belongsTo('App\Models\student',null,'uid');
    }

    public function class_code()
    {
        return $this->belongsTo('App\Models\dynamic_mapper', null, 'class_code');
    }

}
