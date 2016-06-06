<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('copas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idpengguna');
			$table->integer('lang');
			$table->integer('jenis');
			$table->integer('spam');
			$table->integer('spam_fix');
			$table->string('hash');
			$table->string('judul');
			$table->longtext('isi');
			$table->string('expires');
			$table->integer('lihat');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('copas');
	}

}
