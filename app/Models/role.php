<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $role_id
 * @property string $role_name
 * @property User[] $users
 */
class role extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'role';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * @var array
     */
    protected $fillable = ['role_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', null, 'role_id');
    }
}
