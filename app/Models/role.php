<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $role_id
 * @property string $role_name
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class role extends Model
{
	protected $table = 'role';
	protected $primaryKey = 'role_id';
	public $timestamps = false;

	protected $fillable = [
		'role_name'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
