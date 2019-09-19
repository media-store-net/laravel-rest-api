<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Domain
 * @package App
 */
class Domain extends Model {
	use Notifiable;

	/**
	 * @var array
	 */
	protected $fillable = [ 'software_id', 'domain_name', 'domain_text', 'domain_end' ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo( 'App\User' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function software() {
		return $this->belongsTo( 'App\Software' );
	}
}
