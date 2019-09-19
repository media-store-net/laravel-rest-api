<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLicencesTable
 */
class CreateLicencesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'licences', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'user_id' );
			$table->string( 'licence_nr' )->unique();
			$table->string( 'licence_text' )->nullable();

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'licences' );
	}
}
