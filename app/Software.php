<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Software
 * @package App
 */
class Software extends Model {
	use Notifiable;

	/**
	 * @var array
	 */
	protected $fillable = [ 'software_name', 'software_text' ];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function user() {
		return $this->belongsToMany( 'App\User', 'users_software' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function domain() {
		return $this->hasMany( 'App\Domain' );
	}
}
