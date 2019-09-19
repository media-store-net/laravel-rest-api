<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'domains', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'software_id' )->nullable( true );
			$table->string( 'domain_name' )->unique();
			$table->string( 'domain_text' )->nullable( true );
			$table->string( 'domain_end' );

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'domains' );
	}
}
