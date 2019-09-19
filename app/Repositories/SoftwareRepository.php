<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 11.11.2018
 * Time: 16:23
 */

namespace App\Repositories;


use App\Software;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SoftwareRepository
 * @package App\Repositories
 */
class SoftwareRepository {

	/**
	 * @return \Illuminate\Support\Collection|static
	 */
	public static function all() {
		return self::map( Software::all() );
	}


	/**
	 * @param Collection | Software $software
	 *
	 * @return \Illuminate\Support\Collection|static
	 */
	public static function withDomains( $software ) {
		return self::map( $software );
	}


	/**
	 * @param Collection $collection
	 *
	 * @return \Illuminate\Support\Collection|static
	 */
	public static function map( Collection $collection ) {
		return $collection->map( function ( $soft ) {
			@$soft->domain;

			return $soft;
		} );
	}
}