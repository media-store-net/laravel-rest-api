<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Repositories\SoftwareRepository;
use App\Software;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SoftwareController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return SoftwareRepository
	 */
	public function index() {
		return SoftwareRepository::all();
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
	 * @return SoftwareRepository
	 */
	public function store( Request $request ) {
		if ( $software = Software::create( $request->all() ) ) {

			$date = $request->input( 'domain_end' ) ? $request->input( 'domain_end' ) : date( 'Y-m-d', time() + ( 30 * 24 * 60 * 60 ) );

			foreach ( $request->all() as $key => $value ) {
				switch ( $key ) {
					case 'domain_name':
						$domains = Domain::where( 'domain_name', $request->input( 'domain_name' ) )->get();
						if ( $domains->isEmpty() ) {
							$software->domain()->save( new Domain(
								[
									'software_id' => $software->id,
									'domain_name' => $request->input( 'domain_name' ),
									'domain_text' => $request->input( 'domain_text' ),
									'domain_end'  => $date
								]
							) );
						} else {
							$software->domain()->update( [
								'domain_text' => $request->input( 'domain_text' ),
								'domain_end'  => $date
							] );
						}
						break;
					default:
						$software->fill( [ $key => $value ] );
						break;
				}

			}
			$software->save();

			return SoftwareRepository::withDomains( Collection::make( $software ) );
		}

		return null;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $id
	 *
	 * @return SoftwareRepository
	 */
	public function show( $id ) {
		return SoftwareRepository::withDomains( Collection::make( [ Software::find( $id ) ] ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Software $software
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Software $software ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  $id
	 *
	 * @return SoftwareRepository | null
	 */
	public function update( Request $request, Software $id ) {
		$software = Software::find( $id )->first();
		$date     = $request->input( 'domain_end' ) ? $request->input( 'domain_end' ) : date( 'Y-m-d', time() + ( 30 * 24 * 60 * 60 ) );

		foreach ( $request->all() as $key => $value ) {
			switch ( $key ) {
				case 'domain_name':
					$domains = $software->domain()->where( 'domain_name', $request->input( 'domain_name' ) )->get();
					if ( $domains->isEmpty() ) {
						$software->domain()->save( new Domain(
							[
								'software_id' => $software->id,
								'domain_name' => $request->input( 'domain_name' ),
								'domain_text' => $request->input( 'domain_text' ),
								'domain_end'  => $date
							]
						) );
					} else {
						$software->domain()->update( [
							'domain_text' => $request->input( 'domain_text' ),
							'domain_end'  => $date
						] );
					}
					break;
				default:
					$software->fill( [ $key => $value ] );
					break;
			}


			$software->save();

			return SoftwareRepository::withDomains( Collection::make( [ $software ] ) );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  $id
	 *
	 * @return \Illuminate\Http\Response | null
	 */
	public function destroy( $id ) {
		$soft = Software::find( $id )->first();

		foreach ( $soft->domain as $domain ) {
			Domain::destroy( $domain->id );
		}
		if ( $soft->destroy( $id ) ) {

			return response( 1 );
		}


		return null;
	}
}
