<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable {
	use HasApiTokens, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'vorname',
		'nachname',
		'nickname',
		'publicname',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function userroles() {
		return $this->belongsToMany( 'App\Userrole', 'users_roles', 'user_id', 'role_id' );
	}

	/**
	 * Relationship to Licence
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function licence() {
		return $this->hasOne( 'App\Licence' );
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function software() {
		return $this->belongsToMany( 'App\Software', 'users_software', 'user_id', 'software_id' );
	}
	
}
