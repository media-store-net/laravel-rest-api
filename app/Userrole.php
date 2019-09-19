<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Userrole
 * @package App
 */
class Userrole extends Model {
	use Notifiable;

	/**
	 * Fillable Fields
	 *
	 * @var array
	 */
	protected $fillable = [ 'userrole_name', 'userrole_text' ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users() {
		return $this->belongsToMany( 'App\User', 'users_roles', 'role_id', 'user_id' );
	}
}
