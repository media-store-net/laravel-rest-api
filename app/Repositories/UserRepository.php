<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 11.11.2018
 * Time: 17:01
 */

namespace App\Repositories;


use App\Software;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository {


	public static function all() {
		return self::map( User::all() );
	}

	public static function map( Collection $collection ) {
		//var_dump($collection);
		return $collection->map( function ( $user ) {
			@$user->userroles;
			@$user->licence;
			@SoftwareRepository::withDomains($user->software);

			return $user;
		} );
	}
}