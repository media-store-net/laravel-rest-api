<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Licence
 * @package App
 */
class Licence extends Model {
	use Notifiable;

	/**
	 * Fillable Fields
	 *
	 * @var array
	 */
	protected $fillable = [ 'licence_nr', 'licence_text' ];

	/**
	 * Relationship to User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo( 'App\User' );
	}
}
