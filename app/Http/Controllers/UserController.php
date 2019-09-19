<?php

namespace App\Http\Controllers;

use App\Licence;
use App\Repositories\UserRepository;
use App\Software;
use App\User;
use App\Userrole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index() {
		return UserRepository::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return UserRepository
	 */
	public function store( Request $request ) {

		if ( $user = User::create( $request->all( [ 'name', 'email', 'password' ] ) ) ) {

			foreach ( $request->all() as $key => $value ) {
				switch ( $key ) {
					case 'password':
						$user->fill( [ 'password' => bcrypt( $value ) ] );
						break;

					case 'software':
						$soft = Software::find( explode( ',', $request->input( 'software' ) ) );
						foreach ( $soft as $s ) {
							$user->software()->save( $s );
						}

						break;
					case 'userroles':
						$role = Userrole::find( explode( ',', $request->input( 'userroles' ) ) );
						foreach ( $role as $r ) {
							$user->userroles()->save( $r );
						}

						break;
					default:
						$user->fill( [ $key => $value ] );
				}
			}
			$lizenz = new Licence( [ 'user_id' => $user->id, 'licence_nr' => md5( $user->email ) ] );
			$user->licence()->save( $lizenz );
			$user->save();

			return UserRepository::map( Collection::make( [ $user ] ) );
		}

		return null;
	}


	public function show( $id ) {
		return UserRepository::map( Collection::make( [ User::find( $id ) ] ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( User $user ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  $id
	 *
	 * @return UserRepository
	 */
	public function update( Request $request, $id ) {
		$user = User::find( $id );
		foreach ( $request->all() as $key => $value ) {
			switch ( $key ) {
				case 'password':
					$user->fill( [ 'password' => bcrypt( $value ) ] );
					break;

				/*
				 * FÜR Create()
				 * case 'licence':
					$collection = Licence::where( 'user_id', [$user->id] )->get();
					if ( $collection->isEmpty() ) {
						$lizenz = new Licence( [ 'user_id' => $user->id, 'licence_nr' => md5( $user->email ) ] );
						$user->licence()->save( $lizenz );
					}
					break;*/

				case 'software':
					$soft = Software::find( [ $request->input( 'software' ) ] );
					foreach ( $soft as $s ) {
						$user->software()->save( $s );
					}

					break;
				case 'userroles':
					$role = Userrole::find( explode( ',', $request->input( 'userroles' ) ) );
					foreach ( $role as $r ) {
						$user->userroles()->save( $r );
					}

					break;
				default:
					$user->fill( [ $key => $value ] );
			}
		}
		if ( $user->save() ) {
			return UserRepository::map( Collection::make( [ $user ] ) );
		}

		return null;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		if ( User::destroy( $id ) ) {
			return response( 1 );
		}

		return null;
	}
}
