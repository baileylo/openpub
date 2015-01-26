<?php

use Baileylo\BlogApp\Seeds\PostSeeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Eloquent::unguard();

		 $this->call(PostSeeder::class);
	}

}
