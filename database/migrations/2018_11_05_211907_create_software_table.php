<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSoftwareTable
 */
class CreateSoftwareTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'software', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'software_name' );
			$table->string( 'software_text' )->nullable();

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'software' );
	}
}
