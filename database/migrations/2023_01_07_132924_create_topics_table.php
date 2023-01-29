<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTopicsTable.
 */
class CreateTopicsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->increments('id');

            $table->string("slug")->unique();
            $table->string("title");
            $table->string("description", 255)->nullable();
            $table->longText("content");
            $table->string("image");
            $table->string("polis_id")->nullable();
            $table->string("polis_site_id")->nullable();
            $table->string("polis_description");
            $table->json("polis_comments")->nullable();
            $table->boolean("published")->default(false);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('topics');
	}
}
