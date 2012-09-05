<?php

class Create_Users_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create table
		Schema::create('users_users', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('friend_id');
			$table->float('debt');
			$table->timestamps();
			
			// $table->foreign('user_id')->references('id')->on('users');
			// $table->foreign('friend_id')->references('id')->on('users');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete table
		Schema::drop('user_user');
	}

}